<?php 
class Login extends CI_Controller {
	function __construct(){
		parent::__construct();
		//$this->load->helper("serviceurl");
		
	}
	
	function index(){
		$this->load->view("login_view");
	}
	
	
	function logout(){
		$this->session->unset_userdata("login",true);
		redirect("login");
	}
	
	function ceklogin(){

		$data = $this->input->post();
		$this->db->select("*");
		$this->db->where("username",$data['username']);
		$this->db->where("password",$data['password']);
		$this->db->from("login");
		$res = $this->db->get();
		// echo $this->db->last_query(); exit;

		if($res->num_rows() == 1 ) {
			$this->session->set_userdata("login",true);
			$userdata = $res->row_array();
			///show_array($userdata);
			$this->session->set_userdata("userdata",$userdata);
			$ret = array("error"=>false,"message"=>"Login gagal");
		}
		else {
			$ret = array("error"=>true,"message"=>"Login gagal");
		}

		echo json_encode($ret);


		 
		 
		 
	}
}

?>