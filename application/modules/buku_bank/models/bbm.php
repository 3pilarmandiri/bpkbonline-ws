<?php
class bbm extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	

	function get_record($periode,$bulan) {
		$tahun  = $this->tahun;
		$id_desa  = $this->id_desa;
		
		$this->db->where("id_desa",$id_desa);
		$this->db->where("year(tanggal) = $tahun",null,false);

		if($periode<>'y') { 

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
		$res=$this->db->get("buku_bank");
		//echo $this->db->last_query();
		return $res;



	}


	function saldo($periode,$bulan) {
		$tahun  = $this->tahun;
		$id_desa  = $this->id_desa;
		
		
 
		$this->db->select("SUM(masuk) , SUM(keluar), SUM(masuk) - SUM(keluar) saldo ",false)
			->from("buku_bank_2");
		$this->db->where("id_desa",$id_desa);
		if($periode<>'y') { 
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
					 
			$this->db->where("MONTH(tanggal)  <= $akhir",null,false); 		 
			
		}
		$this->db->where("year(tanggal) = '$tahun'",null,false);
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


	function saldo_sebelum($periode,$bulan) {
		$tahun  = $this->tahun;
		$id_desa = $this->id_desa;

		//$periode = $this->cm->tw_rev($periode);
		
		

		$this->db->select("SUM(masuk) , SUM(keluar), SUM(masuk) - SUM(keluar) saldo ",false)
		->from("buku_bank_2");

		if($periode<>'y') { 
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
			if($awal == 'b') {
				$this->db->where("month(tanggal) < $akhir",null,false);
			}
			else {
			$this->db->where("MONTH(tanggal)  < $awal",null,false);
			}
		}

		$this->db->where("year(tanggal) = $tahun",null,false);
		$this->db->where("id_desa",$id_desa);
		$res = $this->db->get();
		//echo $this->db->last_query();
		//exit;
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