<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 11:44:27
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 17:36:56
 */
namespace app\api\controller\v1;
use app\api\validate\TokenGet;
use app\api\service\UserToken;

class Token{
	public function getToken($code = ''){
		(new TokenGet())->goCheck();
		$ut = new UserToken($code);
		$token = $ut->get();
		return [
			'token' => $token
		];
	}

}