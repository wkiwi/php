<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 15:28:08
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-02 16:58:04
 */
namespace app\lib\exception;

use think\Exception;

class BaseException extends Exception
{
	//http 状态码 404,200
	public $code = 400;

	//http 错误具体信息
	public $msg = 'invalid parameters';

	//http 自定义错误码
	public $errorCode = 10000;

}
