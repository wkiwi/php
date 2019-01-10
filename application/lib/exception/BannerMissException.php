<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 15:32:37
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:06:29
 */

namespace app\lib\exception;

// use app\lib\exception\BaseException;

class BannerMissException extends BaseException
{
	public $code =404;
	public $msg = '请求的banner不存在';
	public $errorCode = 40000;
}
