<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 10:39:05
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 10:41:11
 */
namespace app\lib\exception;


class ThemeException extends BaseException
{
	public $code ='404';
	public $msg = '指定主题不存在，请检查主题ID';
	public $errorCode = '30000';
}