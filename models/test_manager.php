<?php

class test_manager extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'test';
	}
	public function getList(){
		return $this->getAll();
	}
}
