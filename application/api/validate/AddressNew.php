<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 11:16:11
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 14:58:05
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class AddressNew extends BaseValidate
{
	protected $rule = [
		'name' => 'require|isNotEmpty',
		'mobile' => 'require|isMobile',
		'province' => 'require|isNotEmpty',
		'city' => 'require|isNotEmpty',
		'country' => 'require|isNotEmpty',
		'detail' => 'require|isNotEmpty'
	];

	// protected $message = [
	// 	'count' => 'count必须是正整数,且只能在1-15之间'
	// ];
}