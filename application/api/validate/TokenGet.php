<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 11:46:24
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 14:14:15
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class TokenGet extends BaseValidate
{
	protected $rule = [
		'code' => 'require|isNotEmpty'
	];

	protected $message = [
		'code' => 'code不能为空'
	];
}