<?php
/*
 * 测试IP
	122.224.103.244
	
	测试登陆key
	LoginKey=123456789asdfghjklmn
	
	测试充值key1
	key1=QWERTYUIOPASDFGHJKLM
	充值
	key2=2wncx19yN6LKAPw2zlMD 

 */
class Jd_charge extends controllers  
{
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
	    
	    //---------向游戏充值-----------
	    $url		= str_replace("{n}", $server_rs['number'], $game_rs['payurl']);//支付接口地址
		//测试URL
		if($accname == "wow_002"){ //测试账号 走测试服务器
	    	$url = 'http://122.224.103.244:8080';
		}
		header("Content-Type: text/html; charset=utf-8");
		
		$url = rtrim($url,"/")."/War/webservice/PayWS?wsdl";
		try{
			$client = new SoapClient($url);
		}catch (Exception $e){
			if($accname == "wow_001"){
				echo"<pre>";
				print_r($e);
			}else{
				return false;
			}
		}
		
		$money= floor($order_rs['to_game_amount']); //充值金额
		$key1='MXeTp9PEFeJylLhcXNCh'; //TODO: 正Key1 和key2
		$key2='2wncx19yN6LKAPw2zlMD';
		if($accname == "wow_002"){ //测试账号 走测试服务器
//			测试充值key1
			$key1='QWERTYUIOPASDFGHJKLM';
//			充值
			$key2='2wncx19yN6LKAPw2zlMD'; 
		}
		$str=$accid.$money.$key1.$key2;
		$str=strtoupper(md5($str));
		
		if(!$isRecharge){//非补单时将状态改为2
			//更新充值状态
        	$this->loadModel('payment_model')->update(array('status'=>2), array('order_no'=>$order_no));
		}
		//验证用户是否存在
        $exists=$client->isPlayerExisted(array('arg0'=>(string)$accid));
        if (!$exists->return){
        	return false;
        }
        
        //充值请求
        $rs=$client->addPlayerMoney(array('arg0'=>(string)$accid,'arg1'=>intval($money),'arg2'=>$order_no,'arg3'=>$str));
		if($isRecharge){
			var_dump($rs->return);
		}
        
		//--------------------------------
		
		//记录与游戏方的log
        $payment_log = array(
			'channel_id' => '',
			'user_id'    => $accid,
			'order_no'   => $order_no,
			'pay_time'   => time(),
			'url'        =>	$url,
			'game_info'  => $rs->return."-".$money
		);
		$this->loadModel('game_return_model')->insert($payment_log);
		if ($rs->return) {
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