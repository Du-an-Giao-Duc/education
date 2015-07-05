<?php
class Quiz_type_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('quiz_type');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('quiz_type');
		return $query->result();
	}
	
	function get_record_by_name_id($name, $id) {
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$query = $this->db->get('quiz_type');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('quiz_type', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
		
	}
	
	function update_record_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('quiz_type', $data);
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
		$this->db->delete('quiz_type');
		if($quiz_type_id = $this->session->userdata['quiz_type_id']) {
			if($quiz_type_id == $id) {
				$this->session->unset_userdata('quiz_type_id');
			}
		}
		
	}
}