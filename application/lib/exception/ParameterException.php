<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 17:39:19
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-02 17:46:45
 */
namespace app\lib\exception;

class ParameterException extends BaseException
{
	public $code =400;
	public $msg ='参数错误';
	public $errorCode = 10000;
}