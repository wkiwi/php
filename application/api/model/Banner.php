<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 14:41:03
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-06 17:22:35
 */
namespace app\api\model;

use think\Db;
use think\Exception;
use app\api\model\BaseModel;

class Banner extends BaseModel
{	

	protected $table ='banner';
	protected $hidden =['update_time','delete_time'];
	
	public function items(){
		return $this->hasMany('BannerItem','banner_id','id');
	}


	public static function getBannerByID($id){
		$banner = self::with(['items','items.img'])->find($id);

		return $banner;
		// $result = Db::table('banner_item')->where('banner_id', '=', $id)->select();
		// return $result;
	}
}