<?php
class Home extends CI_Controller {
	function index() {
		$data['title'] = "Home Page";
		$data['leftmenu'] = array(
				'Contact' => 'home'
		);
		$data['content'] = "My Content";
		$this->load->view('template', $data);
	}
}