<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* Author: Jorge Torres
 * Description: Login model class
 */
class MGeneral extends CI_Model{
	var $table;
	function __construct(){
		parent::__construct();
	}
	
	public function UpdateObjectRelated($object_related,$object_id, $old_worker_id, $new_worker_id){
		foreach ($object_related as $table) {
			$this->db->where($object_id, $old_worker_id);
      		$this->db->update($table, array($object_id=>$new_worker_id));
		}
	}
	public function Backup($pathToSave){
		sqlsrv_configure("WarningsReturnAsErrors", 0);
		$connectionInfo = array(
			"Database" => $this->db->database,
			"UID" => $this->db->username,
			"PWD" => $this->db->password
		);
		$conn = sqlsrv_connect($this->db->hostname, $connectionInfo);
		$query="BACKUP DATABASE ".$this->db->database." TO DISK='$pathToSave' WITH FORMAT, INIT, SKIP, STATS = 10";
		if ( ($stmt = sqlsrv_query($conn, $query)) )
		{
			do 
			{
			} while ( sqlsrv_next_result($stmt) ) ;
			sqlsrv_free_stmt($stmt);
		}else{
			die(print_r(sqlsrv_errors())); 
		}
		sqlsrv_configure("WarningsReturnAsErrors", 1);
	}
}
?>
