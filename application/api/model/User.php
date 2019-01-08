<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 14:15:59
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 17:41:25
 */
namespace app\api\model;

use app\api\model\BaseModel;

class User extends BaseModel
{	
	public static function getByOpenId($openid){
		$user = self::where('openid','=',$openid)->find();
		return $user;
	}
}