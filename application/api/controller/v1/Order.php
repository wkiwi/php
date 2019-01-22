<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 16:33:01
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-22 09:52:32
 */
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\api\validate\PagingParameter;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
use app\api\model\Order as OrderModel;
use app\api\validate\IDMustBePostiveInt;
use app\lib\exception\OrderException;

class Order extends BaseController
{
	protected $beforeActionList = [
		'checkExclusiveScope' => ['only' => 'placeOrder'],
		'checkPrimaryScope' => ['only' => 'getSummaryByUser,getDetail']
	];

	//用户选择商品后，像API提交包含所选择商品相关信息
	//API在接收到信息后，商家检查订单相关商品库存
	//有库存，把订单数据存入数据库中下单成功了，返回客户端消息，告诉客户端可以支付了
	//调用支付接口，进行支付
	//还需要再次进行库存量检测
	//服务器这边可以调用微信的支付接口进行支付
	//小程序更具服务器返回结果拉起微信
	//微信会返回支付结果
	//成功 也需要进行库存量的检测
	//成功进行库存量扣除，失败，返回一个支付失败的结果

	public function placeOrder(){
		(new OrderPlace())->goCheck();
		$products = input ('post.products/a');
		$uid = TokenService::getCurrentUid();

		$order = new OrderService();
		$status = $order->place($uid,$products);
		return $status;
	}
	//获取订单列表
	public function getSummaryByUser($page=1,$size=15){
		(new PagingParameter())->goCheck();
		$uid = TokenService::getCurrentUid();
		$pagingOrders = OrderModel::getSummaryByUser($uid, $page, $size);
		if($pagingOrders->isEmpty()){
			return [
				'data' => [],
				'current_page' =>$pagingOrders->getCurrentPage()
			];
		}
		$data = $pagingOrders->hidden(['snap_items','prepay_id','snap_address'])->toArray();
		return [
				'data' => $data,
				'current_page' =>$pagingOrders->getCurrentPage()
			];
	}
	//获取订单详情
	public function getDetail($id){
		(new IDMustBePostiveInt())->goCheck();
		$orderDetail = OrderModel::get($id);
		if(!$orderDetail){
			throw new OrderException();
		}
		return $orderDetail->hidden(['prepay_id']);
	}

	/**
     * 获取全部订单简要信息（分页）
     * @param int $page
     * @param int $size
     * @return array
     * @throws \app\lib\exception\ParameterException
     */
    public function getSummary($page=1, $size = 20){
        (new PagingParameter())->goCheck();
//        $uid = Token::getCurrentUid();
        $pagingOrders = OrderModel::getSummaryByPage($page, $size);
        if ($pagingOrders->isEmpty())
        {
            return [
                'current_page' => $pagingOrders->currentPage(),
                'data' => []
            ];
        }
        $data = $pagingOrders->hidden(['snap_items', 'snap_address'])
            ->toArray();
        return [
            'current_page' => $pagingOrders->currentPage(),
            'data' => $data
        ];
    }
    public function delivery($id){
        (new IDMustBePositiveInt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if($success){
            return new SuccessMessage();
        }
    }
}