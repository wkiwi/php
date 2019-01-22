<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 11:44:27
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-21 17:39:18
 */
namespace app\api\controller\v1;
use app\api\validate\TokenGet;
use app\api\validate\AppTokenGet;
use app\api\service\UserToken;
use app\api\service\AppToken;
use app\lib\exception\ParameterException;
use app\api\service\Token as TokenService;

class Token{
	public function getToken($code = ''){
		(new TokenGet())->goCheck();
		$ut = new UserToken($code);
		$token = $ut->get();
		return [
			'token' => $token
		];
	}
	
	public function verifyToken($token=''){
		if(!$token){
			throw new ParameterException(['token不允许为空']);
		}
		$valid = TokenService::verifyToken($token);
		return ['isValid' => $valid];
	}
	/**
     * 第三方应用获取令牌
     * @url /app_token?
     * @POST ac=:ac se=:secret
     */
    public function getAppToken($ac='', $se='')
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET');
        (new AppTokenGet())->goCheck();
        $app = new AppToken();
        $token = $app->get($ac, $se);
        return [
            'token' => $token
        ];
    }

}