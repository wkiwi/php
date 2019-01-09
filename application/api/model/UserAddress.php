<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 14:23:16
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 15:01:53
 */
namespace app\api\model;

use app\api\model\BaseModel;

class UserAddress extends BaseModel
{	
	protected $hidden =['id','delete_time','user_id'];
}