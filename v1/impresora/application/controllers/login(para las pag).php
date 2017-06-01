<?php
class Login extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		$data["pagina"] = "panel/panel_user";
		$this->load->view("conjunto_vistas", $data);
	}	
}
?>