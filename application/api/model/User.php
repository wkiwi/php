<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 14:15:59
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 14:22:02
 */
namespace app\api\model;

use app\api\model\BaseModel;

class User extends BaseModel
{	
	public function address(){
		return $this->hasOne('UserAddress','user_id','id');
	}

	public static function getByOpenId($openid){
		$user = self::where('openid','=',$openid)->find();
		return $user;
	}
}