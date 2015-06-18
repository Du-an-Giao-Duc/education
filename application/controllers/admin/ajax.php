<?php
class Ajax extends CI_Controller {
	function get_class_options() {
		$subject_id = $this->input->post('subject_id');
		
		$class_options = $this->chuong_model->get_class_options($subject_id);
		echo form_label('Class:', 'class'); 
		echo form_dropdown('class', $class_options, 
		set_value('class', 0), 'id="class"'); 
	}
	function get_chuong_options() {
		$class_id = $this->input->post('class_id');
	
		$chuong_options = $this->chuyende_model->get_chuong_options($chuong_id);
		echo form_label('Chuong:', 'chuong');
		echo form_dropdown('chuong', $chuong_options,
				set_value('chuong', 0), 'id="class"');
	}
	
	function register() {
		if($this->input->post('ajax')) {
			$this->form_validation->set_rules('username', 'Username', 'trim|required|is_unique[user.username]');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[user.email]');
				
			if($this->form_validation->run()==FALSE) {
				echo validation_errors('<p class="error">');
			} else {
				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$email = $this->input->post('email');
				$role = 5;
				$role_post = 0;
				$role_edit = 0;
				$reg_date = new DateTime();
				$mod_date = new DateTime();
				$data = array(
						'username' 	=> $username,
						'password' 	=> $password,
						'role'		=> $role,
						'role_post' => $role_post,
						'role_edit' => $role_edit,
						'email'     => $email
				);
		
				if($this->user_model->add_record($data)) {
					echo "Your account is created successfully";
				} else {
					echo "Cannot create your account";
				}
			}
		}
	}
}