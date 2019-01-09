<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 14:32:19
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 14:33:24
 */
namespace app\lib\exception;

class SuccessMessage extends BaseException
{
	public $code =201;
	public $msg = 'ok';
	public $errorCode = 0;
}