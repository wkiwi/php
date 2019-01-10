<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 16:33:01
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 17:11:10
 */
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\OrderPlace;
use app\api\service\Token as TokenService;
use app\api\service\Order as OrderService;
// use app\api\model\User as UserModel;
// use app\lib\exception\UserException;
// use app\lib\exception\SuccessMessage;
// use app\lib\enum\ScopeEnum;
// use app\lib\exception\ForbiddenException;
// use app\lib\exception\TokenException;


class Order extends BaseController
{
	protected $beforeActionList = [
		'checkExclusiveScope' => ['only' => 'placeOrder']
	];

	//用户选择商品后，像API提交包含所选择商品相关信息
	//API在接收到信息后，商家检查订单相关商品库存
	//有库存，把订单数据存入数据库中下单成功了，返回客户端消息，告诉客户端可以支付了
	//调用支付接口，进行支付
	//还需要再次进行库存量检测
	//服务器这边可以调用微信的支付接口进行支付
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


}