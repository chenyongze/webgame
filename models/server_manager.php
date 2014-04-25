<?php

class server_manager extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'game_servers';
	}
	
	/**
	 * 获取所有服务器
	 * @return	array
	 */
	public function get_servers()
	{
		return $this->by('number')->getAll('*', array(), SERVER_ALL);
	}
	
	/**
	 * 获取游戏服务器
	 * @param	int		游戏id
	 * @return	array
	 */
	public function get_by_gameid($game_id)
	{
		return $this->by('number')->getAll('*', array('game_id'=>$game_id),GAME_SERVERS.$game_id);
	}
	
	/**
	 * 获取游戏服务器
	 * @param	int		服务器id
	 * @return	array
	 */
	public function get_by_serverid($server_id)
	{
		return $this->getOne('*', array('server_id'=>$server_id), SER_INFO_.$server_id);
	}
	/**
	 * 查询用户最后登陆的服务器		//TODO 根据登陆情况做是否添加Memcached
	 *
	 * @param  $user_id
	 * @param  $game_id
	 * @param  $limit	记录数
	 * @return 
	 */
	public function lastLoginSer($account_id,$game_id,$limit=3){
		$sql = "select * from play_game where account_id = '{$account_id}' and game_id = '{$game_id}' order by play_time desc limit {$limit}";
		return $this->execQuery($sql);
	}
	
	/**
	 * 查询最新服务器
	 * @param $game_id		游戏ID
	 */
	public function newServer($game_id){
		$sql = "select server_id,server_name,status from game_servers where game_id = $game_id order by server_id desc limit 1";
		return $this->execQuery($sql);
	}
	
	public function get_gameServer_info($game_id){
		$sql = "select * from game_servers where game_id = $game_id order by create_time desc limit 2";
		return $this->execQuery($sql);
	}
	
	//读取游戏信息
	public function get_game_info($game_id){
		$sql = "select tip_url,noopen_url from games where game_id = $game_id";
		return $this->execQuery($sql);
	}
	
}
