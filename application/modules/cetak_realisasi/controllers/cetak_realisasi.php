<?php 
class cetak_realisasi extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
  		$this->load->model("rm","dm");
		$this->load->helper("tanggal");
 		 
		 
	}


	function index()
    {
    $data['controller'] = get_class($this);
	$data['title'] = "CETAK LAPORAN REALISASI PELAKSANAAN ";
	
	 
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
  		$data['periode'] = $periode;
  		$data['nama_periode'] = $this->cm->nama_periode($periode,$bulan);
		
		if($periode=="s2") {
			$this->dm->generate_pendapatan("s1");
	  		$this->dm->generate_belanja("s1");
			$this->dm->generate_pembiayaan("s1");

			$data['saldo'] = $this->dm->hitung_saldo();
 		}
 		else if ($periode=="b" and $bulan > 1 ){
 			$bulan = $bulan  - 1;
 			$this->dm->generate_pendapatan("b",$bulan);
	  		$this->dm->generate_belanja("b",$bulan);
			$this->dm->generate_pembiayaan("b",$bulan);
			$data['saldo'] = $this->dm->hitung_saldo();

 		}
 		else if($periode != "t1") {
 			if($periode=="t2") { $periode2="t1"; } 
 			else if ($periode=="t3") $periode2="t2";
 			else if ($periode=="t4") $periode2="t3";
 			else $periode2="y";


 			$this->dm->generate_pendapatan($periode2);
	  		$this->dm->generate_belanja($periode2);
			$this->dm->generate_pembiayaan($periode2);

			$data['saldo'] = $this->dm->hitung_saldo();
 		}
 		// else {
 		// 	$periode2="y";
 		// 	$this->dm->generate_pendapatan($periode2);
	  	// 		$this->dm->generate_belanja($periode2);
			// $this->dm->generate_pembiayaan($periode2);

			// $data['saldo'] = $this->dm->hitung_saldo();
 		// }

		
  		 
  		$this->dm->generate_pendapatan($periode);
  		$this->dm->generate_belanja($periode);
		$this->dm->generate_pembiayaan($periode);
		// exit;
  		$data['record_pendapatan'] = $this->dm->get_record_pendapatan();
  		$data['record_belanja'] = $this->dm->get_record_belanja();
  		$data['record_pembiayaan'] = $this->dm->get_record_pembiayaan();

  		//exit;
  		 
  		
  		 



  		/*//$angka = $this->cm->periode_to_bulan($periode,$bulan);

  		//print_r($angka);

  		//exit;  */

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


		 $html = $this->load->view("pdf/cetak_realisasi_table_data",$data,true);
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
		 	$html = $this->load->view("pdf/cetak_realisasi_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/cetak_realisasi_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }  

		  $pdf->Output('Ringkasan RAPBDes '. $this->session->userdata("tahun") .'.pdf', 'I');
	}
 

}

?>