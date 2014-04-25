<?php
class member_model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'jd_demo';
	}

	public function test()
	{
		$sql = "delete from jd_demo where id=8";
		$where = array('id'=>8);
		return $this->delete('jd_demo',$where);

	}
	
}
?>
