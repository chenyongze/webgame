<?php
	// 实例化数据库
	$root = realpath(dirname(__FILE__)."/../");
	require_once($root.'/config/config.db.php');
	require_once($root.'/config/functions.php');
//	require_once('cdatabase.php');
	$config_db = $config_db;
	
	$mysqli = new mysqli($config_db['master']['dbhost'], $config_db['master']['username'], $config_db['master']['password'], $config_db['master']['dbname']);
	
	if ($mysqli->connect_error) {
		exit();
	}
	$db = $mysqli;
	$db->query("SET NAMES utf8");
	$yesterday = date('Y-m-d' , strtotime('-1 day'));
	$del_sql 	= " delete from play_game_log_bak where login_time > '$yesterday'; ";
	$indser_sql = " insert into play_game_log_bak(account_id,account,game_id,server_id,from_id,login_times,reg_time,login_time,cooper_id)
			select account_id,account,game_id,server_id,from_id,login_times,reg_time,login_time,cooper_id
			from play_game_log where login_time > '{$yesterday}'; ";
	$del_yesterday_sql = " delete from play_game_log where login_time < '$yesterday'; ";
	
//	echo $del_sql.$indser_sql.$del_yesterday_sql;
	$db->query($del_sql);
	$db->query($indser_sql);
	$db->query($del_yesterday_sql);
	
	$db->close();
?>