<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 11:19:25
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 10:13:19
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

	protected function isPositiveInteger($value,$rule ='',$data='',$field='') {
		if(is_numeric($value) && is_int($value + 0) && ($value+ 0) > 0) {
			return true;
		}else {
			return false;
			// return $field.'必须是正整数';
		}
	}
}