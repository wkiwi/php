<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 09:51:40
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 16:35:01
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;
use app\lib\exception\ParameterException;

class OrderPlace extends BaseValidate
{
	// protected $oProducts = [
	// 	['product_id' => 1, 'count' => 3],
	// 	['product_id' => 2, 'count' => 3],
	// 	['product_id' => 3, 'count' => 3]
	// ];
	// protected $Products = [
	// 	['product_id' => 1, 'count' => 3],
	// 	['product_id' => 2, 'count' => 3],
	// 	['product_id' => 3, 'count' => 3]
	// ];

	protected $rule = [
		'products' => 'checkProducts'
	];
	protected $singleRule = [
		'product_id' => 'require|isPositiveInteger',
		'count' => 'require|isPositiveInteger',
	];
	// protected $message = [
	// 	'products' => 'code不能为空'
	// ];
	protected function checkProducts($values){
		if(empty($values)){
			throw new ParameterException([
				'msg' => '商品列表不能为空'
			]);
		}

		if(!is_array($values)){
			throw new ParameterException([
				'msg' => '商品参数不正确'
			]);
		}

		foreach($values as $value){
			$this->checkProduct($value);
		}
		return true;
	}
	protected function checkProduct($value){
		$validate = new BaseValidate($this->singleRule);
		$result = $validate->check($value);
		if(!$result){
			throw new ParameterException([
				'msg' => '商品列表参数错误'
			]);
		}
	}
}