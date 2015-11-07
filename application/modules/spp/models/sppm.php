<?php
class sppm extends CI_Model {
	function sppm(){
		parent::__construct();
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

	function get_data($param){


		$id_kegiatan="2_".$param['id_kegiatan'];
		$tanggal = $param['tanggal']; 
		$id_desa = $this->id_desa;
		$tahun = $this->tahun;
		$id_kegiatan = $id_kegiatan."_";

	 

		$sql="SELECT b.*,spp.`jumlah` FROM perubahan_belanja b 
		LEFT JOIN 
		( SELECT * FROM spp s WHERE  s.tahun='$tahun' AND s.id_desa='$id_desa' AND s.`tanggal`='$tanggal' ) spp 
		ON  b.id = spp.id AND b.tahun = spp.`tahun` AND b.id_desa=spp.`id_desa`
		WHERE 
		b.tahun='$tahun' AND b.id_desa='$id_desa'
		AND b.id REGEXP '^$id_kegiatan'
		-- AND (spp.`tanggal`='2015-3-16' OR spp.`tanggal` IS NULL ) 
		ORDER BY kode1, kode2, kode3, kode4, kode5, kode6";

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



function subtotal($tanggal,$id,$tahun,$id_desa) {
	$id2= $id."_";
	$tanggal = flipdate($tanggal);
	$sql="select sum(jumlah) as jumlah from spp
	join perubahan_belanja b on spp.id_desa = b.id_desa and spp.tahun = b.tahun and spp.id=b.id
	 where spp.id_desa='$id_desa' and spp.tahun='$tahun' 
	 and spp.id regexp '^$id2' and spp.tanggal='$tanggal'";
	$res = $this->db->query($sql)->row();
	//echo $this->db->last_query(); exit;
	$jumlah = $res->jumlah;
	return $jumlah;
}


function jumlah_sd($tanggal,$id,$tahun,$id_desa) {
	$tanggal = flipdate($tanggal);
	$sql="select sum(jumlah) as jumlah from spp 
	join perubahan_belanja b on spp.id_desa = b.id_desa and spp.tahun = b.tahun and spp.id=b.id
	 where spp.id_desa='$id_desa' and spp.tahun='$tahun' 
	 and spp.id = '$id' and spp.tanggal<'$tanggal'

	";
	$res = $this->db->query($sql)->row();
	// echo $this->db->last_query();
	//exit;
	$jumlah = $res->jumlah;
	return $jumlah;
}

function jumlah_sd_subtotal($tanggal,$id,$tahun,$id_desa) {
	$id2= $id."_";
	$tanggal = flipdate($tanggal);
	$sql="select sum(jumlah) as jumlah from spp 

	join perubahan_belanja b on spp.id_desa = b.id_desa and spp.tahun = b.tahun and spp.id=b.id
	 where spp.id_desa='$id_desa' and spp.tahun='$tahun' 
	 and spp.id regexp '^$id2' and spp.tanggal<'$tanggal'
	";
	$res = $this->db->query($sql)->row();
	$jumlah = $res->jumlah;
	return $jumlah;
}




function get_data_spp($id_kegiatan,$tanggal){
		$id_desa = $this->session->userdata("id_desa");
		$tahun = $this->session->userdata("tahun_anggaran");

	$sql = "SELECT b.*,spp.`jumlah`, spp.`tanggal`, spp.`id_kegiatan` FROM v_perubahan_belanja b
			JOIN spp ON b.id=spp.id AND b.id_desa = spp.`id_desa` AND b.tahun = spp.`tahun`
			WHERE spp.`tanggal`='$tanggal'
			AND spp.`id_desa` ='$id_desa' AND spp.`tahun`='$tahun' 
			AND spp.`id_kegiatan`='$id_kegiatan'
			order by kode1,kode2,kode3,kode4,kode5
			";
	$res = $this->db->query($sql);
	// echo $this->db->last_query(); exit;
	return $res;
}


}
?>