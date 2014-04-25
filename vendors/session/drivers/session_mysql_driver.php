<?php

class session_mysql_driver extends session
{


	protected function _init()
	{
		return true;
	}

	protected function _open($save_path, $session_name)
	{
		return true;
	}

	protected function _close()
	{
		return true;
	}

	protected function _get($key)
	{
		$rs = Model::get_instance()->from($this->sess_table)->select('*')->where(array('sessid'=>$key,'expiry >='=>time()))->_compile_select()->fetch_one();
		if ($rs) {
            return $rs['data'];
        } 
        return null;
	}

	protected function _set($key, $value)
	{
		$sql = array('sessid'=>$key,
					 'expiry'=>$this->sess_expire+time(),
					 'data'  =>$value,
					 'aid'   =>isset($_SESSION['admin_login']['uid'])?$_SESSION['admin_login']['uid']:0
					);

		if (Model::get_instance()->from($this->sess_table)->select('*')->where(array('sessid'=>$key))->_compile_select()->fetch_one())
		{
            //update
			unset($sql['sessid']);
			Model::get_instance()->from($this->sess_table)->update($sql,array('sessid'=>$key));
        }else
        {
        	//insert
			Model::get_instance()->from($this->sess_table)->insert($sql);
        }
		return true;
	}

	protected function _remove($aid)
	{
		Model::get_instance()->from($this->sess_table)->delete(array('aid'=>$aid));
	}

	protected function _destroy($key)
	{
		Model::get_instance()->from($this->sess_table)->delete(array('sessid'=>$key));
		return true;
	}

	protected function _gc()
	{
		Model::get_instance()->from($this->sess_table)->delete(array("expiry <" => time()));
		return true;
	}
}
?>