<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 11:13:03
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 09:35:52
 */
namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\exception\UserException;
use app\lib\exception\SuccessMessage;
use app\api\controller\BaseController;

class Address extends BaseController
{
	protected $beforeActionList = [
		'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
	];

	// protected function checkPrimaryScope(){
	// 	TokenService::needPrimaryScope();
	// }

	public function createOrUpdateAddress(){
		$validate = new AddressNew();
		$validate->goCheck();
		//更具token来获取uid
		//根据uid来查找用户数据，判断用户是否存在，如果不存在则抛出异常
		//获取用户从客户端提交来的地址信息
		//根据用户地址信息是否存在 判断是添加地址还是更新地址
		$uid = TokenService::getCurrentUid();
		$user = UserModel::get($uid);
		if(!$user){
			throw new UserException();
		}
		
		$dataArray = $validate->getDataByRule(input('post.'));

		$userAddress = $user->address;
		if(!$userAddress){//新增
			$user->address()->save($dataArray);
		}else{//修改
			$user->address->save($dataArray);
		}
		return json(new SuccessMessage(),201);
	}
}