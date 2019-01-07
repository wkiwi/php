<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 09:55:20
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 10:07:32
 */

namespace app\api\validate;

use app\api\validate\BaseValidate;

class IDCollection extends BaseValidate
{
	protected $rule = [
		'ids' => 'require|checkIDs'
	];
	protected $message = [
		'ids' => 'ids必须是单个参数或以英文逗号分隔的多个参数'
	];
	protected function checkIDs($value,$rule ='',$data='',$field='') {
		$values = explode(',',$value);
		if(empty($values)){
			return false;
		}
		foreach ($values as $id){
			if(!$this->isPositiveInteger($id)){
				return false;
			}
		}
		return true;
	}
}