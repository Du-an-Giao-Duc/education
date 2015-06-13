<?php
class Dang_bai_admin extends CI_Controller {
	function index() {
		$data['title'] = "News";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = "Welcome to dang bai admin";
		$this->load->view('template', $data);
	}
}