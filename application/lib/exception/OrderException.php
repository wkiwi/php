<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 11:04:47
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:06:21
 */
namespace app\lib\exception;

class OrderException extends BaseException
{
	public $code =404;
	public $msg = '订单信息不存在，请检查ID';
	public $errorCode = 80000;
}