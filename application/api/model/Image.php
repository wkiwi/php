<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-06 15:33:30
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-06 17:19:46
 */

namespace app\api\model;

use app\api\model\BaseModel;

class Image extends BaseModel
{
	protected $hidden =['id','from','update_time','delete_time'];
	public function getUrlAttr($value,$data){
		return $this->prefixImgUrl($value,$data);
	}
}