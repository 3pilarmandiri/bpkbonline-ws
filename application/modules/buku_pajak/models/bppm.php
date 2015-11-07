<?php
class bppm extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	

	function get_record($periode,$bulan) {
		$tahun  = $this->tahun;

		

		$this->db->where("year(tanggal) = $tahun",null,false);
		if($periode <> 'y') { 
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
			if($awal == 'b') {
				$this->db->where("month(tanggal) = $akhir",null,false);
			}
			else {
				$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
			}
		}		

		$this->db->order_by("tanggal");
		$this->db->where("id_desa",$this->id_desa);
		$res=$this->db->get("buku_pajak");
		//echo $this->db->last_query();
		return $res;



	}


	function saldo($periode,$bulan) {
		$tahun  = $this->tahun;

		

		$this->db->select("SUM(masuk) , SUM(keluar), SUM(masuk) - SUM(keluar) saldo ",false)
		->from("buku_bank_2");

		// if($awal == 'b') {
		// 	$this->db->where("month(tanggal) <= $akhir",null,false);
		// }
		// else {
		if($periode <> 'y') { 
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
			$this->db->where("MONTH(tanggal)  <= $akhir",null,false);
 		}
		 
		$this->db->where("year(tanggal) = $tahun",null,false);
		$this->db->where("id_desa",$this->id_desa);

		$res = $this->db->get();
		//echo $this->db->last_query();
		if($res->num_rows()==0)
		{
			return 0;
		}
		else {
			$data = $res->row();
			return $data->saldo;
		}

	}


}
?>