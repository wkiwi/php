<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 17:04:12
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 09:40:43
 */
namespace app\api\service;

use think\Exception;
use app\lib\exception\WeChatException;
use app\lib\exception\TokenException;
use app\api\model\User as UserModel;
use think\Request;
use think\Cache;
use app\lib\enum\ScopeEnum;
use app\lib\exception\ForbiddenException;

class  Token
{	
	public static function generateToken(){
		//32个字符组成一组堆积字符串
		$randChars = getRandChar(32);
		//用三组字符串，进行md5加密
		$timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
		//salt 盐
		$salt = config('secure.token_salt');

		return md5($randChars . $timestamp . $salt);
	}

	public static function getCurrentTokenVar($key){
		$token = Request::instance()->header('token');
		$vars = Cache::get($token);
		if(!$vars){
			throw new TokenException();
		}else {
			if(!is_array($vars)){
				$vars = json_decode($vars,true);
			}
			if(array_key_exists($key, $vars)){
				return $vars[$key];
			}else{
				throw new Exception('尝试获取的token变量并不存在');
			}
		}
	}

	public static function getCurrentUid(){
		$uid = self::getCurrentTokenVar('uid');
		return $uid;
	}
	//用户与管理员都可访问接口权限
	public static function needPrimaryScope(){
		$scope = self::getCurrentTokenVar('scope');
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
	//只有用户才能访问接口权限
	public static  function needExclusiveScope(){
		$scope = self::getCurrentTokenVar('scope');
		if($scope){
			if($scope == ScopeEnum::User){
				return true;
			}else {
				throw new ForbiddenException();
			}
		}else{
			throw new TokenException();
		}
	} 
}