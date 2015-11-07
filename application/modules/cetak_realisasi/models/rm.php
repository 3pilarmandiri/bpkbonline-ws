<?php
class rm extends CI_Model {
	function __construct(){
		parent::__construct();
	}

	

function generate_pendapatan($periode,$tanggal=null){
	

	$sql="delete from tmp_laporan_pendapatan";
	$res = $this->db->query($sql);

	$sql="INSERT INTO tmp_laporan_pendapatan SELECT  *,NULL FROM perubahan_pendapatan 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);

	// echo $this->db->last_query(); exit;
	 

	$this->db->select('id_akun_pendapatan,SUM(total) AS total',false);
	$this->db->from("buku_kas");
	$this->db->where("year(tanggal) = $this->tahun",null,false);
	$this->db->where("id_desa",$this->id_desa);
	if($periode<>'y'){
			$angka = $this->cm->periode_to_bulan($periode,1);
			extract($angka);
			if($awal == 'b') {
				$this->db->where("month(tanggal) = $akhir",null,false);
			}
			else {
				$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
			}
	}
	$this->db->where("jenis","m");
	$this->db->group_by("id_akun_pendapatan");
	$res = $this->db->get();
	//echo $this->db->last_query();

	foreach($res->result() as $row) :
		$this->db->where("id",$row->id_akun_pendapatan);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->where("tahun",$this->tahun);
		$this->db->update("tmp_laporan_pendapatan",array("jumlah"=>$row->total));
		//echo $this->db->last_query()."<br />";
	endforeach;

}

function generate_belanja($periode,$tanggal=null){
	

	$sql="delete from tmp_laporan_belanja";
	$res = $this->db->query($sql);

	$sql="INSERT INTO tmp_laporan_belanja SELECT  *,NULL FROM perubahan_belanja 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);
	// echo $this->db->last_query()."<br />"; exit;

	$this->db->select('id_akun_belanja,SUM(total) AS total',false);
	$this->db->from("buku_kas");
	$this->db->where("year(tanggal) = $this->tahun",null,false);
	$this->db->where("id_desa",$this->id_desa);
	if($periode<>'y'){
			$angka = $this->cm->periode_to_bulan($periode,1);
			extract($angka);
			if($awal == 'b') {
				$this->db->where("month(tanggal) = $akhir",null,false);
			}
			else {
				$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
			}
	}
	$this->db->where("jenis","k");
	$this->db->group_by("id_akun_belanja");
	$res = $this->db->get();
	//echo $this->db->last_query();

	foreach($res->result() as $row) :
		$this->db->where("id",$row->id_akun_belanja);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->where("tahun",$this->tahun);
		$this->db->update("tmp_laporan_belanja",array("jumlah"=>$row->total));
		// echo $this->db->last_query()."<br />";
	endforeach;

}


function generate_pembiayaan($periode,$tanggal=null){
	

	$sql="delete from tmp_laporan_pembiayaan";
	$res = $this->db->query($sql);

	$sql="INSERT INTO tmp_laporan_pembiayaan SELECT  *,NULL FROM perubahan_pembiayaan 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);
	// echo $this->db->last_query();

	$this->db->select('id_akun_pembiayaan,SUM(total) AS total',false);
	$this->db->from("t_pembiayaan");
	$this->db->where("id_desa",$this->id_desa);
	$this->db->where("year(tanggal) = $this->tahun",null,false);
	if($periode<>'y'){
			$angka = $this->cm->periode_to_bulan($periode,1);
			extract($angka);
			if($awal == 'b') {
				$this->db->where("month(tanggal) = $akhir",null,false);
			}
			else {
				$this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
			}
	}
	// $this->db->where("jenis","k");
	$this->db->group_by("id_akun_pembiayaan");
	$res = $this->db->get();
	// echo $this->db->last_query(); exit;

	foreach($res->result() as $row) :
		$this->db->where("id",$row->id_akun_pembiayaan);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->where("tahun",$this->tahun);
		$this->db->update("tmp_laporan_pembiayaan",array("jumlah"=>$row->total));
		//echo $this->db->last_query()."<br />";
	endforeach;

}

	function get_record_pendapatan() {
		 
		$this->db->where("tahun",$this->tahun);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->order_by("kode1,kode2,kode3,kode4,kode5");
		$res  = $this->db->get("tmp_laporan_pendapatan");
		return $res;



	}

	function get_record_belanja() {
		 
		$this->db->where("tahun",$this->tahun);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->order_by("kode1,kode2,kode3,kode4,kode5,kode6");
		$res  = $this->db->get("tmp_laporan_belanja");
		return $res;



	}

	function get_record_pembiayaan() {
		 
		$this->db->where("tahun",$this->tahun);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->order_by("kode1,kode2,kode3,kode4,kode5");
		$res  = $this->db->get("tmp_laporan_pembiayaan");
		return $res;



	}
 


 function hitung_saldo(){

 	$sql=" 	SELECT SUM(jumlah) as jumlah FROM tmp_laporan_pendapatan 
WHERE has_child IS NULL ";
$data = $this->db->query($sql)->row();
$pendapatan = $data->jumlah;

$sql="SELECT SUM(jumlah) as jumlah FROM tmp_laporan_belanja
WHERE has_child IS NULL";
$data = $this->db->query($sql)->row();
$belanja = $data->jumlah;

$saldo = $pendapatan - $belanja;

$sql="SELECT id, SUBSTR(id,1,3)  AS id2,  jumlah FROM tmp_laporan_pembiayaan
WHERE has_child IS NULL  ";

$res = $this->db->query($sql);
foreach($res->result() as $row) : 

	if($row->id2 == "3_1") {
		$saldo += $row->jumlah;
	}
	else {
		$saldo -= $row->jumlah;
	}


endforeach;


return $saldo;
 }


}
?>