<?php
class bkm extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	


	function get_data($periode,$bulan) {
		

		$this->db->where("year(tanggal) = $this->tahun",null,false);
		$this->db->where("id_desa",$this->id_desa);
		

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
		$res=$this->db->get("buku_kas");
		return $res;
	}


	function record_non_kegiatan($periode,$bulan) {
		$tahun  = $this->session->userdata("tahun_anggaran");

		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->where("year(tanggal) = $tahun",null,false);
		if($awal == 'b') {
			$this->db->where("month(tanggal) = $akhir",null,false);
		}
		else {
			$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
		}
		$this->db->where("id_kegiatan is null",null,false);
		$this->db->order_by("tanggal_bayar, uraian2");
		$res=$this->db->get("v_buku_kas_detail_pajak");
		//echo $this->db->last_query(); exit;
		return $res;
	}


	function get_kegiatan($periode,$bulan) {
// 		SELECT id_kegiatan, kegiatan, kegiatan_kode FROM 
// v_t_buku_kas 
// WHERE id_kegiatan IS NOT NULL 
		$tahun  = $this->session->userdata("tahun_anggaran");

		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->select('id_kegiatan, kegiatan, kegiatan_kode')->from("v_t_buku_kas");

		$this->db->where("year(tanggal) = $tahun",null,false);
		if($awal == 'b') {
			$this->db->where("month(tanggal) = $akhir",null,false);
		}
		else {
			$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
		}
		$this->db->where("id_kegiatan is not null");
		$this->db->order_by("id_kegiatan");
		$this->db->group_by("id_kegiatan");
		$res=$this->db->get();
		//echo $this->db->last_query();
		return $res;
	}


	function get_record_per_kegiatan($periode,$bulan,$id_kegiatan){
		$tahun  = $this->session->userdata("tahun_anggaran");

		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->where("year(tanggal) = $tahun",null,false);
		if($awal == 'b') {
			$this->db->where("month(tanggal) = $akhir",null,false);
		}
		else {
			$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
		}
		$this->db->where("id_kegiatan",$id_kegiatan);
		$this->db->order_by("tanggal_bayar,uraian2");
		$res=$this->db->get("v_buku_kas_detail_pajak");
		//echo $this->db->last_query();
		return $res;
	}


	function get_record($periode,$bulan) {
		$tahun  = $this->session->userdata("tahun_anggaran");

		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->where("year(tanggal) = $tahun",null,false);
		if($awal == 'b') {
			$this->db->where("month(tanggal) = $akhir",null,false);
		}
		else {
			$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
		}
		$this->db->order_by("tanggal_bayar,uraian2");
		$res=$this->db->get("v_buku_kas_detail_pajak");
		//echo $this->db->last_query();
		return $res;



	}


	function saldo($periode,$bulan) {
		$tahun  = $this->tahun;
		$id_desa = $this->id_desa;
		$this->db->select("SUM(masuk) , SUM(keluar), SUM(masuk) - SUM(keluar) saldo ",false)
				->from("buku_kas_detail_pajak");
		$this->db->where("id_desa");
		if($periode<>'y') { 

				$angka = $this->cm->periode_to_bulan($periode,$bulan);
				extract($angka);

			

			 
				$this->db->where("MONTH(tanggal)  <= $akhir",null,false);
		 }
		 
		$this->db->where("year(tanggal) = $tahun",null,false);

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

		if($periode=="y") {
			return 0;
		}
		$tahun  = $this->tahun;
		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->select("SUM(masuk) , SUM(keluar), SUM(masuk) - SUM(keluar) saldo ",false)
		->from("buku_kas_detail_pajak");
		$this->db->where("id_desa",$this->id_desa);

		 if($awal == 'b') {
		  	$this->db->where("month(tanggal) < $akhir",null,false);
		  }
		  else {
		$this->db->where("MONTH(tanggal)  < $awal",null,false);
		}
		 
		$this->db->where("year(tanggal) = $tahun",null,false);

		$res = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($res->num_rows()==0)
		{
			return 0;
		}
		else {
			$data = $res->row();
			return $data->saldo;
		}

	}

	function jumlah_sebelum($periode,$bulan){
		$tahun  = $this->tahun;
		$angka = $this->cm->periode_to_bulan($periode,$bulan);
		extract($angka);

		$this->db->select("SUM(masuk) as masuk , SUM(keluar) as keluar, SUM(masuk) - SUM(keluar) saldo ",false)
		->from("buku_kas_detail_pajak");
		$this->db->where("id_desa",$this->id_desa);

		 if($awal == 'b') {
		  	$this->db->where("month(tanggal) < $akhir",null,false);
		  }
		  else {
		$this->db->where("MONTH(tanggal)  < $awal",null,false);
		}
		 
		$this->db->where("year(tanggal) = $tahun",null,false);

		$res = $this->db->get();
		//echo $this->db->last_query(); exit;
		if($res->num_rows()==0)
		{
			return 0;
		}
		else {
			$data = $res->row();
			return $data;
		}
	}

	

}
?>