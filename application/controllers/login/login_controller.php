<?php
class Login_controller extends CI_Controller {
	function login() {
		if($this->input->post('loginbtn')) {
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			$users = $this->user_model->get_record_by_username($username);
			if($users) {
				$user = $users['0']; 
				$db_password = $user->password;
				
				if ($password == $db_password) {
					$data = array(
					'username' => $username,
					'password' => $password
					);
					$this->session->set_userdata($data);
					if($this->input->post('rememberme') && $this->input->post('rememberme') == '1') {
						$cookie1 = array(
								'name'    => 'username',
								'value'   => $username,
								'expire'  => time() + 86500
						);
						set_cookie($cookie1);
						
						$cookie2 = array(
								'name'    => 'password',
								'value'   => md5($password),
								'expire'  => time() + 86500
						);
						set_cookie($cookie2);
					} else {
						$cookie1 = array(
								'name'   => 'username',
								'value'  => '',
								'expire' => '0'
						);
						
						delete_cookie($cookie1);
						
						$cookie2 = array(
								'name'   => 'password',
								'value'  => '',
								'expire' => '0'
						);
						
						delete_cookie($cookie2);
					}
					redirect('home');
				} else {
					echo "Sai password";
				}
			} else {
				echo "Ko ton tai username nay";
			}
			
		}
	}
	
	function logout() {
		$this->session->sess_destroy();
		redirect('home');
	}
	
}