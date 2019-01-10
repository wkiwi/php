<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 17:31:09
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:07:28
 */
namespace app\lib\exception;


class TokenException extends BaseException
{
	public $code =401;
	public $msg = 'Token已过期或无效token';
	public $errorCode = 10001;
}