<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 09:32:04
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 11:48:40
 */

namespace app\api\model;

use think\Db;
use think\Exception;
use app\api\model\BaseModel;

class Theme extends BaseModel
{	
	protected $hidden =['update_time','delete_time','topic_img_id','head_img_id'];

	public function topicImg(){
		return $this->belongsTo('Image','topic_img_id','id');
	}

	public function headImg(){
		return $this->belongsTo('Image','head_img_id','id');
	}

	public function products(){
		return $this->belongsToMany('product','theme_product','product_id','theme_id');
	}

	public static function getThemeWithProducts($id){
		$theme = self::with(['products','topicImg','headImg'])->find($id);
		return $theme;
	}
}