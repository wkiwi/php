<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-08 09:22:45
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-08 09:36:20
 */
namespace app\api\controller\v1;

use app\api\model\Category as CategoryModel;
use app\lib\exception\CategoryException;
class Category
{
	/**
	 * 获取分类
	 * @url recent
	 * @http GET
	 */
	public function getAllCategories(){
		$categories = CategoryModel::all([],'img');
		if($categories->isEmpty()){
			throw new CategoryException();
		}
		return $categories;
	}
}