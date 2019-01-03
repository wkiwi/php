<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 10:50:20
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-03 09:54:51
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class IDMustBePostiveInt extends BaseValidate
{
	protected $rule = [
		'id' => 'require|isPositiveInteger',
		'num' => 'in:1,2,3'
	];
	protected function isPositiveInteger($value,$rule ='',$data='',$field='') {
		if(is_numeric($value) && is_int($value + 0) && ($value+ 0) > 0) {
			return true;
		}else {
			return $field.'必须是正整数';
		}
	}
}