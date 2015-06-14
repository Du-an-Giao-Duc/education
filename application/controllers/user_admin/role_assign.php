<?php
class Role_assign extends CI_Controller {
	
	function index() {
		
		$data = array();
		if ($this->input->post('submit') && $this->input->post('username')) {
			$username = $this->input->post('username');
			$query = $this->user_model->get_record_by_username($username);
		} else {
			$query = $this->user_model->get_all_records();
		}
		
		$data['records'] = $query;
		
		$content = $this->load->view('user/user_role/user_list', $data, TRUE);
		
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
				
				$data = array(
						'role' => $this->input->post('role'),
						'role_post'   => $this->input->post('role_post'),
						'role_edit'   => $this->input->post('role_edit')
				);
				
				$return_true = $this->user_model->update_record_by_username($username, $data);
				
				$data = array();
				if($return_true) {
					$query = $this->user_model->get_record_by_username($username);
					$data['record'] = $query;
				}
				$this->load->view('user/user_role/user_confirm', $data);
		}
		else
		{
			$data = array();
			if($query = $this->user_model->get_record_by_username($username))
			{
				$data['record'] = $query;
				$roles = $this->config->item('roles');
				$data['role_options'] = $roles;
			}
			$this->load->view('user/user_role/user_update_form', $data);
		}
	}
	
	function delete($username) {
		$return_true = $this->user_model->delete_record_by_username($username);
		redirect("user_admin/role_assign");
	}
}