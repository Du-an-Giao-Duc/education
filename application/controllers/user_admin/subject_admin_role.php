<?php
class Subject_admin_role extends CI_Controller {
	
	function index() {
		
		$data = array();
		if ($this->input->post('submit') && $this->input->post('username')) {
			$username = $this->input->post('username');
			$query = $this->user_model->get_subject_admin_user($username);
		} else {
			$query = $this->user_model->get_subject_admin_user();
		}
		
		$data['records'] = $query;
		
		$content = $this->load->view('user/subject_admin_role/subject_admin_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "User";
		$data['leftmenu'] = $this->config->item('user_admin_left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function update($username='') {
		if($this->input->post('submit'))
		{
			$username = $this->input->post('username');
				
			$roles = $this->input->post('role_code[]');
			$this->user_model->delete_user_role_code($username);
			if($roles) {
				foreach ($roles as $role_code) {
					$data['username'] = $username;
					$data['role_code'] = $role_code;
					$this->user_model->add_user_role_code($data);
				}
			}
				
			$data = array();
			$query = $this->user_model->get_subject_admin_user($username);
			$record = $query['0'];
			$subjects = $record['subjects'];
			$data['record'] = $record;
			$data['subjects'] = $subjects;
			$this->load->view('user/subject_admin_role/subject_admin_confirm', $data);
		}
		else
		{
			$data = array();
			if($query = $this->user_model->get_subject_admin_user($username))
			{
				$record = $query['0'];
				$selected_subjects = $record['subjects'];
				$data['record'] = $record;
				$data['selected_subjects'] = $selected_subjects;
				$subjects = $this->subject_model->get_all_records();
				$data['subjects'] = $subjects;
			}
			$this->load->view('user/subject_admin_role/subject_admin_update_form', $data);
		}
	}
	
}