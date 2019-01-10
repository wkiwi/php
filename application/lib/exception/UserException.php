<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 14:15:06
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 15:12:29
 */
namespace app\lib\exception;


class UserException extends BaseException
{
	public $code =404;
	public $msg = '用户不存在';
	public $errorCode = 60000;
}