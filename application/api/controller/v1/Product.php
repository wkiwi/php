<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 15:01:11
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-09 10:23:44
 */

namespace app\api\controller\v1;

use app\api\validate\Count;
use app\api\validate\IDMustBePostiveInt;
use app\api\model\Product as ProductModel;
use app\lib\exception\ProductException;


class Product
{
	/**
	 * 获取最新商品
	 * @url recent
	 * @http GET
	 * @count 最新商品的商品个数
	 */
	public function getRecent($count=15){
		(new Count())->goCheck();
		$products = ProductModel::getMostRecent($count);

		if($products->isEmpty()){
			throw new ProductException();	
		}
		// $collection = collection($products);
		// $products = $collection->hidden(['summary']);
		$products = $products->hidden(['summary']);
		return $products;
	}

	/**
	 * 获取分类对应商品
	 * @url product/category?id=1
	 * @http GET
	 * @id 分类参数
	 */
	public function getAllInCategory($id){
		(new IDMustBePostiveInt)->goCheck();
		$products = ProductModel::getProductsByCategoryId($id);

		if($products->isEmpty()){
			throw new ProductException();	
		}
		$products = $products->hidden(['summary']);
		return $products;
	}

	/**
	 * 获取商品详情信息
	 * @url product/1
	 * @http GET
	 * @id 商品参数
	 */
	public function getOne($id){
		(new IDMustBePostiveInt)->goCheck();
		$product = ProductModel::getProductDetail($id);
		if(!$product){
			throw new ProductException();	
		}
		return $product;
	}
}
