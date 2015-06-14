<?php
class Class_admin_role extends CI_Controller {
	
	function index() {
		
		$data = array();
		if ($this->input->post('submit') && $this->input->post('username')) {
			$username = $this->input->post('username');
			$query = $this->user_model->get_class_admin_user($username);
		} else {
			$query = $this->user_model->get_class_admin_user();
		}
		
		$data['records'] = $query;
		
		$content = $this->load->view('user/class_admin_role/class_admin_list', $data, TRUE);
		
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
			$query = $this->user_model->get_class_admin_user($username);
			$record = $query['0'];
			$classes = $record['classes'];
			$data['record'] = $record;
			$data['classes'] = $classes;
			$this->load->view('user/class_admin_role/class_admin_confirm', $data);
		}
		else
		{
			$data = array();
			if($query = $this->user_model->get_class_admin_user($username))
			{
				$record = $query['0'];
				$selected_classes = $record['classes'];
				$data['record'] = $record;
				$data['selected_classes'] = $selected_classes;
				$classes = $this->class_model->get_record_by_subject_id($record['subject_id']);
				$data['classes'] = $classes;
				$data['subject_options'] = $this->class_model->get_subject_options();
			}
			$this->load->view('user/class_admin_role/class_admin_update_form', $data);
		}
	}
	
}