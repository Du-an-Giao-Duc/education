<?php
class Subject_model extends CI_Model {
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
}