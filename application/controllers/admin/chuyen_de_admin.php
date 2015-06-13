<?php
class Chuyen_de_admin extends CI_Controller {
	function index() {
		$data['title'] = "News";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = "Welcome to chuyen de admin";
		$this->load->view('template', $data);
	}
}