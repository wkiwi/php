<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 10:50:20
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 10:15:57
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class IDMustBePostiveInt extends BaseValidate
{
	protected $rule = [
		'id' => 'require|isPositiveInteger'
	];

	protected $message = [
		'id' => 'id必须是正整数'
	];
}