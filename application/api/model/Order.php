<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 15:33:58
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-10 17:29:31
 */
namespace app\api\model;

use app\api\model\BaseModel;

class Order extends BaseModel
{
	protected $hidden =['user_id','update_time','delete_time'];
	protected $autoWriteTimestamp = true;
	// protected $createTime = 'create_timestamp'; 更换字段
}