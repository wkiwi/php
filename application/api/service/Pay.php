<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-11 09:25:47
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-18 16:31:59
 */
namespace app\api\service;

use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\lib\exception\OrderException;
use app\api\service\Token;
use app\lib\exception\TokenException;
use app\lib\enum\OrderStatusEnum;
use think\Exception;
use think\Loader;
use think\Log;

//extend/WxPay/WxPay.Api.php
Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class Pay
{
	private $orderID;
	private $orderNO;

	function __construct($orderID){
		if(!$orderID){
			throw new Exception('订单号不用许为NULL');
		}
		$this->orderID = $orderID;
	}

	public function pay(){
		//订单号可能根本不存在
		//订单号确实存在，但是，当单号和当前用户是不匹配的
		//订单有可能已经被支付过了
		//进行库存量检测
		$this->checkOrderValid();
		$orderService = new OrderService();
		$status = $orderService->checkOrderStock($this->$orderID);
		if(!$status['pass']){
			return $status;
		}
		return $this->makeWxPreOrder($status['orderPrice']);
	}
	// 构建微信支付订单信息
	private function makeWxPreOrder($totalPrice){
		//openid 
		$openid = Token::getCurrentTokenVar('openid');
		if(!$openid){
			throw new TokenException();
		}
		$wxOrderData = new \WxPayUnifiedOrder();
		$wxOrderData->SetOut_trade_no($this->orderNO);
		$wxOrderData->SetTrade_type('JSAPI');
		$wxOrderData->SetTotal_fee($totalPrice*100);
		$wxOrderData->SetBody('零食');
		$wxOrderData->SetOpenid($openid);
		$wxOrderData->SetNotify_url(config('secure.pay_back_url'));

		return $this->getPaySignature($wxOrderData);
	}
	//向微信请求订单号并生成签名
	private function getPaySignature($wxOrderData){
		$wxOrder = \WxPayApi::unifiedOrder($wxOrderData);
        // 失败时不会返回result_code
        if($wxOrder['return_code'] != 'SUCCESS' || $wxOrder['result_code'] !='SUCCESS'){
            Log::record($wxOrder,'error');
            Log::record('获取预支付订单失败','error');
//          throw new Exception('获取预支付订单失败');
        }
        $this->recordPreOrder($wxOrder);
        $signature = $this->sign($wxOrder);
        return $signature;
	}
	// 签名
    private function sign($wxOrder)
    {
        $jsApiPayData = new \WxPayJsApiPay();
        $jsApiPayData->SetAppid(config('wx.app_id'));
        $jsApiPayData->SetTimeStamp((string)time());
        $rand = md5(time() . mt_rand(0, 1000));
        $jsApiPayData->SetNonceStr($rand);
        $jsApiPayData->SetPackage('prepay_id=' . $wxOrder['prepay_id']);
        $jsApiPayData->SetSignType('md5');
        $sign = $jsApiPayData->MakeSign();
        $rawValues = $jsApiPayData->GetValues();
        $rawValues['paySign'] = $sign;
        unset($rawValues['appId']);
        return $rawValues;
    }
	//保存更新prepay_id
	private function recordPreOrder($wxOrder){
        // 必须是update，每次用户取消支付后再次对同一订单支付，prepay_id是不同的
        OrderModel::where('id', '=', $this->orderID)->update(['prepay_id' => $wxOrder['prepay_id']]);
    }
	private function checkOrderValid(){
		$order = OrderModel::where('id', '=', $this->orderID)->find(); 
		if(!$order){
			throw new OrderException();
		}
		if(!Token::isValidOperate($order->user_id)){
			throw new TokenException([
				'msg' => '订单与用户不匹配',
				'errorCode' => 10003
			]);
		}
		if($order->status != OrderStatusEnum::UNPAID){
			throw new OrderException([
				'msg' => '订单已支付过啦',
				'errorCode' => 80003,
				'code' => 400
			]);
		}
		$this->$orderNO = $order->order_no;
		return true;
	}
}