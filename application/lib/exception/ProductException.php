<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 16:43:42
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 11:07:07
 */
namespace app\lib\exception;

class ProductException extends BaseException
{
	public $code =404;
	public $msg = '指定的商品不存在，请检查参数';
	public $errorCode = 20000;
}