<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-08 09:34:28
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:06:41
 */
namespace app\lib\exception;

class CategoryException extends BaseException
{
	public $code =404;
	public $msg = '指定类目不存在,请检查参数';
	public $errorCode = 50000;
}