<?php
class common_model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'account';
	}

	/**
	 * 判断用户是否激活过
	 * @param string $game_id		激活码
	 * @param string $user_name		用户名
	 * @param false:未激活  ture：已激活
	 */
	public function checkUserActivation($game_id,$user_name){
		$sql = "select flag from active_code where game_id='$game_id' and user_name='$user_name' limit 1 ";
		$result = $this->execQuery($sql);
		return empty($result)?false:true;
	}
	
	/**
	 * 判断用户或激活码是否可用
	 * @param string $game_id		游戏id
	 * @param string $user_name		用户名
	 * @param $card_no				激活码
	 */
	public function checkActivation($game_id,$user_name,$card_no){
		$sql = "select flag from active_code where card_no = '$card_no' or (game_id='$game_id' and user_name='$user_name')";
		$result = $this->execQuery($sql);
		if($result){
			$isAct = $result[0]['flag'] > 0 ? true : false;
			return $isAct;
		}else {
			return false;//激活码不存在。
		}
	}
	
	/**
	 * 判断激活码是否使用过
	 * @param string $card_no		激活码
	 */
	public function checkActivationCode($card_no){
		$sql = "select flag from active_code where  card_no='$card_no'";
		$result = $this->execQuery($sql);
		if($result){
			$isAct = $result[0]['flag'] > 0 ? true : false;
			return $isAct;
		}
		return true;//不存在的激活码，当做已使用过处理
	}
	/**
	 * 激活账号
	 * @param string $card_no		激活码
	 * @param string $user_name		用户名
	 * @param string $active_ip		IP地址
	 * @param int $game_id			游戏ID
	 */
	public function activation($card_no, $user_name, $active_ip, $game_id){
		$time = date("Y-m-d H:i:s");
		$sql = "update active_code set user_name = '$user_name' ,active_time='$time',active_ip='$active_ip',flag=1
				where card_no = '$card_no'";
		return $this->execUpdate($sql);
	}

}
?>