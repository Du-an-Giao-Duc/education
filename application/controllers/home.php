<?php
class Home extends CI_Controller {
	function index() {
		
		//if right username and password, keep session else remove session
		if(isset($this->session->userdata['username'])) {
			$username = $this->session->userdata['username'];
			if(!isset($this->session->userdata['password'])) {
				$this->session->unset_userdata('username');
				$this->session->unset_userdata('role');
			} else {
				$password = $this->session->userdata['password'];
				$users = $this->user_model->get_record_by_username($username);
				if(!$users) {
					$this->session->unset_userdata('username');
					$this->session->unset_userdata('password');
					$this->session->unset_userdata('role');
					
				} else {
					$user = $users[0];
					if($user->password != $password) {
						$this->session->unset_userdata('username');
						$this->session->unset_userdata('password');
						$this->session->unset_userdata('role');
					}
				}
			}
		}
		
		$data = array();
		$subject_options = $this->class_model->get_subject_options();
		$data['subject_options'] = $subject_options;
		$data['question_status_options'] = $this->config->item('question_status_options');
		$content = $this->load->view('test_cau_hoi',$data,true);
		
		$data = array();
		$data['title'] = "Trang chủ";
		$data['leftmenu'] = array(
				'Liên Hệ' => 'home'
		);
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
}