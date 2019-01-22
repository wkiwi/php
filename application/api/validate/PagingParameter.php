<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-11 17:37:59
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-11 17:39:41
 */
namespace app\api\validate;

use app\api\validate\BaseValidate;

class PagingParameter extends BaseValidate
{
	protected $rule = [
        'page' => 'isPositiveInteger',
        'size' => 'isPositiveInteger'
    ];

    protected $message = [
        'page' => '分页参数必须是正整数',
        'size' => '分页参数必须是正整数'
    ];
}