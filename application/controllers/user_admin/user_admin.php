<?php
class User_admin extends CI_Controller {
	function index() {
		$data['title'] = "User Admin";
		$data['leftmenu'] = $this->config->item('user_admin_left_menu');
		$data['content'] = "My Content";
		$this->load->view('template', $data);
	}
}