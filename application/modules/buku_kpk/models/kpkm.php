<?php
class kpkm extends CI_Model {
	function sppm(){
		parent::__construct();
	}

function get_data($param) {
	$id_kegiatan = $param['id_kegiatan'];
	 
	$sql="SELECT 
			*,
			IF(jenis='m' AND id_akun_pendapatan REGEXP '^1_1_3_' ,total,0) AS masuk_swadaya,
			IF(jenis='m' AND id_akun_pendapatan NOT REGEXP '^1_1_3_' ,total,0) AS masuk_bendahara,
			IF(SPLIT_STR(id_akun_belanja,'_',4) = '2',total,0)  AS keluar_barang_jasa,
			IF(SPLIT_STR(id_akun_belanja,'_',4) = '3',total,0)  AS keluar_modal


			 FROM buku_kas 
			 WHERE ( SPLIT_STR(id_akun_belanja,'_',4) IN ('2','3') 
			 OR jenis='m' ) 
			 AND id_kegiatan='$id_kegiatan'
			 and year(tanggal) = $this->tahun
			 order by tanggal";
	$res = $this->db->query($sql);
	//echo $this->db->last_query(); 
	return $res; 
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



function get_detail_kegiatan($id_kegiatan){
	$this->db->where("id",$id_kegiatan);
	 
	$data = $this->db->get("akun_program")->row_array();
	// echo $this->db->last_query();
	// exit;
	//show_array($data);
	$data['kegiatan'] = $data['nama'];
	return $data;  
 }


function get_detail_bidang($id_kegiatan) {
	$sql=" select  * from akun_program 
	where id = ( select pid from akun_program where id='$id_kegiatan' ) ";
	$res = $this->db->query($sql);
	//echo $this->db->last_query();
	return $res->row_array();


}

}
?>