<?php
class Admin extends CI_Controller {
	function index() {
		$data['title'] = "Admin Page";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = "My Content";
		$this->load->view('template', $data);
	}
}