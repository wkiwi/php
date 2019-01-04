<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 14:41:03
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-03 15:45:23
 */
namespace app\api\model;

use think\Db;
use think\Exception;
use think\Model;

class Banner extends Model
{
	protected $table ='banner';
	public static function getBannerByID($id){
		// $result = Db::query('select * from banner_item where banner_id = ?',[$id]);
		$result = Db::table('banner_item')->where('banner_id', '=', $id)->select();
		return $result;
	}
}