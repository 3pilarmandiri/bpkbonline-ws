<?php 
class log_tm extends CI_Model {
	function log_tm(){
		parent::__construct();
	}


	function get_data_kecamatan(){
		$this->db->order_by("kecamatan");
		$res = $this->db->get("tiger_kecamatan");
		return $res;
	}

	function get_data_desa($id_kecamatan) {

		$sql=" select xx.* from  (select d.*,count(ls.id_desa) as jumlah  from tiger_desa d 
				left join (select * from log_sending where  year(waktu_mulai) = '2015' ) ls 

				on d.id = ls.id_desa
				group by d.id) xx where xx.id_kecamatan = '$id_kecamatan'";
		
		//$this->db->where("id_kecamatan",$id_kecamatan);
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		return $res;
	}
}

?>