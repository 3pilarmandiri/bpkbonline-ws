<?php
class log_transfer extends master_controller {

	function log_transfer(){
		parent::__construct();
		$this->load->model("log_tm","dm");
	}

	function index(){


		// $data['arr_kec'] = $this->dm->get_arr_kec();
		// $this->load->view("pilih_view",$data);

		$data['controller'] = get_class($this);
		$data['title'] = "DATA TRANFER DATA DESA";
		$data['rec_kecamatan'] = $this->dm->get_data_kecamatan();
	
	 
	   	$content = $this->load->view($data['controller']."_view",$data,true);
		$this->set_title($data['title']);
		$this->set_subtitle($data['title']);
		$this->set_content($content);
		$this->render_baru();
	}

	function simpan(){
		$data = $this->input->post();
		$this->session->set_userdata("id_desa",$data['id_desa']);
		$this->session->set_userdata("tahun",$data['tahun']);

		$this->db->where("id_desa",$data['id_desa']);

		$data_desa = $this->db->get("lokasi")->row_array();
		$this->session->set_userdata("data_desa",$data_desa);
		
		redirect("depan_baru");
	}

}
?>