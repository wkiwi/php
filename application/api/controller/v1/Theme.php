<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-07 09:26:22
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-07 17:22:26
 */

namespace app\api\controller\v1;

use app\api\validate\IDCollection;
use app\api\model\Theme as ThemeModel;
use app\lib\exception\ThemeException;
use app\api\validate\IDMustBePostiveInt;
class Theme
{
	/**
	 * @url /theme?id=id1,id2,id3,...
	 * @http GET
	 * @ return 一组theme模型
	 */

	public function getSimpleList($ids=''){
		(new IDCollection())->goCheck();
		$ids = explode(',',$ids);
		$result = ThemeModel::with('topicImg','headImg')->select($ids);
		if($result->isEmpty()){
			throw new ThemeException();
		}
		return $result;
	}

	/**
	 * @url /theme/:id
	 * @http GET
	 * @ return theme内容
	 */
	public function getComplexOne($id){
		(new IDMustBePostiveInt())->goCheck();
		$theme = ThemeModel::getThemeWithProducts($id);
		if(!$theme){
			throw new ThemeException();
		}
		return $theme;
	}
}