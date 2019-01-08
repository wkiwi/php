<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-08 09:24:32
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 09:32:50
 */
namespace app\api\model;

use app\api\model\BaseModel;

class Category extends BaseModel
{
	protected $hidden =['update_time','delete_time'];
	public function img(){
		return $this->belongsTo('Image','topic_img_id','id');
	}
}