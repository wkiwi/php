<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-22 09:58:43
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-22 10:09:47
 */
namespace app\api\behavior;

use think\Response;

class CORS
{
    public function appInit(&$params)
    {
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: token,Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: POST,GET');
        if(request()->isOptions()){
            exit();
        }
    }
}
//php think potimize:schema