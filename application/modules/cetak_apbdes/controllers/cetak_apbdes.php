<?php 
class cetak_apbdes extends  master_controller {
	 
	function __construct() {
		parent::__construct();
 
 		$this->load->model("core_model","cm");
 		$this->load->model("add_model","add");
 		$this->load->model("cam","dm");
		$this->load->helper("tanggal");
 		 
		 
	}


	function index()
    {
    $data['controller'] = get_class($this);
	$data['title'] = "CETAK DOKUMEN ANGGARAN";
	
	 
   	$content = $this->load->view($data['controller']."_view",$data,true);
	$this->set_title($data['title']);
	$this->set_subtitle($data['title']);
	$this->set_content($content);
	$this->render_baru();
	}

	function ringkasan(){
		$data['rec_pendapatan'] = $this->dm->get_data_pendapatan();
		$data['rec_belanja'] = $this->dm->get_data_belanja();
		$data['rec_pembiayaan'] = $this->dm->get_data_pembiayaan();
		$this->load->view("r_ringkasan_view",$data);
	}

	function penjabaran(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
		$this->load->view("r_penjabaran_view",$data);

	}


	function anggarankas(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
		$this->load->view("anggaran_kas_view",$data);
	}

	function dpa(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
 		$this->load->view("dpa_view",$data);
	}


	function rka(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
 		$this->load->view("rka_view",$data);
	}

	function cek(){
		 $pesan = "";
		 if($this->dm->cek("pendapatan") > 1 ) {
		 	$pesan .= " *  Anggaran Kas Pendapatan ada yang belum diisi<br />";
		 	$x = 0;
		 }
		 else {
		 	$x= 1;
		 }


		 if($this->dm->cek("v_belanja") > 1 ) {
		 	$pesan .= "*  Anggaran Kas Belanja ada yang belum diisi <br />";
		 	$y = 0;
		 }
		 else {
		 	$y= 1;
		 }

		 if($this->dm->cek("pembiayaan") > 1 ) {
		 	$pesan .= "*  Anggaran Kas Pembiayaan ada yang belum diisi <br />";
		 	$z = 0;
		 }
		 else {
		 	$z= 1;
		 }

		 $this->db->where("tahun", $this->session->userdata("tahun_anggaran") );
		 $jumlah  = $this->db->get("perdes")->num_rows();
		 if($jumlah == 0 ){
		 	$pesan .= "*  Data Perdes Belum Diisi <br />";
		 	$xxx = 0;
		 }
		 else {
		 	$xxx=1;
		 }
		  
		 $final = $x * $y * $z * $xxx;

		 $array=array("success"=>$final,"pesan"=>$pesan);
		 echo json_encode($array);

	}


function dpa_desa(){
		$data['rec_pendapatan'] = $this->dm->get_data_pendapatan();
		$data['rec_belanja'] = $this->dm->get_data_belanja();
		$data['rec_pembiayaan'] = $this->dm->get_data_pembiayaan();

		// $data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		// $data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		// $data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();

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
		$pdf->AddPage();


		 // $html = $this->load->view("pdf/ringkasan_pdf_head",$data,true);
		 // $pdf->writeHTML($html, true, false, true, false, '');


		 $html = $this->load->view("dpa_desa/ringkasan_pdf_table_data",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 // echo $html;

		 $halaman  = $pdf->getPage();
		 $pdf->startTransaction();
		 $html = $this->load->view("dpa_desa/pdf_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------

		 if($halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("dpa_desa/ringkasan_pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("dpa_desa/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 $pdf->Output('dpa_desa.dpa_desa', 'I');
	}



	function pdf_ringkasan(){
		$data['rec_pendapatan'] = $this->dm->get_data_pendapatan();
		$data['rec_belanja'] = $this->dm->get_data_belanja();
		$data['rec_pembiayaan'] = $this->dm->get_data_pembiayaan();

		// $data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		// $data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		// $data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();

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
		$pdf->AddPage();


		 // $html = $this->load->view("pdf/ringkasan_pdf_head",$data,true);
		 // $pdf->writeHTML($html, true, false, true, false, '');


		 $html = $this->load->view("pdf/ringkasan_pdf_table_data",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 // echo $html;

		 $halaman  = $pdf->getPage();
		 $pdf->startTransaction();
		 $html = $this->load->view("pdf/pdf_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------

		 if($halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 $pdf->Output('ringkasan_apbdes.pdf', 'I');
	}

	function pdf_penjabaran(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
		

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
		$pdf->AddPage('P');


		 // $html = $this->load->view("pdf/penjabaran_pdf_head",$data,true);
		 // $pdf->writeHTML($html, true, false, true, false, '');

		 $html = $this->load->view("pdf/penjabaran_pdf_table_data",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		 
		 // cek current page number  
		  $y = $pdf->getY();
		 $halaman  = $pdf->getPage();
		 $pdf->startTransaction();
		 $html = $this->load->view("pdf/pdf_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------

		 if($halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/penjabaran_pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		
 		else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/penjabaran_pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }
	


		//$html  = $pdf->getPage();
		//$pdf->writeHTML("halaman  ".$html, true, false, true, false, '');
		//Close and output PDF document
		$pdf->Output('penjabaran_apbdesa.pdf', 'I');

	}


	function pdf_anggarankas(){

		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('Anggaran Kas');
		//$pdf->SetHeaderMargin(30);
		//$pdf->SetTopMargin(10);

		$pdf->SetMargins(10, 10, 10);
		$pdf->SetHeaderMargin(10);
		$pdf->SetFooterMargin(10);
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

 		$pdf->SetAutoPageBreak(true,10);
		$pdf->SetAuthor('Firmansyah');
		 
			
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(true);

		 // add a page
		$pdf->AddPage('L','F4');

		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
		$data['pdf'] = $pdf;
		// $this->load->view("anggaran_kas_view",$data);
		$html = $this->load->view("pdf/anggaran_kas_pdf_head",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');
		 

		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/anggaran_kas_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');


		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/anggaran_kas_pdf_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/anggaran_kas_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/anggaran_kas_pdf_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/anggaran_kas_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 


		$pdf->Output('anggaran_kas.pdf', 'I');
	}



	function pdf_dpa(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		//$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		///$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();
 		//$this->load->view("dpa_view",$data);

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
		$pdf->AddPage();

		$data['jenis'] = "PENDAPATAN";
		$data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN DESA";
		$data['verifikasi'] = $this->dm->get_verifikasi();
		$html = $this->load->view("pdf/cover",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->AddPage();
		$html = $this->load->view("pdf/dpa_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		  if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		 // belanja 
 
		


		$pdf->Output('DPA.pdf', 'I');

	}


	function pdf_dpa_pembiayaan(){



		//$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		//$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		
 		//$this->load->view("dpa_view",$data);

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

		$pdf->AddPage();

		$data['jenis'] = "PEMBIAYAAN";
		$data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN DESA";
		$data['verifikasi'] = $this->dm->get_verifikasi();
		$html = $this->load->view("pdf/cover_pembiayaan",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');


		// penerimaan
		$data['id'] = "3_1";
		$data['no_dpa'] = "3.1";
		$data['dpa_jenis'] = "1";
		$data['judul'] = "Rincian Penerimaan Pembiayaan";
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan_jenis($data['id']); 
		$data['ttd_title'] = "Rencana Penerimaan Dana Per Triwulan";

		//$data['t1'] = $this->add->subtotal_tw($data['id'],"v_pembiayaan","t1",$this->tahun,$this->id_desa);
		$data['t1'] = $this->add->get_total_by_id("pembiayaan","t1",$data['id'],$this->id_desa,$this->tahun);
		$data['t2'] = $this->add->get_total_by_id("pembiayaan","t2",$data['id'],$this->id_desa,$this->tahun);
		$data['t3'] = $this->add->get_total_by_id("pembiayaan","t3",$data['id'],$this->id_desa,$this->tahun);
		$data['t4'] = $this->add->get_total_by_id("pembiayaan","t4",$data['id'],$this->id_desa,$this->tahun);

		$data['total'] = $this->add->get_total_by_id("pembiayaan","total",$data['id'],$this->id_desa,$this->tahun);


		$pdf->AddPage();
		$html = $this->load->view("pdf/dpa_pembiayaan_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_pembiayaan_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_pembiayaan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_pembiayaan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }



/// pengeluaran pembiayaan 
		 // penerimaan
		$data['id'] = "3_2";
		$data['no_dpa'] = "3.2";
		$data['dpa_jenis'] = "2";
		$data['judul'] = "Rincian Pengeluaran Pembiayaan";
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan_jenis($data['id']); 
		$data['ttd_title'] = "Rencana Pengeluaran Dana Per Triwulan";

		$data['t1'] = $this->add->get_total_by_id("pembiayaan","t1",$data['id'],$this->id_desa,$this->tahun);
		//$this->add->subtotal_tw($data['id'],"v_pembiayaan","t1",$this->tahun,$this->id_desa);
		$data['t2'] = $this->add->get_total_by_id("pembiayaan","t2",$data['id'],$this->id_desa,$this->tahun);
		$data['t3'] = $this->add->get_total_by_id("pembiayaan","t3",$data['id'],$this->id_desa,$this->tahun);
		$data['t4'] = $this->add->get_total_by_id("pembiayaan","t4",$data['id'],$this->id_desa,$this->tahun);

		$data['total'] = $this->add->get_total_by_id("pembiayaan","total",$data['id'],$this->id_desa,$this->tahun);


		$pdf->AddPage();
		$html = $this->load->view("pdf/dpa_pembiayaan_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_pembiayaan_keluar_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_pembiayaan_keluar_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_pembiayaan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		$pdf->Output('DPA_Pembiayaan.pdf', 'I');

	}



function pdf_dpa_rekap(){
	 
		$data['get_rekap_kegiatan'] = $this->dm->get_rekap_kegiatan();
		$data['verifikasi'] = $this->dm->get_verifikasi();
 		 
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

		// $pdf->AddPage('L');

		// $data['jenis'] = "PEMBIAYAAN";
		// $data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN DESA";
		// $data['verifikasi'] = $this->dm->get_verifikasi();
		// $html = $this->load->view("pdf/cover_pembiayaan",$data,true);		 
		// $pdf->writeHTML($html, true, false, true, false, '');

		$pdf->AddPage('L');
		$html = $this->load->view("pdf/dpa_rekap_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_rekap_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage('L');
		 	$html = $this->load->view("pdf/dpa_rekap_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_rekap_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		$pdf->Output('DPA.pdf', 'I');

	}




function pdf_dpa_sd(){
	 
		$data['get_rekap_kegiatan'] = $this->dm->get_rekap_sd();
		$data['verifikasi'] = $this->dm->get_verifikasi();
 		 
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

		// $pdf->AddPage('L');

		// $data['jenis'] = "PEMBIAYAAN";
		// $data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN DESA";
		// $data['verifikasi'] = $this->dm->get_verifikasi();
		// $html = $this->load->view("pdf/cover_pembiayaan",$data,true);		 
		// $pdf->writeHTML($html, true, false, true, false, '');

		$pdf->AddPage('P');
		$html = $this->load->view("pdf/dpa_rekap_sd_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_rekap_sd_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage('L');
		 	$html = $this->load->view("pdf/dpa_rekap_sd_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_sd_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_rekap_sd_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_sd_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		$pdf->Output('rekap_sumber_dana.pdf', 'I');

	}



function pdf_dpa_belanja($id_kegiatan){
		//echo "test"; exit;
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

		$pdf->AddPage();


		$this->db->where("tahun",$this->tahun);
		$this->db->where("id_desa",$this->id_desa);
		$this->db->where("id_kegiatan",$id_kegiatan);
		$rx = $this->db->get("kegiatan_detail");
		// echo $this->db->last_query(); exit;
		if($rx->num_rows() == 0 ) {
			echo "DATA TIDAK DITEMUKAN"; 
			exit;
		}


		$data['jenis'] = "BELANJA";
		$data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN BELANJA DESA";

		$data['detail_kegiatan'] = $this->dm->get_detail_kegiatan($id_kegiatan);
		// echo $this->db->last_query();
		// show_array($data['detail_kegiatan'] );
		// exit;

		$data['detail_bidang']   = $this->dm->get_detail_bidang($id_kegiatan);
		$data['id_kegiatan'] = $id_kegiatan;
		$data['verifikasi'] = $this->dm->get_verifikasi();

		//show_array($data); exit;
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja("2_".$id_kegiatan);
		$html = $this->load->view("pdf/cover_belanja",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		$pdf->AddPage();
		$html = $this->load->view("pdf/dpa_belanja_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		//$pdf->Output('DPA.pdf', 'I'); exit;

		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_belanja_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 //$pdf->Output('DPA.pdf', 'I'); exit;
		 if( $halaman <> $pdf->getPage() ) {
		 	//echo "yang in kan ? " ; 
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');
		 	//$pdf->Output('DPA.pdf', 'I'); exit;
		 	$html = $this->load->view("pdf/dpa_belanja_ttd",$data,true);
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



	function pdf_rka(){
		$data['rec_penjabaran_pendapatan'] = $this->dm->get_data_penjabaran_pendapatan();
		$data['rec_penjabaran_belanja'] = $this->dm->get_data_penjabaran_belanja();
		$data['rec_penjabaran_pembiayaan'] = $this->dm->get_data_penjabaran_pembiayaan();

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
		$pdf->AddPage();

		 $html = $this->load->view("pdf/cover_rka",$data,true);  
		$pdf->writeHTML($html, true, false, true, false, '');		 

// PENDAPATAN 
		$pdf->AddPage();
		$html = $this->load->view("pdf/rka_pendapatan_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');

		$pdf->startTransaction();
		 $halaman  = $pdf->getPage();
		 $y = $pdf->getY();		 
		 $html = $this->load->view("pdf/rka_pendapatan_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_pendapatan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_pendapatan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_pendapatan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_pendapatan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

// BELANJA 
		$pdf->AddPage();
		$html = $this->load->view("pdf/rka_belanja_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');


		$pdf->startTransaction();
		 $halaman  = $pdf->getPage();
		 $y = $pdf->getY();		 
		 $html = $this->load->view("pdf/rka_belanja_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_belanja_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_belanja_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

// PEMBIAYAAN 
		 $pdf->AddPage();
		 $html = $this->load->view("pdf/rka_pembiayaan_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');


		$pdf->startTransaction();
		 $halaman  = $pdf->getPage();
		 $y = $pdf->getY();		 
		 $html = $this->load->view("pdf/rka_pembiayaan_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_pembiayaan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/rka_pembiayaan_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/rka_pembiayaan_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		$pdf->Output('RKA.pdf', 'I');
	}


	function rincian_program($id_kegiatan){


		$this->db->where("id",$id_kegiatan);
		$data = $this->db->get("akun_program")->row_array();

		$this->db->where("id",$data['pid']);
		$xx = $this->db->get("akun_program")->row_array();
		$data['program'] = $xx['nama'];
		$data['kode_program'] = $xx['kode'];



		//$this->dm->init_rincian_program($id_kegiatan);
		$data['get_rekening_rincian'] = $this->dm->get_rekening_rincian($id_kegiatan);

		$this->load->library('Pdf');
		$pdf = new Pdf('L', 'mm', 'F4', true, 'UTF-8', false);
		$pdf->SetTitle('RINCIAN PROGRAM');
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

		
		 $html = $this->load->view("rincian_program/rincian_program_pdf_table_data",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');



		 $halaman  = $pdf->getPage();
		 $pdf->startTransaction();
		 $y = $pdf->getY();
		 $html = $this->load->view("rincian_program/pdf_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');
		// ---------------------------------------------------------

		 if($halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage();
		 	$html = $this->load->view("rincian_program/rincian_program_pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("rincian_program/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("rincian_program/rincian_program_pdf_table_header",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("rincian_program/pdf_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 $pdf->Output('Rencana Anggaran Belanja '. $this->session->userdata("tahun") .'.pdf', 'I');

}




function pdf_dpa_rekap_belanja(){
	 
		//$data['get_rekap_kegiatan'] = $this->dm->get_rekap_sd();

		$data['rec_pendapatan'] = $this->dm->get_data_pendapatan();
		$data['rec_pembiayaan'] = $this->dm->get_data_pembiayaan();
		$data['get_rekap_belanja'] = $this->dm->rekap_belanja();
		$data['verifikasi'] = $this->dm->get_verifikasi();
 		 
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

		// $pdf->AddPage('L');

		// $data['jenis'] = "PEMBIAYAAN";
		// $data['jenis_dokumen'] = "DOKUMEN PELAKSANAAN ANGGARAN DESA";
		// $data['verifikasi'] = $this->dm->get_verifikasi();
		// $html = $this->load->view("pdf/cover_pembiayaan",$data,true);		 
		// $pdf->writeHTML($html, true, false, true, false, '');

		$pdf->AddPage('P');
		$html = $this->load->view("pdf/dpa_rekap_belanja_header",$data,true);		 
		$pdf->writeHTML($html, true, false, true, false, '');



		 $pdf->startTransaction();

		 $halaman  = $pdf->getPage();
		 

		 $y = $pdf->getY();
		 
		 $html = $this->load->view("pdf/dpa_rekap_belanja_ttd",$data,true);
		 $pdf->writeHTML($html, true, false, true, false, '');

		 if( $halaman <> $pdf->getPage() ) {
		 	$pdf->rollbackTransaction(true);

		 	$pdf->AddPage('L');
		 	$html = $this->load->view("pdf/dpa_rekap_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_belanja_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }

		 else if( $y < 20 ) {
		 	$pdf->rollbackTransaction(true);

		 	//$pdf->AddPage();
		 	$html = $this->load->view("pdf/dpa_rekap_belanja_table_head",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 	$html = $this->load->view("pdf/dpa_rekap_belanja_ttd",$data,true);
		 	$pdf->writeHTML($html, true, false, true, false, '');

		 }


		$pdf->Output('REKAP BELANJA.pdf', 'I');

	}



}

?>