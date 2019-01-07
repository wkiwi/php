<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-06 17:34:26
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-06 17:39:47
 */

namespace app\api\controller\v2;


use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
class Banner
{
	public function getBanner($id){
		return 'this is version V2';
	}
}
