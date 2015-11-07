<?php 
class spp extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
 		$this->load->model("sppm","dm");
		$this->load->helper("tanggal");
 		 
		 
	}


	function index()
    {
	    $data['controller'] = get_class($this);
		$data['title'] = "INPUT SURAT PERMINTAAN PEMBAYARAN";
		
		 
	   	$content = $this->load->view($data['controller']."_view",$data,true);
		$this->set_title($data['title']);
		$this->set_content($content);

		$this->render_baru();
	}

	function cetak()
    {
	    $data['controller'] = get_class($this);
		$data['title'] = "CETAK SURAT PERMINTAAN PEMBAYARAN";
		
		 
	   	$content = $this->load->view($data['controller']."_cetak_view",$data,true);
		$this->set_title($data['title']);
		$this->set_subtitle($data['title']);
		$this->set_content($content);
		$this->render_baru();
	}

	function query(){
		$data = $this->input->post();
		$this->session->set_userdata("tanggal",flipdate($data['tanggal']));
		$this->session->set_userdata("id_kegiatan",$data['id_kegiatan']);
	}


	function save(){
		//print_r($_POST);
		$data = $this->input->post();
		$tanggal = $this->session->userdata("tanggal");
		$id_kegiatan = $this->session->userdata("id_kegiatan");
		$id_desa = $this->session->userdata("id_desa");
		$tahun = $this->session->userdata("tahun_anggaran");

		if( $data['has_child'] <> '1' )
		{

				$this->db->where("tanggal",$tanggal);
				$this->db->where("id",$data['id']);
				$this->db->where("tahun",$tahun); 
				$this->db->where("id_desa",$id_desa);

				$jumlah = $this->db->get("spp")->num_rows();

				$arr_data = array(
						"tanggal" => $tanggal,
						"id_desa" => $id_desa,
						"id"	 => $data['id'],
						"id_kegiatan"	 => $id_kegiatan,
						"tahun"		=> $tahun,
						"id_spp" => md5($tanggal.$id_desa.$data['id'].$tahun),
						"jumlah" => $data['jumlah']
					);
				show_array($arr_data); //exit;
				if($jumlah==0) { // insert 
					$this->db->insert("spp",$arr_data);
				}
				else {
					$this->db->where("id_spp",$arr_data['id_spp']);
					$this->db->update("spp",$arr_data);
				}

		}
	}



function hapus(){
	$data = $this->input->post();

	$this->db->where("id",$data['id']);
	$this->db->where("id_desa",$this->id_desa);
	$this->db->where("tahun",$this->tahun);
	$tanggal = flipdate($data['tanggal']);
	$this->db->where("tanggal",$tanggal);
	$res = $this->db->delete("spp");
	if($res){
		$ret = array("success"=>true,"message"=>"Berhasil dihapus");
	}
	else {
		$ret = array("success"=>false,"message"=>"Gagal dihapus ".mysql_error());
	}

	echo json_encode($ret);

}


	function get_data(){
		$id_desa = $this->id_desa;
		$tahun = $this->tahun;
    	//$page = $_REQUEST['page']; // get the requested page 
        //$limit = $_REQUEST['rows']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['sort'])?$_REQUEST['sort']:"b.kode1,b.kode2,b.kode3,b.kode4,b.kode5"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'])?$_REQUEST['order']:"asc"; // get the direction if(!$sidx) $sidx =1;  
       
       	$id_kegiatan  	= isset($_REQUEST['id_kegiatan'])?$_REQUEST['id_kegiatan']:"x"; 
       	$tanggal 	 	= isset($_REQUEST['tanggal'])?$_REQUEST['tanggal']:"00-00-0000"; 
        


        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				//"limit" => null,
				"uraian" => isset($_REQUEST['uraian'])?$_REQUEST['uraian']:"x" 	,
				"id_kegiatan" =>$id_kegiatan,
				"tanggal" => flipdate($tanggal)
				 		
		);     
           
        $row = $this->dm->get_data($req_param)->result_array();
		
        $count = count($row); 
        // if( $count >0 ) { 
        //     $total_pages = ceil($count/$limit); 
        // } else { 
        //     $total_pages = 0; 
        // } 
        // if ($page > $total_pages) 
        //     $page=$total_pages; 
        // $start = $limit*$page - $limit; // do not put $limit*($page - 1) 
        
        // $start = ($start < 0 )?0:$start;
        
        // $req_param['limit'] = array(
        //             'start' => $start,
        //             'end' => $limit
        // );
          
        
        $result = $this->dm->get_data($req_param)->result_array();
        // sekarang format data dari dB sehingga sesuai yang diinginkan oleh jqGrid dalam hal ini aku pakai JSON format
        //$responce->page = $page; 
       $responce = new stdClass();
        $responce->total = $count; 
        //$responce->records = $count;
        if($count == 0) {
        	$i=1;
			$responce->rows[$i]['id_spp']	= "";
			 
			 
        }
        
        
 

		else {
                $x=0;
	        for($i=0; $i<count($result); $i++){
	        	$x++;
	            //$responce->rows[$i]['id']=$result[$i]['id_provinsi'];
	            // data berikut harus sesuai dengan kolom-kolom yang ingin ditampilkan di view (js)
	        $responce->rows[$i]['id_belanja']	= $result[$i]['id_belanja'] ;    
	        $responce->rows[$i]['id']	= $result[$i]['id'] ; 
	       // $responce->rows[$i]['id_desa']	= $result[$i]['id_desa'] ; 
			$responce->rows[$i]['kode']				= ($result[$i]['has_child']==1)?"<b>". $result[$i]['kode'] ."</b>":$result[$i]['kode'];  
			$responce->rows[$i]['nama']				= ($result[$i]['has_child']==1)?"<b>".$result[$i]['nama'] ."</b>":$result[$i]['nama']; 
 			$responce->rows[$i]['has_child']		= $result[$i]['has_child'] ;  
 			// echo "ini i global $i <Br /> " ;
			if($result[$i]['has_child']==1) {

				// echo "iiii has child . $i  <Br />";
			//	echo "hangsat..";
				$total = $this->add->subtotal2($result[$i]['id'],"v_perubahan_belanja","total",$tahun,$id_desa );
				$responce->rows[$i]['total']	= "<b>".rupiah($total)."</b>";
				$responce->rows[$i]['jumlah']  = intval($this->dm->subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa ));
				$responce->rows[$i]['jumlah_sd']  = intval($this->dm->jumlah_sd_subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa )); 				
				$responce->rows[$i]['jumlah_semua'] = intval($this->dm->subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa )) + intval($this->dm->jumlah_sd_subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa ));
				$responce->rows[$i]['sisa'] = $total -  (intval($this->dm->subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa )) + intval($this->dm->jumlah_sd_subtotal($tanggal,$result[$i]['id'],$tahun,$id_desa ))) ;// "bangke ".$responce->rows[$i]['total'] - $responce->rows[$i]['jumlah_semua'];

			}
			else {
				// echo "iiii. $i <Br /> ";
				// echo "id = ". $result[$i]['id'] ;

				// echo " intval($this->dm->jumlah_sd($tanggal,". $result[$i]['id'] .",$tahun,$id_desa ))";
				$responce->rows[$i]['total'] = rupiah($result[$i]['total']); 
				$responce->rows[$i]['jumlah']	= intval($result[$i]['jumlah']); 
				$responce->rows[$i]['jumlah_sd']  = intval($this->dm->jumlah_sd($tanggal,$result[$i]['id'],$tahun,$id_desa ));
 				$responce->rows[$i]['jumlah_semua'] = intval($result[$i]['jumlah']) +  intval($this->dm->jumlah_sd($tanggal,$result[$i]['id'],$tahun,$id_desa )) ;// //0;// $responce->rows[$i]['jumlah_sd'] + $responce->rows[$i]['jumlah'];
				$responce->rows[$i]['sisa'] = $result[$i]['total'] - (intval($result[$i]['jumlah']) +  intval($this->dm->jumlah_sd($tanggal,$result[$i]['id'],$tahun,$id_desa )));// 0;//$responce->rows[$i]['total'] - $responce->rows[$i]['jumlah_semua'];
 				 
			}

			// $responce->rows[$i]['jumlah_semua'] = $responce->rows[$i]['jumlah_sd'] + $responce->rows[$i]['jumlah'];
			// $responce->rows[$i]['sisa'] = $responce->rows[$i]['total'] - $responce->rows[$i]['jumlah_semua'];
 		// 	//$responce->rows[$i]['jumlah']		= rupiah(result[$i]['jumlah']) ;  
			
 			
				
	        } 
		}
		//echo "<hr />";
        echo json_encode($responce); 
    }
 


function get_tanggal() {
	$id_kegiatan = $this->input->post("id_kegiatan");
	// $id_kegiatan = "2_".$id_kegiatan;
	$id_desa = $this->id_desa;
	$tahun = $this->tahun;

	$this->db->select('distinct tanggal',false)->from("spp");
	$this->db->join("perubahan_belanja b",'spp.id=b.id and spp.tahun=b.tahun and spp.id_desa = b.id_desa');
	$this->db->where("spp.id_kegiatan",$id_kegiatan);
	$this->db->where("spp.tahun",$tahun);
	$this->db->where("spp.id_desa",$id_desa);
	$this->db->order_by("spp.tanggal");
	$res = $this->db->get();
	$html ="";
	foreach($res->result() as $row): 
		$html .="<option value=$row->tanggal>".flipdate($row->tanggal)."</option>";
	endforeach;
	echo $html;
}
	 
function pdf(){
		$data = $_GET;
		$id_kegiatan=$data['id_kegiatan'];
		$tanggal = $data['tanggal'];
		//echo "test"; exit;
		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('SPP');
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(10);

		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Author');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		// $data['record'] = $this->dm->get_data_spp($id_kegiatan,$tanggal);
		$data['record'] = $this->dm->get_data(array("id_kegiatan"=>$id_kegiatan,
			"tanggal"=>$tanggal));
		 
		// echo $this->db->last_query(); exit;
		// $this->db->where("tahun",$this->session->userdata("tahun_anggaran"));
		// $this->db->where("id_desa",$this->session->userdata("id_desa"));
		// $this->db->where("id_kegiatan",$id_kegiatan);
		// $rx = $this->db->get("v_kegiatan_detail");
		
		// if($rx->num_rows() == 0 ) {
		// 	echo "DATA TIDAK DITEMUKAN"; 
		// 	exit;
		// }


		$data['detail_kegiatan'] = $this->dm->get_detail_kegiatan($id_kegiatan);
		$data['detail_bidang']   = $this->dm->get_detail_bidang($id_kegiatan);
		$data['id_kegiatan'] = $id_kegiatan;
		$data['tanggal'] = flipdate($tanggal);
		 


		$pdf->AddPage();
		$html = $this->load->view("pdf/spp_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->Output('DPA.pdf', 'I'); exit;

		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/spp_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 if( $halaman <> $pdf->getPage() ) {
		 	//echo "yang in kan ? " ; 
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/spp_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');
		 	//$pdf->Output('DPA.pdf', 'I'); exit;
		 	$html = $this->load->view("pdf/spp_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	//echo "ini juga ya ? ";
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_belanja_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }
 
 

		

	$pdf->Output('DPA.pdf', 'I');
}



}

?>