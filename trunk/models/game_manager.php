<?php

class game_manager extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'games';
	}
	
	public function get_game($game_id)
	{
		return $this->getOne('*', array('game_id'=>$game_id), GAME_INFO_.$game_id);
	}
	
	public function get_allgame()
	{
		return $this->getAll("*", array(),GAME_ALL);
	}
}
