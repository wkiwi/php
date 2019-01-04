<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 09:43:23
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-03 16:12:07
 */

namespace app\api\controller\v1;

// use think\Validate;

use app\api\validate\IDMustBePostiveInt;
use app\api\model\Banner as BannerModel;
use app\lib\exception\BannerMissException;
class Banner
{
	/**
	 * 获取指定ID的banner信息
	 * @url banner/:id
	 * @http GET
	 * @id banner 的id号
	 */
	public function getBanner($id){
		// 独立验证
		// 验证器
		// AOP面向切面编程
		(new IDMustBePostiveInt())->goCheck();

		// $banner = BannerModel::getBannerByID($id);
		$banner = BannerModel::get($id);
		// $banner = new BannerModel();
		// $banner = $banner->get($id);
		if (!$banner){
			throw new BannerMissException();
		}
		return $banner;
	}
}
