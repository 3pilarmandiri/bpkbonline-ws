<?php 
class polda_m extends CI_Model {
	function polda_m(){
		parent::__construct();
	}


	function get_arr_kec(){
		$this->db->order_by("kecamatan");
		$res = $this->db->get("tiger_kecamatan");

		$arr = array();
		foreach($res->result() as $row) : 
			$arr[$row->id] = $row->kecamatan;
		endforeach;
		return $arr;
	}
}

?>