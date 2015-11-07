<?php 
class cetak_realisasi_sd extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
  		$this->load->model("rsdm","dm");
		$this->load->helper("tanggal");
 		 
		 
	}


	function index()
    {
    $data['controller'] = get_class($this);
	$data['title'] = "CETAK LAPORAN REALISASI PELAKSANAAN PER SUMBER DANA ";
	$data['arr'] = $this->dm->arr_pendapatan;
	 
   	$content = $this->load->view($data['controller']."_view",$data,true);
	$this->set_title($data['title']);
	$this->set_subtitle($data['title']);
	$this->set_content($content);
	$this->render_baru();
	}

  
  	function cetak(){
  		$periode = $this->uri->segment(3);
  		$bulan   = $this->uri->segment(4);
  		$id_akun_pendapatan = $this->uri->segment(6);

  		$this->dm->generate_temp_belanja($id_akun_pendapatan,$periode,$bulan);
  		 
  		$data['tanggal'] = $this->uri->segment(5);
  		$data['periode'] = $periode;
  		$data['nama_periode'] = $this->cm->nama_periode($periode,$bulan);
		
  		$data['record'] = $this->dm->get_data_sd();

  		$arr = $this->dm->arr;
  		// show_array($arr); exit;
  		$data['sumber_dana'] = $arr[$id_akun_pendapatan];

  		// generate temporary rekening




		 

		$this->load->library('Pdf');
		$pdf = new Pdf('P', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('Test ');
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

		 // add a page
		$pdf->AddPage('P');


		 // $html = $this->load->view("ringkasan_pdf_head",$data,true);
		 // $pdf->writeHTML($html, true, false, true, false, '');


		 $html = $this->load->view("pdf/cetak_realisasi_sd_table_data",$data,true);
		 // echo $html;
		 // exit;
		 $pdf->writeHTML($html, true, false, true, false, '');


		 
		 $halaman  = $pdf->getPage();
		 $pdf->startTransaction();
		 $y = $pdf->getY();
		// echo "<pre>"; print_r($data);
		//  echo "</pre>";
		// exit; 
		 $html = $this->load->view("pdf_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------

		 if($halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/cetak_realisasi_sd_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/cetak_realisasi_sd_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }  

		  $pdf->Output('REALISASI'. $this->session->userdata("tahun") .'.pdf', 'I');
	}
 

}

?>