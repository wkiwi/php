<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 15:08:22
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 15:28:09
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class Count extends BaseValidate
{
	protected $rule = [
		'count' => 'isPositiveInteger|between:1,15'
	];

	protected $message = [
		'count' => 'count必须是正整数,且只能在1-15之间'
	];
}