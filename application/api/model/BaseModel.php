<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-06 17:11:55
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 10:37:10
 */
namespace app\api\model;

use think\Model;

class BaseModel extends Model
{

	public function prefixImgUrl($value,$data){
		$finalUrl = $value;
		if($data['from'] == 1){
			$finalUrl = config('setting.img_prefix').$value;
		}
		return $finalUrl;
	}
}