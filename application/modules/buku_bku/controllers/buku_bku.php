<?php 
class buku_bku extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
  		$this->load->model("bkum","dm");
		$this->load->helper("tanggal");
 		 
		 
	}


	function index()
    {
    $data['controller'] = get_class($this);
	$data['title'] = "CETAK BUKU  KAS UMUM ";
	
	 
   	$content = $this->load->view($data['controller']."_view",$data,true);
	$this->set_title($data['title']);
	$this->set_subtitle($data['title']);
	$this->set_content($content);
	$this->render_baru();
	}

  
  	function cetak(){

  		$periode = $this->uri->segment(3);
  		$bulan   = $this->uri->segment(4);

  		$data['tanggal'] = $this->uri->segment(5);
  		$data['nama_periode'] = $this->cm->nama_periode($periode,$bulan);
  		$data['saldo_sekarang'] = $this->dm->saldo($periode,$bulan);
  		$data['record'] = $this->dm->get_record($periode,$bulan);
  		$data['periode'] = $periode;
  		$data['bulan'] = $bulan;
  		
  		
  		$data['tanggal_periode'] = $this->cm->tanggal_periode($periode,$bulan);
  		//$data['tanggal_periode_sebelum'] = $this->cm->tanggal_periode_sebelum($periode,$bulan);
  		
  		$data['jumlah_sekarang'] = $this->dm->jumlah_sampe_sekarang($periode,$bulan);

  		$data['saldo_bank'] = $this->dm->saldo_bank($periode,$bulan);
  		$data['saldo_kas'] = $this->dm->saldo_kas($periode,$bulan);



  		/*//$angka = $this->cm->periode_to_bulan($periode,$bulan);

  		//print_r($angka);

  		//exit;  */

		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'mm', 'F4', true, 'UTF-8', false);
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
		$pdf->AddPage('L');


		 // $html = $this->load->view("ringkasan_pdf_head",$data,true);
		 // $pdf->writeHTML($html, true, false, true, false, '');


		 $html = $this->load->view("pdf/buku_bku_table_data",$data,true);
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
		 	$html = $this->load->view("pdf/buku_bku_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/buku_bku_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }  

		  $pdf->Output('Ringkasan RAPBDes '. $this->session->userdata("tahun") .'.pdf', 'I');
	}
 

}

?>