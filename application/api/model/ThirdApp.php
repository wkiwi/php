<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-21 17:30:47
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-21 17:33:53
 */

namespace app\api\model;

use app\api\model\BaseModel;

class ThirdApp extends BaseModel
{	
	public static function check($ac, $se)
    {
        $app = self::where('app_id','=',$ac)
            ->where('app_secret', '=',$se)
            ->find();
        return $app;

    }
}