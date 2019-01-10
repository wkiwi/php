<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 16:18:59
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:06:56
 */
namespace app\lib\exception;

class ForbiddenException extends BaseException
{
	public $code =403;
	public $msg = '您暂时没有权';
	public $errorCode = 10001;
}