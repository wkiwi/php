<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-08 09:34:28
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 09:35:38
 */
namespace app\lib\exception;

class CategoryException extends BaseException
{
	public $code ='404';
	public $msg = '指定类目不存在,请检查参数';
	public $errorCode = '50000';
}