<?php
class As_charge extends controllers  
{
	/**
	 * 
	 * @param $order_no   订单号
	 * @param $isRecharge bool   true:补单
	 */
	public function charge($order_no,$isRecharge=false)
	{
		$order_status=0;		//默认状态
		if($isRecharge){
			$order_status=2;	//钱已到帐未到游戏方
		}
		$order_rs	= $this->loadModel('payment_model')->getOne('*', array('order_no'=>$order_no, 'status'=>$order_status));

		if(empty($order_rs) === TRUE) {
			return true;
		}
		$game_id	= $order_rs['game_id'];
	    $server_id	= $order_rs['server_id'];
	    $accid		= $order_rs['user_id'];
	    $accname	= $order_rs['user_name'];//获取用户name
	    $game_rs	= $this->loadModel('game_manager')->getOne('*', array('gid'=>$game_id));//获取游戏信息
	    $server_rs	= $this->loadModel('server_manager')->getOne('*', array('gsid'=>$server_id));//获取服务器信息
	    $tstamp		= time();
	    if (!$accname) {
	    	return false;
	    }
	    
		$point		= intval($order_rs['to_game_amount'] * $game_rs['money_fall_into']);//to_game_amount:游戏币金额|money_fall_into：游戏币兑换比例
	    $paykey		= strtolower(md5($order_no.$accid.$accname.$point.$tstamp.md5($game_rs['recharge_key'])));
	    $url		= str_replace("{n}", $server_rs['number'], $game_rs['payurl']);//支付接口地址
		$url		.= "pay.action?p=$order_no|$accid|$accname|$point|$tstamp|$paykey";
		
		//更新充值状态
        $this->loadModel('payment_model')->update(array('status'=>2), array('order_no'=>$order_no));
        //充值请求
		$pay_return = file_get_contents($url);
		if($isRecharge){
			var_dump($pay_return);
		}
		
		//记录与游戏方的log
        $payment_log = array(
			'channel_id' => '',
			'user_id'    => $accid,
			'order_no'   => $order_no,
			'pay_time'   => time(),
			'url'        =>	$url,
			'game_info'  => $pay_return
		);
		$this->loadModel('game_return_model')->insert($payment_log);
		if ($pay_return == "pay_succ") {
			$data = array(
            	'status'			=> 3,
		        'asynch_time'		=> date('Y-m-d H:i:s'),
                'is_game_account'	=> 1
            );
            //更新数据库
            $this->loadModel('payment_model')->update($data, array('order_no' => $order_no));
            $this->loadModel('message')->payMsg($order_no);
            return true;
	    } else {
	        return false;
	    }
	}
}