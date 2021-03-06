<?php

/**
 * @Author: wkiwi
 * @Date:   2019-01-10 10:22:54
 * @Last Modified by:   wkiwi
 * @Last Modified time: 2019-01-18 17:29:36
 */
namespace app\api\service;

use app\lib\exception\OrderException;
use app\lib\exception\UserException;
use app\api\model\UserAddress;
use app\api\model\Product;
use app\api\model\Order as OrderModel;
use app\api\model\OrderProduct;
use think\Exception;
use app\api\service\Token;
use think\Db; 
class Order extends Token
{	
	//订单的商品列表，也就是客户端传递过来的product参数
	protected $oProducts;
	//真实的商品信息（包含库存量）
	protected $Products;

	protected $uid;

	public function place($uid, $oProducts){
		//oProducts和Products 做对比
		//Products从数据库中取出来
		$this->oProducts = $oProducts;
		$this->Products = $this->getProductsByOrder($oProducts);
		$this->uid = $uid;
		$status = $this->getOrderStatus();
		if(!$status['pass']){
			$status['order_id'] = -1;
			return $status;
		}
		//开始创建订单
		$orderSnap = $this->snapOrder($status);
		$order = $this->createOrder($orderSnap);
		$order['pass'] = true;
		return $order;
	}

	//生成订单
	private function createOrder($snap){
		Db::startTrans();
		try {
			$orderNo = $this->makeOrderNo();
			$order = new OrderModel();
	        $order->user_id = $this->uid;
	        $order->order_no = $orderNo;
	        $order->total_price = $snap['orderPrice'];
	        $order->total_count = $snap['totalCount'];
	        $order->snap_img = $snap['snapImg'];
	        $order->snap_name = $snap['snapName'];
	        $order->snap_address = $snap['snapAddress'];
	        $order->snap_items = json_encode($snap['pStatus']);
	        $order->save();

	        $orderID = $order->id;
	        $create_time = $order->create_time;

	        foreach ($this->oProducts as &$p) {
	        	$p['order_id'] = $orderID;
	        }
	        $orderProduct = new OrderProduct();
	        $orderProduct->saveAll($this->oProducts);
	        Db::commit();
	        return [
	                'order_no' => $orderNo,
	                'order_id' => $orderID,
	                'create_time' => $create_time
	            ];
            } 
        catch (Exception $ex) {
        	Db::rollback();
        	throw $ex;
        }
	}
	//生成订单编号
	public static function makeOrderNo(){
        $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
        $orderSn = $yCode[intval(date('Y')) - 2017] . strtoupper(dechex(date('m'))) . date('d') 
        			. substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
        return $orderSn;
    }
	//生成订单快照
	private function snapOrder($status){
		$snap = [
			'orderPrice' => 0,
			'totalCount' => 0,
			'pStatus' => [],
			'snapAddress' => null,
			'snapName' => '',
			'snapImg' => ''
		];
		$snap['orderPrice'] = $status['orderPrice'];
		$snap['totalCount'] = $status['totalCount'];
		$snap['pStatus'] = $status['pStatusArray'];
		$snap['snapAddress'] = json_encode($this->getUserAddress());
		$snap['snapName'] = $this->Products[0]['name'];
		$snap['snapImg'] = $this->Products[0]['main_img_url'];

		if(count($this->Products) > 1){
			$snap['snapName'] = $snap['snapName'].'等';
		}
		return $snap;
	}

	//获取用户收获地址
	private function getUserAddress(){
		$userAddress = UserAddress::where('user_id', '=', $this->uid)->find();
		if(!$userAddress){
			throw new UserException([
				'msg' => '用户收获地址不存在，下单失败！',
				'errorCode' => 60001
			]);
		}
		return $userAddress->toArray();
	}
	//支付时再次进行库存检测
	public function checkOrderStock($orderID){
		$oProducts = OrderProduct::where('order_id', "=", $orderID)->select();
		$this->oProducts = $oProducts;
		$this->Products = $this->getProductsByOrder($oProducts);
		$status = $this->getOrderStatus();
		return $status;
	}
	//查看订单状态
	private function getOrderStatus(){
		$status = [
			'pass' => true,
			'orderPrice' => 0,
			'totalCount' => 0,
			'pStatusArray' => []
		];
		foreach($this->oProducts as $oProduct) {
			$pStatus = $this->getProductStatus($oProduct['product_id'],$oProduct['count'],$this->Products);
			if(!$pStatus['haveStock']){
				$status['pass'] = false;
			}
			$status['orderPrice'] += $pStatus['totalPrice'];
			$status['totalCount'] += $pStatus['counts'];
			array_push($status['pStatusArray'],$pStatus);
		}
		return $status;
	}
	//查看单个商品库存量是否可以下单
	private function getProductStatus($oPID, $oCount, $products){
		$pIndex = -1;

		$pStatus = [
			'id' => null,
			'haveStock' => false,
			'counts' => 0,
			'name' => '',
			'totalPrice' => 0,
			'main_img_url'=>null
		];
		for($i=0; $i<count($products); $i++){
			if($oPID == $products[$i]['id']){
				$pIndex = $i;
			}
		}
		if($pIndex == -1){
			throw new OrderException([
				'msg' => 'id为'.$oPID.'商品不存在，创建订单失败'
			]);
		}else{
			$product = $products[$pIndex];
			$pStatus['id'] = $product['id'];
			$pStatus['name'] = $product['name'];
			$pStatus['counts'] = $oCount;
			$pStatus['price'] = $product['price'];
			$pStatus['main_img_url'] = $product['main_img_url'];
			$pStatus['totalPrice'] = $product['price'] * $oCount;
			if($product['stock'] - $oCount >= 0){
				$pStatus['haveStock'] = true;
			}
		}
		return $pStatus;
	}

	//根据订单信息查找真实商品信息
	private function getProductsByOrder($oProducts){
		$oPIDs = [];
		foreach($oProducts as $item){
			array_push($oPIDs,$item['product_id']);
		}
		$products = Product::all($oPIDs)->visible(['id','price','stock','name','main_img_url'])->toArray();
		return $products;
	}
}