<?php
class Admin extends CI_Controller {
	function index() {
		$data['title'] = "Trang quản trị chung";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = "Chọn menu bên trái để chỉnh sửa các thông tin";
		$this->load->view('template', $data);
	}
}