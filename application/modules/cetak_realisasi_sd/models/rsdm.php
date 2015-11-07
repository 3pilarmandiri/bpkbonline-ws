<?php
class rsdm extends CI_Model {

var $arr = array();

	function __construct(){
		$xarr= array();
		parent::__construct();

		$res = $this->db->get("akun_pendapatan");
		foreach ($res->result() as $row ) {
			# code...
			$xarr[$row->id] = $row->nama;
		}
		$this->arr = $xarr;

	}

var $arr_pendapatan  = array("1_2_1"=>"1.2.1 Dana Desa",
							 "1_2_2"=>"1.2.2 Bagian dari Hasil Pajak dan Retribusi Daerah Kabupaten",
							 "1_2_3"=>"1.2.3 Alokasi Dana Desa (ADD)");
	

function generate_pendapatan($periode,$tanggal=null){
	

	$sql="delete from tmp_laporan_pendapatan";
	$res = $this->db->query($sql);

	$sql="INSERT INTO tmp_laporan_pendapatan SELECT  *,NULL FROM v_perubahan_pendapatan 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);
	 

	$this->db->select('id_akun_pendapatan,SUM(total) AS total',false);
	$this->db->from("v_t_buku_kas");
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

	$sql="INSERT INTO tmp_laporan_belanja SELECT  *,NULL FROM v_perubahan_belanja 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);
	// echo $this->db->last_query()."<br />";

	$this->db->select('id_akun_belanja,SUM(total) AS total',false);
	$this->db->from("v_t_buku_kas");
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

	$sql="INSERT INTO tmp_laporan_pembiayaan SELECT  *,NULL FROM v_perubahan_pembiayaan 
			where tahun=$this->tahun and id_desa = '$this->id_desa'";
	$res = $this->db->query($sql);
	// echo $this->db->last_query();

	$this->db->select('id_akun_pembiayaan,SUM(total) AS total',false);
	$this->db->from("v_t_pembiayaan");
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
	//echo $this->db->last_query();

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
		$this->db->order_by("kode1,kode2,kode3,kode4,kode5");
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



function get_detail_belanja_($id){
		$this->db->where("id_desa",$this->id_desa);
		$this->db->where("tahun",$this->tahun);
		$this->db->where("id",$id);
		$data = $this->db->get("perubahan_belanja")->row_array();
		// echo $this->db->last_query(); exit;
		return $data;
}


function generate_temp_belanja($id_akun_pendapatan,$periode,$bulan){


 // 1. GENERATE REKENING PAGU ANGGARAN 
	// $this->db->where("id_desa",$this->id_desa);
	// $this->db->where("tahun",$this->tahun);
	// $this->db->delete("tmp_realisasi_sd");
	// echo $this->db->last_query()."<br />";

	$this->db->query("delete from tmp_realisasi_sd");


	$this->db->where("id_desa",$this->id_desa);
	$this->db->where("tahun",$this->tahun);
	$this->db->where("id_akun_pendapatan",$id_akun_pendapatan);
	$this->db->group_by("id");
	$res = $this->db->get("perubahan_belanja_rincian");
	// echo $this->db->last_query(); exit;
	// loop and find data in perubahan 
	foreach($res->result() as $row) : 
			 
		
		$data = $this->get_detail_belanja_($row->id);
		// show_array($data);
		$input['id'] = $data['id'];
		$input['kode'] = $data['kode'];
		$input['kode1'] = $data['kode1'];
		$input['kode2'] = $data['kode2'];
		$input['kode3'] = $data['kode3'];
		$input['kode4'] = $data['kode4'];
		$input['kode5'] = $data['kode5'];
		$input['kode6'] = $data['kode6'];
		$input['pid'] = $data['pid'];
		$input['nama'] = $data['nama'];
		$input['has_child'] = $data['has_child'];
		$input['total'] =  $this->total_rincian($data['id'],$id_akun_pendapatan);

		$this->db->insert("tmp_realisasi_sd",$input);
		// echo $this->db->last_query()."<br />";
		//exit;
		$loop = explode("_", $data['pid']);
 		 		$n_loop = count($loop);
 		 		
 		 		for($i=0; $i<$n_loop; $i++) {
 		 			
 		 			$id = $this->cm->get_pid($data['pid'],$i);

 		 			 
 		 			//$this->db->where("tahun",$this->session->userdata("tahun_anggaran"));
 		 			//$this->db->where("id_desa",$this->session->userdata("id_desa"));
 		 			$this->db->where("id",$id);
 		 			$jumlah = $this->db->get("tmp_realisasi_sd")->num_rows();
 		 			if($jumlah == 0 ) {
 		 				 
 		 				$arr_rekening = $this->get_detail_belanja_($id);
 		 				$xinput['id'] = $arr_rekening['id'];
						$xinput['kode'] = $arr_rekening['kode'];
						$xinput['kode1'] = $arr_rekening['kode1'];
						$xinput['kode2'] = $arr_rekening['kode2'];
						$xinput['kode3'] = $arr_rekening['kode3'];
						$xinput['kode4'] = $arr_rekening['kode4'];
						$xinput['kode5'] = $arr_rekening['kode5'];
						$xinput['kode6'] = $arr_rekening['kode6'];
						$xinput['pid'] = $arr_rekening['pid'];
						$xinput['nama'] = $arr_rekening['nama'];
						$xinput['has_child'] = $arr_rekening['has_child'];
						$xinput['total'] = 0;//$arr_rekening['has_child'];
 		 				// $xarr['tahun'] = $this->session->userdata("tahun_anggaran");
 		 				// $xarr['id_desa'] = $this->session->userdata("id_desa");
 		 				// $xarr['id']  		= $arr_rekening['id'];
 		 				// $xarr['pid']  		= $arr_rekening['pid'];
				  		// $xarr['kode']  		= $arr_rekening['kode'];
				  		// $xarr['kode1']  	= $arr_rekening['kode1'];
				  		// $xarr['kode2']  	= $arr_rekening['kode2'];
				  		// $xarr['kode3']  	= $arr_rekening['kode3'];
				  		// $xarr['kode4']  	= $arr_rekening['kode4'];
				  		// $xarr['kode5']  	= $arr_rekening['kode5'];
				  		// $xarr['nama']  		= $arr_rekening['nama'];
				  		// $xarr['has_child']  = $arr_rekening['has_child'];

				  		$this->db->insert("tmp_realisasi_sd",$xinput);
				  		
 		 			}
 		 		}
 	endforeach;
// SARING DATA SEKARANG  NYA 

 	$sql="SELECT id_akun_belanja,SUM(total) AS total FROM buku_kas 
			WHERE jenis='k'
			AND id_akun_pendapatan='$id_akun_pendapatan' 
			and year(tanggal) = '$this->tahun' and id_desa='$this->id_desa' ";



 	if($periode<>'y'){
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
			if($awal == 'b') {
				//$this->db->where("month(tanggal) = $akhir",null,false);
				$sql.=" and month(tanggal) = $akhir ";
			}
			else {
				// $this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
				$sql.=" and MONTH(tanggal) BETWEEN $awal AND $akhir ";
			}
	}

	$sql.=" GROUP BY id_akun_belanja";
 


 	$res = $this->db->query($sql);
 	// echo "sekaarng ".$this->db->last_query()."<br />";
 	foreach($res->result() as $row) :
 		$this->db->where("id",$row->id_akun_belanja);
 		$this->db->update("tmp_realisasi_sd",array("sekarang"=>$row->total));
 		// echo $this->db->last_query()."<br />";
 	endforeach;
 	//echo $this->db->last_query();


// SARING DATA SEBELUMNYA 




 	$sql="SELECT id_akun_belanja,SUM(total) AS total FROM buku_kas 
			WHERE jenis='k'
			AND id_akun_pendapatan='$id_akun_pendapatan' 
			and year(tanggal) = '$this->tahun' and id_desa='$this->id_desa' ";


 	if($periode<>'y'){
			$angka = $this->cm->periode_to_bulan($periode,$bulan);
			extract($angka);
			if($awal == 'b') {
				//$this->db->where("month(tanggal) = $akhir",null,false);
				$sql.=" and month(tanggal) < $akhir ";
			}
			else {
				// $this->db->where("MONTH(tanggal) BETWEEN $awal AND $akhir",null,false);
				$sql.=" and MONTH(tanggal) < $awal ";
			}
	}

	$sql.=" GROUP BY id_akun_belanja";

	
 
 	$res = $this->db->query($sql);
 	// echo "sebelum ".$this->db->last_query();
 	foreach($res->result() as $row) :
 		$this->db->where("id",$row->id_akun_belanja);
 		$this->db->update("tmp_realisasi_sd",array("sebelum"=>$row->total));
 		// echo $this->db->last_query()."<br />";
 	endforeach;
 	//echo $this->db->last_query();

	
}

function get_data_sd(){
	$this->db->order_by("kode1,kode2,kode3,kode4,kode5,kode6");
	$res = $this->db->get("tmp_realisasi_sd");
	return $res;
}


function total_rincian($id,$id_akun_pendapatan){
	$sql="
		SELECT b.*,SUM(br.total) AS total FROM perubahan_belanja_rincian b
		LEFT JOIN perubahan_belanja_detail br ON b.`id_belanja_rincian` = br.id_belanja_rincian
		WHERE id_akun_pendapatan='$id_akun_pendapatan'
		AND id_desa = '$this->id_desa' 
		AND tahun = '$this->tahun'
		AND id='$id'
		GROUP BY id";
	$res = $this->db->query($sql);
	$data = $res->row();
	return $data->total;
}


}
?>