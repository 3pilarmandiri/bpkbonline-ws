<?php 
class buku_kpk extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
 		$this->load->model("kpkm","dm");
		$this->load->helper("tanggal");
 		 
		 
	}

	


	function index()
    {
	    $data['controller'] = get_class($this);
		$data['title'] = "BUKU KAS PEMBANTU KEGIATAN";
		
		 
	   	$content = $this->load->view($data['controller']."_view",$data,true);
		$this->set_title($data['title']);
		$this->set_subtitle($data['title']);
		$this->set_content($content);
		$this->render_baru();
	}

	function cetak()
    {
	    $data['controller'] = get_class($this);
		$data['title'] = "CETAK BUKU PEMBANTU KEGIATAN";
		
		 
	   	$content = $this->load->view($data['controller']."_cetak_view",$data,true);
		$this->set_title($data['title']);
		$this->set_content($content);
		$this->render();
	}

	function query(){
		$data = $this->input->post();
		$this->session->set_userdata("tanggal",flipdate($data['tanggal']));
		$this->session->set_userdata("id_kegiatan",$data['id_kegiatan']);
	}


	function save(){
		//print_r($_POST);
		$data = $this->input->post();
		$this->db->where("id_buku_kas",$data['id_buku_kas']);
		$this->db->update("t_buku_kas",array("penerima"=>$data['penerima']));
	}

	function get_data(){
		$id_desa = $this->session->userdata("id_desa");
		$tahun = $this->session->userdata("tahun_anggaran");
    	//$page = $_REQUEST['page']; // get the requested page 
        //$limit = $_REQUEST['rows']; // get how many rows we want to have into the grid 
        $sidx = isset($_REQUEST['sort'])?$_REQUEST['sort']:"b.kode1,b.kode2,b.kode3,b.kode4,b.kode5"; // get index row - i.e. user click to sort 
        $sord = isset($_REQUEST['order'])?$_REQUEST['order']:"asc"; // get the direction if(!$sidx) $sidx =1;  
       
       	$id_kegiatan  	= isset($_REQUEST['id_kegiatan'])?$_REQUEST['id_kegiatan']:"x"; 
         
        $req_param = array (
				"sort_by" => $sidx,
				"sort_direction" => $sord,
				//"limit" => null,
				"uraian" => isset($_REQUEST['uraian'])?$_REQUEST['uraian']:"x" 	,
				"id_kegiatan" =>$id_kegiatan
 				 		
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
			$responce->rows[$i]['id_buku_kas']	= "";
			 
			 
        }
        
        
 

		else {
                $x=0;
	        for($i=0; $i<count($result); $i++){
	        	$x++;
	            //$responce->rows[$i]['id']=$result[$i]['id_provinsi'];
	            // data berikut harus sesuai dengan kolom-kolom yang ingin ditampilkan di view (js)
	        $responce->rows[$i]['id_buku_kas']		= $result[$i]['id_buku_kas'] ;    
 	 		$responce->rows[$i]['belanja_kode']		= $result[$i]['belanja_kode'] ; 
 	 		$responce->rows[$i]['uraian']		= $result[$i]['uraian'] ;  
 	 		$responce->rows[$i]['penerima']		= $result[$i]['penerima'] ; 
 	 		$responce->rows[$i]['total']		= rupiah($result[$i]['total']) ;  

			 
 			
				
	        } 
		}
		//echo "<hr />";
        echo json_encode($responce); 
    }
 


function get_tanggal() {
	$id_kegiatan = $this->input->post("id_kegiatan");
	$id_desa = $this->session->userdata("id_desa");
	$tahun = $this->session->userdata("tahun_anggaran");

	$this->db->select('distinct tanggal',false)->from("spp");
	$this->db->where("id_kegiatan",$id_kegiatan);
	$this->db->where("tahun",$tahun);
	$this->db->where("id_desa",$id_desa);
	$this->db->order_by("tanggal");
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

		$data['record'] = $this->dm->get_data(array("id_kegiatan"=>$id_kegiatan));


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
 		 


		$pdf->AddPage('L');
		$html = $this->load->view("pdf/kpk_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->Output('DPA.pdf', 'I'); exit;

		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/kpk_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 if( $halaman <> $pdf->getPage() ) {
		 	//echo "yang in kan ? " ; 
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/kpk_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');
		 	//$pdf->Output('DPA.pdf', 'I'); exit;
		 	$html = $this->load->view("pdf/kpk_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	//echo "ini juga ya ? ";
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/kpk_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/kpk_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }
 
 

		

	$pdf->Output('KAS SPEMBANTU KEGAITAN.pdf', 'I');
}



}

?>