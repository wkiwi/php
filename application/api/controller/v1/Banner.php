<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-02 09:43:23
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 17:22:06
 */


namespace app\api\controller\v1;


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

		$banner = BannerModel::getBannerByID($id);
		if (!$banner){
			throw new BannerMissException();
		}
		return $banner;
	}
}
