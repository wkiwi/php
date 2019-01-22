<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-11 10:20:13
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-11 10:22:59
 */
namespace app\lib\enum;

class OrderStatusEnum 
{
	//待支付
	const UNPAID = 1;

	//已支付
	const AID = 2;

	//已发货
	const DELIVERED = 3;
	
	//已支付，但库存不足
	const PAID_BUT_OUT_OF = 4;
}