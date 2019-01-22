<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-11 09:13:54
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-18 17:47:15
 */
namespace app\api\controller\v1;

use app\api\controller\BaseController;
use app\api\validate\IDMustBePostiveInt;
use app\api\service\Pay as PayService;
use app\api\service\WxNotify;


class Pay extends BaseController
{
	protected $beforeActionList = [
		'checkExclusiveScope' => ['only' => 'getPreOrder']
	];

	public function getPreOrder($id = ''){
		(new IDMustBePostiveInt())->goCheck();
		$pay = new PayService($id);
		return $pay->pay();
	}
	//回调通知处理
	public function receiveNotify(){
		//1.检查库存量，超卖
		//2.更新这个订单status状态
		//3 减库存
		//如果成功处理，我们返回微信成功处理的信息，否则，我们需要返回没有成功处理

		//特点：post：xml格式
		$notify = new WxNotify();
		$notify->Handle();
	}
}