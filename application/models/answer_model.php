<?php
class Answer_model extends CI_Model {
	function get_record_by_question_id($question_id) {
		$this->db->where('question_id', $question_id);
		$query = $this->db->get('answer');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('answer');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('answer', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
		
	}
	
	function delete_record_by_id($id) {
		$this->db->where('id', $id);
		$this->db->delete('answer');
	}
}