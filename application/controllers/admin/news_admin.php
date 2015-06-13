<?php
class News_admin extends CI_Controller {
	function index() {
		$data['title'] = "News";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = "Welcome to news admin";
		$this->load->view('template', $data);
	}
}