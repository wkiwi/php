<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 15:33:58
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-22 09:28:27
 */
namespace app\api\model;

use app\api\model\BaseModel;

class Order extends BaseModel
{
	protected $hidden =['user_id','update_time','delete_time'];
	protected $autoWriteTimestamp = true;
	// protected $createTime = 'create_timestamp'; 更换字段

	public function getSnapItemsAttr($value){
		if(empty($value)){
			return null;
		}
		return json_decode($value);
	}

	public function getSnapAddressAttr($value){
		if(empty($value)){
			return null;
		}
		return json_decode($value);
	}

	public static function getSummaryByUser($uid, $page=1, $size=15){
		$pagingData = self::where('user_id', '=', $uid)->order('create_time desc')->paginate($size,true,['page' => $page]);
		return $pagingData;
	}

	public static function getSummaryByPage($page=1, $size=20){
        $pagingData = self::order('create_time desc')->paginate($size, true, ['page' => $page]);
        return $pagingData;
    }
    public function delivery($id){
        (new IDMustBePositiveInt())->goCheck();
        $order = new OrderService();
        $success = $order->delivery($id);
        if($success){
            return new SuccessMessage();
        }
    }
}