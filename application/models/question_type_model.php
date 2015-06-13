<?php
class Question_type_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('question_type');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('question_type');
		return $query->result();
	}
	
	function get_record_by_name_id($name, $id) {
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$query = $this->db->get('question_type');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('question_type', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
		
	}
	
	function update_record_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('question_type', $data);
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
		$this->db->delete('question_type');
		if($subject_id = $this->session->userdata['question_type_id']) {
			if($question_type_id == $id) {
				$this->session->unset_userdata('question_type_id');
			}
		}
		
	}
}