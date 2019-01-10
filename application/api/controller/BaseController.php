<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 09:28:42
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 09:40:50
 */
namespace app\api\controller;

use app\api\service\Token as TokenService;
use think\Controller;

class BaseController extends Controller
{
	protected function checkPrimaryScope(){
		TokenService::needPrimaryScope();
	}
	
	protected function checkExclusiveScope(){
		TokenService::needExclusiveScope();
	}
}