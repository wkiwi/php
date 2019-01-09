<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 10:19:19
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 10:27:22
 */
namespace app\api\model;

use app\api\model\BaseModel;

class ProductProperty extends BaseModel
{
	protected $hidden =['id','delete_time','product_id','update_time'];
	
}