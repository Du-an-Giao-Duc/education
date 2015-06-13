<?php
class Subject_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('subject');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('subject');
		return $query->result();
	}
	
	function get_record_by_name_id($name, $id) {
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$query = $this->db->get('subject');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('subject', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
		
	}
	
	function update_record_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('subject', $data);
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
		$this->db->delete('subject');
		if($subject_id = $this->session->userdata['subject_id']) {
			if($subject_id == $id) {
				$this->session->unset_userdata('subject_id');
			}
		}
		
	}
}