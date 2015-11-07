<?php
class sync extends CI_Controller {
	function sync(){
		parent::__construct();
		$this->load->helper("tanggal");
	}



	function index(){

		/// create log record 




		$post = $this->input->post();
		$tahun = $post['tahun'];
		$id_desa = $post['id_desa'];


		$arr_log = array("id_desa"=>$id_desa, "waktu_mulai"=> date("Y-m-d h:i:s"));
		$this->db->insert("log_sending",$arr_log);
		$id_log = $this->db->insert_id();

		$user = $post['user'];
		$password = $post['password'];
		$hash = $post['hash'];
		$sql="select * from auth where user='$user' 
			and md5(md5(concat(password,'$hash'))) = '$password'
		";
		$res = $this->db->query($sql);
		//echo $this->db->last_query();
		if($res->num_rows() == 0){
			$ret = array("error"=>true,'message'=>'Autentikasi gagal. username dan password tidak dikenal');
			echo json_encode($ret);
			$arr_log = array("waktu_selesai"=> date("Y-m-d h:i:s"),"keterangan"=>"Autentikasi Gagal");
			$this->db->where("id",$id_log);
			$this->db->update("log_sending",$arr_log);
			exit;
		}

	    $data = $post['json_data'];
 		$array = json_decode($data);
// # PENDAPATAN 	    
	    // proses pendapatan 

	   
	    //show_array($array); exit;

	    // show_array($array->pendapatan->data);
		$row_data = (array) $array->pendapatan->data;

		$sql="delete from pendapatan_detail where id_pendapatan in (select id_pendapatan
		from pendapatan where tahun='$tahun' and id_desa='$id_desa') ";
		$this->db->query($sql);

		// hapus data tahun dan desanya. 
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("pendapatan");

		foreach($row_data as $row) : 
			$row2 = (array) $row;
			// show_array($row2);
			$this->db->insert("pendapatan",$row2);
			// echo $this->db->last_query();
		endforeach;

		
		// PENDAPATAN DETAIL  
		$row_data_pendapatan_detail = (array) $array->pendapatan_detail->data; 
		// show_array($row_data_pendapatan_detail);

		foreach($row_data_pendapatan_detail as $row) : 
			$row_pendapatan_detail = (array) $row;
			// show_array($row2);
			$this->db->insert("pendapatan_detail",$row_pendapatan_detail);
			// echo $this->db->last_query();
		endforeach;



#BELANJA 

	 


		// hapus detailnya
		$sql="delete from belanja_detail where id_belanja_rincian in 
		(select id_belanja_rincian from belanja_rincian where id_desa='$id_desa'
			and tahun='$tahun')";

		$this->db->query($sql);

		// hapus belanja rincian 

		$sql="delete from belanja_rincian where id_desa='$id_desa'
			and tahun='$tahun'";
		$this->db->query($sql);


		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("belanja");
		// proses data belanja 
		$row_data_belanja = (array) $array->belanja->data; 
		foreach($row_data_belanja as $row_belanja_value) : 
			$row_belanja = (array) $row_belanja_value;
			// show_array($row_belanja);
			$this->db->insert("belanja",$row_belanja);
			// echo $this->db->last_query();
		endforeach;

		// proses data belanja rincian 
		$row_data_belanja_rincian = (array) $array->belanja_rincian->data; 
		// show_array($row_data_belanja_rincian );
		// exit;
		foreach($row_data_belanja_rincian as $row_belanja_rincian_value) : 
			$row_belanja_rincian = (array) $row_belanja_rincian_value;
			// show_array($row_belanja_rincian);
			$this->db->insert("belanja_rincian",$row_belanja_rincian);
			// echo $this->db->last_query();
		endforeach;

// proses data belanja detail
		$row_data_belanja_detail = (array) $array->belanja_detail->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_belanja_detail as $row_belanja_detail_value) : 
			$row_belanja_detail = (array) $row_belanja_detail_value;
			// show_array($row_belanja_rincian);
			$this->db->insert("belanja_detail",$row_belanja_detail);
			// echo $this->db->last_query();
		endforeach;



# PEMBIAYAAN 
		$sql="delete from pembiayaan_detail where id_pembiayaan in (select id_pembiayaan
		from pembiayaan where tahun='$tahun' and id_desa='$id_desa') ";
		$this->db->query($sql);

		// hapus data tahun dan desanya. 
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("pembiayaan");
		// echo $this->db->last_query();

		$row_data_pembiayaan = (array) $array->pembiayaan->data; 
		// show_array($row_data_pembiayaan);
		// exit;
		foreach($row_data_pembiayaan as $row) : 
			$row2 = (array) $row;
			// show_array($row2);
			$this->db->insert("pembiayaan",$row2);
			// echo $this->db->last_query();
		endforeach;

		
 		$row_data_pembiayaan_detail = (array) $array->pembiayaan_detail->data; 
 		// show_array($row_data_pembiayaan_detail);
		foreach($row_data_pembiayaan_detail as $row) : 
			$row_pembiayaan_detail = (array) $row;
 			$this->db->insert("pembiayaan_detail",$row_pembiayaan_detail);
 		endforeach;




 	# PERUBAHAN 

 		#PERUBAHAN PENDAPATAN
 		$row_data = (array) $array->perubahan_pendapatan->data;

		$sql="delete from perubahan_pendapatan_detail where id_pendapatan in (select id_pendapatan
		from perubahan_pendapatan where tahun='$tahun' and id_desa='$id_desa') ";
		$this->db->query($sql);

		// hapus data tahun dan desanya. 
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("perubahan_pendapatan");

		foreach($row_data as $row) : 
			$row2 = (array) $row;
			// show_array($row2);
			$this->db->insert("perubahan_pendapatan",$row2);
			// echo $this->db->last_query();
		endforeach;

		 

		// PERUBAHAN PENDAPATAN DETAIL  
		$row_data_pendapatan_detail = (array) $array->perubahan_pendapatan_detail->data; 
		// show_array($row_data_pendapatan_detail);

		foreach($row_data_pendapatan_detail as $row) : 
			$row_pendapatan_detail = (array) $row;
			// show_array($row2);
			$this->db->insert("perubahan_pendapatan_detail",$row_pendapatan_detail);
			// echo $this->db->last_query();
		endforeach;



		// PERUBAHAN BELANJA 

// hapus detailnya
		$sql="delete from perubahan_belanja_detail where id_belanja_rincian in 
		(select id_belanja_rincian from perubahan_belanja_rincian where id_desa='$id_desa'
			and tahun='$tahun')";

		$this->db->query($sql);

		// hapus belanja rincian 

		$sql="delete from perubahan_belanja_rincian where id_desa='$id_desa'
			and tahun='$tahun'";
		$this->db->query($sql);


		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("perubahan_belanja");
		// proses data belanja 
		$row_data_belanja = (array) $array->perubahan_belanja->data; 
		foreach($row_data_belanja as $row_belanja_value) : 
			$row_belanja = (array) $row_belanja_value;
			// show_array($row_belanja);
			$this->db->insert("perubahan_belanja",$row_belanja);
			// echo $this->db->last_query();
		endforeach;

		 

		// proses data belanja rincian 
		$row_data_belanja_rincian = (array) $array->perubahan_belanja_rincian->data; 
		// show_array($row_data_belanja_rincian );
		// exit;
		foreach($row_data_belanja_rincian as $row_belanja_rincian_value) : 
			$row_belanja_rincian = (array) $row_belanja_rincian_value;
			// show_array($row_belanja_rincian);
			$this->db->insert("perubahan_belanja_rincian",$row_belanja_rincian);
			// echo $this->db->last_query();
		endforeach;
		

// proses data belanja detail
		$row_data_belanja_detail = (array) $array->perubahan_belanja_detail->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_belanja_detail as $row_belanja_detail_value) : 
			$row_belanja_detail = (array) $row_belanja_detail_value;
			// show_array($row_belanja_rincian);
			$this->db->insert("perubahan_belanja_detail",$row_belanja_detail);
			// echo $this->db->last_query();
		endforeach;


		$row_data = (array) $array->perubahan_pembiayaan->data;

		

		 $sql="delete from perubahan_pembiayaan_detail where id_pembiayaan in (select id_pembiayaan
		from perubahan_pembiayaan where tahun='$tahun' and id_desa='$id_desa') ";
		$this->db->query($sql);

		// hapus data tahun dan desanya. 
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("perubahan_pembiayaan");

		foreach($row_data as $row) : 
			$row2 = (array) $row;
 			$this->db->insert("perubahan_pembiayaan",$row2);
 		endforeach;

		 $sql="delete from pembiayaan_detail where id_pembiayaan in (select id_pembiayaan
		from pembiayaan where tahun='$tahun' and id_desa='$id_desa') ";
		$this->db->query($sql);

// PERUBAHAN PEMBIAYAAN DETAIL  
		$row_data_pembiayaan_detail = (array) $array->perubahan_pembiayaan_detail->data; 
 		// show_array($row_data_pembiayaan_detail);
		foreach($row_data_pembiayaan_detail as $row) : 
			$row_pembiayaan_detail = (array) $row;
 			$this->db->insert("perubahan_pembiayaan_detail",$row_pembiayaan_detail);
 		endforeach;
 



# SPP
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("spp");
		$row_data_spp = (array) $array->spp->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_spp as $row_spp) : 
			$row_spp2 = (array) $row_spp;
			// show_array($row_belanja_rincian);
			$this->db->insert("spp",$row_spp2);
			// echo $this->db->last_query();
		endforeach;


# BUKU BANK
		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_bank");
		//echo $this->db->last_query();
		$row_data_buku_bank = (array) $array->buku_bank->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_buku_bank as $row_buku_bank) : 
			$row_buku_bank_2 = (array) $row_buku_bank;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_bank",$row_buku_bank_2);
			// echo $this->db->last_query();
		endforeach;

#BUKU BANK 2

		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_bank_2");
		//echo $this->db->last_query();
		$row_data_buku_bank = (array) $array->buku_bank_2->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_buku_bank as $row_buku_bank) : 
			$row_buku_bank_2 = (array) $row_buku_bank;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_bank_2",$row_buku_bank_2);
			// echo $this->db->last_query();
		endforeach;



# BUKU KAS
		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_kas");
		//echo $this->db->last_query();
		$row_data_buku_kas = (array) $array->buku_kas->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_buku_kas as $row_buku_kas) : 
			$row_buku_kas_2 = (array) $row_buku_kas;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_kas",$row_buku_kas_2);
			// echo $this->db->last_query();
		endforeach;


# BUKU BKU
		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_bku");
		//echo $this->db->last_query();
		$row_data_buku_bku = (array) $array->buku_bku->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_buku_bku as $row_buku_bku) : 
			$row_buku_bku_2 = (array) $row_buku_bku;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_bku",$row_buku_bku_2);
			// echo $this->db->last_query();
		endforeach;

 #BUKU PAJAK
		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_pajak");
		//echo $this->db->last_query();
		$row_data_buku_pajak = (array) $array->buku_pajak->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_buku_pajak as $row_buku_pajak) : 
			$row_buku_pajak_2 = (array) $row_buku_pajak;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_pajak",$row_buku_pajak_2);
			// echo $this->db->last_query();
		endforeach;


 #KEGIATAN DETAIL
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("kegiatan_detail");
		//echo $this->db->last_query();
		$row_data_kegiatan_detail = (array) $array->kegiatan_detail->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_kegiatan_detail as $row_kegiatan_detail) : 
			$row_kegiatan_detail_2 = (array) $row_kegiatan_detail;
			// show_array($row_belanja_rincian);
			$this->db->insert("kegiatan_detail",$row_kegiatan_detail_2);
			// echo $this->db->last_query();
		endforeach;
	

#SETTING DESA 
		$data_desa = (array) $array->setting_desa;	
		//show_array($data_desa);
		$this->db->where("id_desa",$data_desa['id_desa']);
		$this->db->delete("setting_desa");

		$this->db->insert("setting_desa",$data_desa);


#PERDES DAN PERDES PERUBAHAN
		$data_perdes = (array) $array->perdes;	
		//show_array($data_desa);
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);		
		$this->db->delete("perdes");
		$data_perdes['id_desa'] = $post['id_desa'];
		$this->db->insert("perdes",$data_perdes);


#PERDES PERUBAHAN
		$data_perdes = (array) $array->perdes_perubahan;	
		//show_array($data_desa);
		$this->db->where("tahun",$post['tahun']);
		$this->db->where("id_desa",$post['id_desa']);		
		$this->db->delete("perdes_perubahan");
		$data_perdes['id_desa'] = $post['id_desa'];
		$this->db->insert("perdes_perubahan",$data_perdes);


#verifikatur
 		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("verifikatur");
		//echo $this->db->last_query();
		$row_data_verifikatur = (array) $array->verifikatur->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_verifikatur as $row_verifikatur) : 
			$row_verifikatur = (array) $row_verifikatur;
			// show_array($row_belanja_rincian);
			$this->db->insert("verifikatur",$row_verifikatur);
			// echo $this->db->last_query();
		endforeach;


#buku_kas_detail_pajak 
 		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("buku_kas_detail_pajak");
		//echo $this->db->last_query();
		$row_data_verifikatur = (array) $array->buku_kas_detail_pajak->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_verifikatur as $row_verifikatur) : 
			$row_verifikatur = (array) $row_verifikatur;
			// show_array($row_belanja_rincian);
			$this->db->insert("buku_kas_detail_pajak",$row_verifikatur);
			// echo $this->db->last_query();
		endforeach;



 #T_PEMBIAYAAN
		$this->db->where("year(tanggal) = '$tahun'",null,false);
		$this->db->where("id_desa",$post['id_desa']);
		$this->db->delete("t_pembiayaan");
		//echo $this->db->last_query();
		$row_data_kegiatan_detail = (array) $array->t_pembiayaan->data; 
		// show_array($row_data_belanja_detail );
		// exit;
		foreach($row_data_kegiatan_detail as $row_kegiatan_detail) : 
			$row_kegiatan_detail_2 = (array) $row_kegiatan_detail;
			// show_array($row_belanja_rincian);
			$this->db->insert("t_pembiayaan",$row_kegiatan_detail_2);
			// echo $this->db->last_query();
		endforeach;
	


		$arr_log = array("waktu_selesai"=> date("Y-m-d h:i:s"),"keterangan"=>"Upload data berhasil");
		$this->db->where("id",$id_log);
		$this->db->update("log_sending",$arr_log);


	$ret = array("error"=>false,'message'=>'Proses export berhasil');
	echo json_encode($ret);

	}




}
?>