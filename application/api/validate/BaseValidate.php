<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 11:19:25
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-03 09:58:05
 */
namespace app\api\validate;

use think\Validate;
use think\Request;
use think\Exception;
use app\lib\exception\ParameterException;
class BaseValidate extends Validate
{
	public function goCheck(){
		//获取http传入参数
		//对这些参数进行校验
		$request = Request::instance();
		$params = $request->param();

		$result = $this->batch()->check($params);
		if(!$result){
			$e = new ParameterException([
				'msg' => $this->error
			]);
			throw $e;
		}else{
			return true;
		}
	}
}