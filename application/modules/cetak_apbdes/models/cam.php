<?php
class cam extends CI_Model {
	function cam (){
		parent::__construct();
		$this->id_desa = $this->session->userdata("id_desa");
		$this->tahun  = $this->session->userdata("tahun");
	}

	function get_data_pendapatan() {
		$tahun = $this->session->userdata("tahun_anggaran");
		$tahun2 = $tahun - 1;
		$this->db->where("id_desa", $this->id_desa);
		$this->db->where("tahun",$this->tahun );
		//$this->db->where("length(kode) <= 8",null,false);
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5 asc ");
		$this->db->group_by("id");
		$res  = $this->db->get("pendapatan");
		return $res;
	}
	function get_data_belanja() {
	 	$tahun = $this->session->userdata("tahun_anggaran");
		$tahun2 = $tahun - 1;
		$this->db->where("id_desa", $this->id_desa );
		$this->db->where("tahun",$this->tahun);
		///$this->db->where("length(kode) <= 8",null,false);
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5, kode6 asc ");
		$this->db->group_by("id");
		$res  = $this->db->get("belanja");
		return $res;
	}
	function get_data_pembiayaan() {
	 	 
		$this->db->where("id_desa", $this->id_desa );
		// $this->db->where("tahun in ( $tahun, $tahun2 )", null, false );
		$this->db->where("tahun",$this->tahun);
		//$this->db->where("length(kode) <= 8",null,false);
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5 asc ");
		$this->db->group_by("id");
		$res  = $this->db->get("pembiayaan");
		return $res;
	}


	function get_data_penjabaran_pendapatan() {
		
		$this->db->where("id_desa", $this->id_desa );
		$this->db->where("tahun",$this->tahun );		 
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5 asc ");		 
		$res  = $this->db->get("pendapatan");
		return $res;
	}

	function get_data_penjabaran_belanja($id_kegiatan="") {
		 
		$this->db->where("id_desa", $this->id_desa );
		$this->db->where("tahun",$this->tahun );		 
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5, kode6 asc ");	
		$id_kegiatan2=$id_kegiatan."_";
		// $this->db->where("(id like '$id_kegiatan\_%' or id='$id_kegiatan')");

		if($id_kegiatan <> '') {  
		$this->db->where("(id regexp '^$id_kegiatan2' or id='$id_kegiatan')");	
		}	
		$res  = $this->db->get("belanja");
		return $res;
		
	}
	
	function get_data_penjabaran_pembiayaan() {
		 
		$this->db->where("id_desa", $this->id_desa );
		$this->db->where("tahun",$this->tahun );		 
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5 asc ");		 
		$res  = $this->db->get("pembiayaan");
		return $res;
	}

function get_data_penjabaran_pembiayaan_jenis($prefix) {
		//$prefix = $prefix."_";
		$this->db->where("id_desa", $this->id_desa );
		$this->db->where("tahun",$this->tahun );		 
 		$this->db->where(" id regexp '^$prefix' ",null,false);		 
		$this->db->order_by("kode1, kode2, kode3, kode4, kode5 asc ");		 
		$res  = $this->db->get("pembiayaan");
		// echo $this->db->last_query(); exit;
		return $res;
	}


	///// get detail 
	function get_rec_detail($tb_name, $col_name, $id) {

		$this->db->where($col_name,$id);
		$this->db->order_by("no_urut");
		$res = $this->db->get($tb_name);
		return $res;
	}


	function cek($tb_name) {
		$tahun = $this->session->userdata("tahun_anggaran");
	 	$id_desa = $this->session->userdata("id_desa");
		$sql="SELECT * FROM $tb_name
		WHERE 
		(t1 IS NULL OR t2 IS NULL OR t3 IS NULL OR t4 IS NULL)
		AND has_child IS NULL 
		AND tahun = $tahun
		AND id_desa= '$id_desa'";
		$jumlah = $this->db->query($sql)->num_rows();
		//echo $this->db->last_query();
		return $jumlah;
	}

	
	function get_penarikan_triwulan($tb_name,$id_kegiatan="") {
		$tahun = $this->session->userdata("tahun_anggaran");
	 	$id_desa = $this->session->userdata("id_desa");
		$sql="SELECT SUM(IFNULL(t1,0)) t1, SUM(IFNULL(t2,0)) t2, SUM(IFNULL(t3,0)) t3, SUM(IFNULL(t4,0)) t4,
			SUM(IFNULL(t1,0)) + SUM(IFNULL(t2,0)) + SUM(IFNULL(t3,0)) + SUM(IFNULL(t4,0)) total 
			 FROM $tb_name
		WHERE tahun='$tahun' AND id_desa  ='$id_desa'";

		if($id_kegiatan <> ""){
			$sql.=" and id like '$id_kegiatan%'";
		}

		$data = $this->db->query($sql)->row_array();
		return $data;
	}
function arr_id_program(){
		$arr = array('x'=>"- PILIH PROGAM -");
		$this->db->order_by("kode1,kode2,kode3,kode4,kode5");
		$this->db->where("length(kode)=1",null,false);
		$res = $this->db->get("akun_program");
		foreach($res->result() as $row) :
			$arr[$row->id] = $row->kode . " ". $row->nama;
		endforeach;
		return $arr;
	}

function get_rekening_rincian($id_kegiatan){

		$tahun = $this->session->userdata("tahun_anggaran");
		$tahun_sebelum  = $tahun - 1; 
		$id_desa = $this->session->userdata("id_desa");

		// $this->db->where("(id like '$id_kegiatan\_%' or id='$id_kegiatan')");	

		$id_kegiatan2=$id_kegiatan."_";
		$sql="
		select * from v_belanja
		where (id regexp '^$id_kegiatan2' or id='$id_kegiatan')
		and tahun='$tahun' and id_desa='$id_desa' 
		order by kode1,kode2,kode3,kode4,kode5
		";


		// $sql="SELECT * FROM tmp_rincian_program 
		// WHERE id_desa = '$id_desa'
		// AND tahun IN ('$tahun_sebelum','$tahun')
		// GROUP BY id 
		// ORDER BY kode1,kode2,kode3,kode4,kode5";




		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		// exit;
		return $res;

	}


function get_rincian($id){
	 
		$tahun = $this->session->userdata("tahun_anggaran");
		$id_desa = $this->session->userdata("id_desa");		
		$this->db->where("id_desa",$id_desa);
		$this->db->where("tahun",$tahun);
		$this->db->where("id",$id);
		$this->db->order_by("no_urut_rincian"); 
		$res = $this->db->get("belanja_rincian");
		return $res;
	}


function get_belanja_detail($id_belanja_rincian){
	$this->db->where("id_belanja_rincian",$id_belanja_rincian);
	$this->db->order_by("no_urut");
	$res = $this->db->get("v_belanja_detail");
	return $res;
}


function get_detail_kegiatan($id_kegiatan) {
	$this->db->where("tahun",$this->tahun);
	$this->db->where("id_desa",$this->id_desa);
	$this->db->where("id_kegiatan",$id_kegiatan);
	$res = $this->db->get("kegiatan_detail");
	//echo $this->db->last_query();
	return $res->row_array();
}

function get_detail_bidang($id_kegiatan) {
	$sql=" select  * from akun_program 
	where id = ( select pid from akun_program where id='$id_kegiatan' ) ";
	$res = $this->db->query($sql);
	//echo $this->db->last_query();
	return $res->row_array();


}

function get_verifikasi(){
	$this->db->order_by("no_urut");
	$res = $this->db->get("verifikatur");
	//echo $this->db->last_query();
	return $res;
}



function get_rekap_kegiatan() {
	$this->db->where("tahun",$this->tahun);
	$this->db->where("id_desa",$this->id_desa);
	$this->db->order_by("kode1,kode2,kode3,kode4,kode5,kode6");
	//$this->db->where("id like '$id_kegiatan%'",null,false);
	$this->db->where("length(id) <= 6",null,false);
	$res = $this->db->get("belanja");
	// echo $this->db->last_query(); exit;
	return $res;
}


function get_sumber_dana($id) {
	$id=$id."_";
	$sql="SELECT GROUP_CONCAT(DISTINCT ap.singkatan) AS singkatan FROM belanja_rincian br
			JOIN akun_pendapatan ap ON br.`id_akun_pendapatan`=ap.`id`
			WHERE br.id REGEXP '^$id'
			AND id_desa='$this->id_desa'
			AND tahun='$this->tahun'";
	$res = $this->db->query($sql)->row();
	return $res->singkatan;
}


function get_rekap_sd(){
	$this->db->select('ap.kode, ap.nama, SUM(bd.total) AS total',false);
	$this->db->from('belanja_rincian br ')->join('akun_pendapatan ap','br.id_akun_pendapatan = ap.id')
	->join('v_belanja_detail bd','bd.id_belanja_rincian =  br.id_belanja_rincian')
	// JOIN belanja b ON b.`id` = br.`id`
	->join('belanja b','b.id=br.id')
	->group_by('br.id_akun_pendapatan')->order_by('ap.kode1,ap.kode2,ap.kode3,ap.kode4,ap.kode5');
	$this->db->where("br.tahun",$this->tahun);
	$this->db->where("br.id_desa",$this->id_desa);
	$res = $this->db->get();
	// echo $this->db->last_query(); exit;
	return $res;

}


function get_kegiatan_detail($id_kegiatan){
	$this->db->where("id_kegiatan",$id_kegiatan);
	$this->db->where("tahun",$this->tahun);
	$this->db->where("id_desa",$this->id_desa);
	$data = $this->db->get("kegiatan_detail")->row_array();
	//show_array($data);
	return $data;
 }

 function rekap_belanja(){
 	$this->db->query("delete from tmp_rekap_belanja");

 	$sql="insert into tmp_rekap_belanja SELECT id,kode,kode4,kode5,nama,tahun,id_desa, SUM(total)AS total 
 	, has_child   
	FROM (SELECT kode AS  kode_tmp,
	IF(titik(kode) = 3,  SPLIT_STR(id,'_',4) , CONCAT( SPLIT_STR(id,'_',4),'_', SPLIT_STR(id,'_',5))) AS id,
	IF(titik(kode) = 3,  SPLIT_STR(kode,'.',4) , CONCAT( SPLIT_STR(kode,'.',4),'.', SPLIT_STR(kode,'.',5))) AS kode,
	kode4,kode5
	,nama,tahun,id_desa, total,has_child
	 FROM v_belanja 
	WHERE titik(kode) > 2 
	AND id_desa='$this->id_desa' AND tahun ='$this->tahun' ) t 
	GROUP BY t.id";

	$this->db->query($sql);

	$this->db->order_by('kode4,kode5');
	$res = $this->db->get('tmp_rekap_belanja');
	return $res;

 }



}
?>