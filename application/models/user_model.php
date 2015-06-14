<?php
class User_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function get_record_by_username($username) {
		$this->db->where('username', $username);
		$query = $this->db->get('user');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('user', $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	function update_record_by_username($username, $data) {
		$this->db->where('username', $username);
		$this->db->update('user', $data);
		if($this->db->affected_rows() > 0) {
			return true;
		} else
		{
			if($this->db->trans_status() == false){
				return false;
			}
			return true;
		}
		
	}
	
	function delete_record_by_username($username) {
		$this->db->where('username', $username);
		$this->db->delete('user');
		if($user_name = $this->session->userdata['username']) {
			if($user_name == $username) {
				$this->session->unset_userdata('username');
			}
		}
	}
	
	function delete_user_role_code($username) {
		$this->db->where('username', $username);
		$this->db->delete('user_role_code');
	}
	
	function add_user_role_code($data) {
		if ($this->db->insert('user_role_code', $data)) {
			return true;
		} else {
			return false;
		}
	}
	
	function get_subject_admin_user($username='') {
		
		$this->db->where('role','2');
		if($username !='') {
			$this->db->where('username',$username);
		}
		$query = $this->db->get('user')->result();
		
		if($query) {
			$i = 0;
			$ret = array();
			foreach ($query as $user) {
				$username = $user->username;
				$q = $this->db->select('subject.id, subject.name')
				->from('user_role_code')
				->join('subject','user_role_code.role_code=subject.id','left')
				->where('user_role_code.username', $username);
				
				$subjects = $q->get()->result();
				
				$record = array();
				$record['username'] = $username;
				$record['role']     = '2';
				$record['subjects'] = $subjects;
				$ret[$i] = $record;
				
				$i++;
				
			}
			return $ret;
		} else {
			return NULL;
		}
	}
}