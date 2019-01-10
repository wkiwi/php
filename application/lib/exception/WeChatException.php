<?php

/**
 * @Author: wangzhen
 * @Date:   2019-01-08 15:07:59
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:07:46
 */
namespace app\lib\exception;


class WeChatException extends BaseException
{
	public $code =400;
	public $msg = '微信服务器接口调用失败';
	public $errorCode = 999;
}