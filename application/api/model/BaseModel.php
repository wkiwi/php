<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-06 17:11:55
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-06 17:18:01
 */
namespace app\api\model;

use think\Model;

class BaseModel extends Model
{

	protected function prefixImgUrl($value,$data){
		$finalUrl = $value;
		if($data['from'] == 1){
			$finalUrl = config('setting.img_prefix').$value;
		}
		return $finalUrl;
	}
}