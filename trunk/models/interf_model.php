<?php
class interf_model extends Model
{
	public function __construct()
	{
		parent::__construct();
		$this->_tableName = 'account';
	}
	/**
	 * 查询注册用户
	 *
	 * @param  $from_id  推广来源 （站长ID）
	 * @param  $sDate	 开始日期 （注册时间）
	 * @param  $eDate	 结束日期 （注册时间）
	 * @return 
	 */
	public function getRegUser($from_id,$sDate,$eDate){
		if (!empty($from_id)) {
			$where[] = "from_id='$from_id'";
		}
		if (!empty($sDate)) {
			$where[] = "reg_time>='$sDate'";
		}
		if (!empty($eDate)) {
			$eDate = date('Y-m-d',strtotime("$eDate	+1	day"));
			$where[] = "reg_time < '$eDate'";
		}
		if (!empty($where)) {
			$wheresql = 'WHERE '.@implode(' AND ',$where);
		}
		$sql = "select from_id as PlatformID,game_id as SID,account as UserName,reg_time as RegDate,sub_code as UID,reg_ip as RegIP from account $wheresql";
		return $this->execQuery($sql);
	}
	/**
	 * 取PlatformID 平台下自定义时间范围内的cps消费数据信息
	 *
	 * @param  $from_id		推广来源 （站长ID）
	 * @param  $sDate		开始日期 （充值时间）
	 * @param  $eDate		结束日期 （充值时间）
	 * @return 
	 */
	public function getCharge($from_id,$sDate,$eDate){
		if (!empty($from_id)) {
			$where[] = "from_id='$from_id'";
		}
		if (!empty($sDate)) {
			$where[] = "pay_time>='$sDate'";
		}
		if (!empty($eDate)) {
			$eDate = date('Y-m-d',strtotime("$eDate	+1	day"));
			$where[] = "pay_time < '$eDate'";
		}
		if (!empty($where)) {
			$wheresql = 'WHERE '.@implode(' AND ',$where);
		}
		$sql = "select from_id as PlatformID,sub_code as UID,game_id as SID,account as UserName,pay_time as AddDate,money as Amount,'元' as Units,order_id as ItemNo,charger_id as AddWay from pay_order $wheresql";
		return $this->execQuery($sql);
	}
}
?>