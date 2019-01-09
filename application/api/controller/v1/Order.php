<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 16:33:01
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 16:53:11
 */
namespace app\api\controller\v1;

use think\Controller;
// use app\api\validate\AddressNew;
// use app\api\service\Token as TokenService;
// use app\api\model\User as UserModel;
// use app\lib\exception\UserException;
// use app\lib\exception\SuccessMessage;
// use app\lib\enum\ScopeEnum;
// use app\lib\exception\ForbiddenException;
// use app\lib\exception\TokenException;

class Order extends Controller
{
	// protected $beforeActionList = [
	// 	'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
	// ];

	//用户选择商品后，像API提交包含所选择商品相关信息
	//API在接收到信息后，商家检查订单相关商品库存
	//有库存，把订单数据存入数据库中下单成功了，返回客户端消息，告诉客户端可以支付了
	//调用支付接口，进行支付
	//还需要再次进行库存量检测
	//服务器这边可以调用微信的支付接口进行支付
	//微信会返回支付结果
	//成功 也需要进行库存量的检测
	//成功进行库存量扣除，失败，返回一个支付失败的结果
}