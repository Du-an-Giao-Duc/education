<?php
class Question_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('question');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('question');
		return $query->result();
	}
	
	function get_record_by_username($username) {
		$this->db->where('post_user', $username);
		$query = $this->db->get('question');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('question', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
		
	}
	
	function update_record_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('question', $data);
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
	
	function delete_record_by_id($id) {
		$this->db->where('id', $id);
		$this->db->delete('question');
	}
}