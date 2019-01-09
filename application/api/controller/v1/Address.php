<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 11:13:03
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 16:24:04
 */
namespace app\api\controller\v1;

use app\api\validate\AddressNew;
use app\api\service\Token as TokenService;
use app\api\model\User as UserModel;
use app\lib\exception\UserException;
use app\lib\exception\SuccessMessage;
use think\Controller;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;
use app\lib\exception\TokenException;

class Address extends Controller
{
	protected $beforeActionList = [
		'checkPrimaryScope' => ['only' => 'createOrUpdateAddress']
	];

	protected function checkPrimaryScope(){
		$scope = TokenService::getCurrentTokenVar('scope');
		if($scope){
			if($scope >= ScopeEnum::User){
				return true;
			}else {
				throw new ForbiddenException();
			}
		}else{
			throw new TokenException();
		}
	}

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