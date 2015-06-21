<?php
class User_admin extends CI_Controller {
	function index() {
		$data['title'] = "Trang quản trị User";
		$data['leftmenu'] = $this->config->item('user_admin_left_menu');
		$data['content'] = "Click vào menu bên trái để quản trị User";
		$this->load->view('template', $data);
	}
}