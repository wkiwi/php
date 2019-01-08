<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 09:29:53
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 10:58:17
 */

namespace app\api\model;

use app\api\model\BaseModel;

class Product extends BaseModel
{	
	protected $hidden =['create_time','update_time','delete_time','pivot','from','category_id'];

	public function getMainImgUrlAttr($value,$data){
		return $this->prefixImgUrl($value,$data);
	}

	public static function getMostRecent($count){
		$products = self::limit($count)->order('create_time desc')->select();
		return $products;
	}

	public static function getProductsByCategoryId($categoryId){
		$products = self::where('category_id','=',$categoryId)->select();
		return $products;
	}
}