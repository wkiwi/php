<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-21 17:24:20
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-21 17:25:30
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class AppTokenGet extends BaseValidate
{
	protected $rule = [
		'ac' => 'require|isNotEmpty',
		'se' => 'require|isNotEmpty',
	];
}