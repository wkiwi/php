<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-03 15:58:28
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-06 17:22:43
 */
namespace app\api\model;

use app\api\model\BaseModel;

class BannerItem extends BaseModel
{
	protected $hidden =['id','img_id','banner_id','update_time','delete_time'];
	
	public function img(){
		return $this->belongsTo('Image','img_id','id');
	}
}