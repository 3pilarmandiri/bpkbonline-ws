<?php
class pilih extends master_controller {

	function pilih(){
		parent::__construct();
		$this->load->model("polda_m","dm");
	}

	function index(){


		$data['arr_kec'] = $this->dm->get_arr_kec();
		$this->load->view("pilih_view",$data);
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