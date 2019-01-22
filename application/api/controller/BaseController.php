<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 09:28:42
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-11 09:17:21
 */
namespace app\api\controller;

use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
	//用户与管理员都可访问接口权限s
	protected function checkPrimaryScope(){
		TokenService::needPrimaryScope();
	}
	//只有用户才能访问接口权限
	protected function checkExclusiveScope(){
		TokenService::needExclusiveScope();
	}
}