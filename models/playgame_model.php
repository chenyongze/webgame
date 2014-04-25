<?php

class playgame_model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'play_game';
	}
	
	/**
	 * 记录游戏首登
	 * 
	 * @param $user			array 用户信息
	 * @param $game_id		游戏ID 
	 * @param $server_id	服务器ID
	 */
	public function login_first($user, $game_id, $server_id) {
		$table	= 'game_login_first_'.$game_id;
		$time	= date('Y-m-d H:i:s');
		$coop_id= empty($user['coop_id'])?0:$user['coop_id'];
		$rs = $this->from($table)->getOne('*', array('account_id'=>$user['account_id'],'server_id'=>$server_id));
		
		if(empty($rs)){//首次登陆游戏
			$data = array(
				'account_id'	=> $user['account_id'],
				'account'		=> $user['account'],
				'server_id'		=> $server_id,
				'login_time'	=> $time,
				'coop_id'		=> $coop_id,
				'from_id'		=> empty($user['from_id'])?0:$user['from_id']
			);
			$this->from($table)->insert($data);
		}
	}
	
	/**
	 * 更新我玩过的游戏 只记录7个游戏服务器
	 * @param	array	用户信息
	 * @param	int		服务器id
	 * @return	bool
	 */
	public function update_playgame($user, $game_id, $server_id)
	{
		// 删除用户玩过的游戏记录
		//$this->cache->del('user_playgame_'.$user['user_id']);
		$playgame = $this->from('play_game')->getOne('*', array('account_id'=>$user['account_id'], 'server_id'=>$server_id));
		
		if ($playgame) {
			$playgame['play_time'] = date('Y-m-d H:i:s');
			
			//更新最新玩过服务器缓存
			$this->cache->set(LAST_PLAY.$user['account_id'], $playgame);
			
			//更新时间
			return $this->update(array('play_time'=>$playgame['play_time']), array('id'=>$playgame['id']));
		}
		
		//一个用户7条数据
		$temp = $this->by('play_time', 'asc')->getAll('*', array('account_id'=>$user['account_id']));
		if(count($temp) >= 7)
			$this->delete(array('id'=>$temp[0]['id']));
			
		//插入玩过的游戏信息
		$data = array ('account_id' => $user ['account_id'], 
					   'account' 	=> $user ['account'], 
					   'game_id' 	=> $game_id, 
					   'server_id' 	=> $server_id, 
					   'play_time' 	=> date ( 'Y-m-d H:i:s' )
					  );

		$data['id'] = $this->from('play_game')->insert($data);

		//更新最新玩过服务器缓存
		$this->cache->set(LAST_PLAY.$user['account_id'], $data);
		
		return $data['id'];
	}
	
	/**
	 * 更新玩游戏日志
	 * @param	array	用户信息
	 * @param	int		服务器ID
	 * @param	int		游戏ID
	 * @return	bool
	 */
	public function update_playgame_log($user, $game_id, $server_id,$ip='')
	{
		$date = date('Y-m-d');
		$ip	  = ip2long($ip);
		$sql = " select * from play_game_log where account_id = {$user['account_id']} 
				 and server_id = {$server_id}
				 and login_time > '{$date}' limit 1 ";
		$rs = $this->execQuery($sql);
		if(!empty($rs)){
			//数据已存在  更新今天最后登陆时间，登陆次数
			return $this->from('play_game_log')->update(array('login_time'=>date('Y-m-d H:i:s'),'login_ip'=>$ip,'login_times'=>$rs[0]['login_times']+1), array('id'=>$rs[0]['id']));
		}else {
			//添加新记录
			$data = array('account_id'	=> $user['account_id'],
						  'account'		=> $user['account'], 
						  'from_id'		=> empty($user['from_id'])?0:$user['from_id'], 
						  'game_id'		=> $game_id, 
						  'server_id'	=> $server_id, 
						  'login_time'	=> date('Y-m-d H:i:s'),
						  'login_times' => 1,
						  'reg_time'	=> $user['reg_time'],
						  'login_ip'	=> $ip,
						  'cooper_id' 	=> empty ( $user ['coop_id'] ) ? 0 : $user ['coop_id'] 
				);
			return	$this->from('play_game_log')->insert($data);
		}
	}
	
	/**
	 * 最后玩过的服务器
	 * @param	int		用户id
	 * @return	array
	 */
	public function get_last_playgame($uid)
	{
		return $this->from('play_game')->by('play_time')->getOne('*', array('account_id'=>$uid), LAST_PLAY.$uid, 3600*12);
	}
	
}
