<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-11 15:07:06
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-11 15:39:31
 */
namespace app\api\service;

use think\Loader;
use app\api\model\Order as OrderModel;
use app\api\model\Product;
use app\api\service\Order as OrderService;
use app\lib\enum\OrderStatusEnum;
use think\Db;
use think\Exception;
use think\Loader;
use think\Log;

Loader::import('WxPay.WxPay',EXTEND_PATH,'.Api.php');

class WxNotify extends \WxPayNotify
{
	//<xml><appid><![CDATA[wxaaf1c852597e365b]]></appid>
	//<bank_type><![CDATA[CFT]]></bank_type>
	//<cash_fee><![CDATA[1]]></cash_fee>
	//<fee_type><![CDATA[CNY]]></fee_type>
	//<is_subscribe><![CDATA[N]]></is_subscribe>
	//<mch_id><![CDATA[1392378802]]></mch_id>
	//<nonce_str><![CDATA[k66j676kzd3tqq2sr3023ogeqrg4np9z]]></nonce_str>
	//<openid><![CDATA[ojID50G-cjUsFMJ0PjgDXt9iqoOo]]></openid>
	//<out_trade_no><![CDATA[A301089188132321]]></out_trade_no>
	//<result_code><![CDATA[SUCCESS]]></result_code>
	//<return_code><![CDATA[SUCCESS]]></return_code>
	//<sign><![CDATA[944E2F9AF80204201177B91CEADD5AEC]]></sign>
	//<time_end><![CDATA[20170301030852]]></time_end>
	//<total_fee>1</total_fee>
	//<trade_type><![CDATA[JSAPI]]></trade_type>
	//<transaction_id><![CDATA[4004312001201703011727741547]]></transaction_id>
	//</xml>
	public function NotifyProcess($data, &$msg){
		if ($data['result_code'] == 'SUCCESS') {
            $orderNo = $data['out_trade_no'];
            Db::startTrans();
            try {
                $order = OrderModel::where('order_no', '=', $orderNo)->lock(true)->find();
                if ($order->status == 1) {
                    $service = new OrderService();
                    $stockStatus = $service->checkOrderStock($order->id);
                    if ($stockStatus['pass']) {
                        $this->updateOrderStatus($order->id, true);
                        $this->reduceStock($stockStatus);
                    } else {
                        $this->updateOrderStatus($order->id, false);
                    }
                    return true;
                }
                Db::commit();
            } catch (Exception $ex) {
                Db::rollback();
                Log::error($ex);
                // 如果出现异常，向微信返回false，请求重新发送通知
                return false;
            }
        }else{
        	return true;
        }
	}
	//减库存
	private function reduceStock($stockStatus)
    {
        foreach ($stockStatus['pStatusArray'] as $singlePStatus) {
            Product::where('id', '=', $singlePStatus['id'])->setDec('stock', $singlePStatus['count']);
        }
    }
    //更新订单状态
	private function updateOrderStatus($orderID, $success)
    {
        $status = $success ? OrderStatusEnum::PAID : OrderStatusEnum::PAID_BUT_OUT_OF;
        Order::where('id', '=', $orderID)->update(['status' => $status]);
    }
}