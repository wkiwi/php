<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-09 10:15:31
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 10:55:20
 */
namespace app\api\model;

use app\api\model\BaseModel;

class ProductImage extends BaseModel
{
	protected $hidden =['img_id','delete_time','product_id','id'];
	
	public function imgUrl(){
		return $this->belongsTo('Image','img_id','id');
	}

	// public function getUrlAttr($value,$data){
	// 	return $this->prefixImgUrl($value,$data);
	// }
}