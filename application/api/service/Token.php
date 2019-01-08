<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 17:04:12
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 17:22:19
 */
namespace app\api\service;

use think\Exception;
use app\lib\exception\WeChatException;
use app\api\model\User as UserModel;
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
}