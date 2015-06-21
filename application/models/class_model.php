<?php
class Class_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('class');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('class');
		return $query->result();
	}
	
	function get_record_by_subject_id($subject_id) {
		$this->db->where('subject_id', $subject_id);
		$query = $this->db->get('class');
		return $query->result();
	}
	
	function add_record($data) {
		if ($this->db->insert('class', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
	}
	
	function update_record_by_id($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('class', $data);
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
		$this->db->delete('class');
	}
	
	function get_subject_options() {
		$rows = $this->db->select('id,name')
		->from('subject')
		->get()->result();
		
		$subject_options = array('0' => '');
		foreach ($rows as $row) {
			$subject_options[$row->id] = $row->name;
		}
		
		return $subject_options;
	}
	
	function search($subject_id, $limit, $offset, $sort_by, $sort_order) {
	
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id', 'name', 'subject_name', 'description');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
	
		// results query
		$q = $this->db->select('class.id, class.name, subject.name subject_name, class.description')
		->from('class')
		->join('subject','class.subject_id=subject.id','left')
		->limit($limit, $offset)
		->order_by($sort_by, $sort_order);
		
		if ($subject_id != 0) {
			$q->where('subject.id', $subject_id);
		}
	
		$ret['rows'] = $q->get()->result();
	
		// count query
		if ($subject_id != 0) {
			$q->where('subject_id', $subject_id);
		}
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('class');
		
		$tmp = $q->get()->result();
	
		$ret['num_rows'] = $tmp[0]->count;
	
		return $ret;
	}
	
	function get_record_by_name_id($name, $id) {
		$class = $this->get_record_by_id($id);
		$subject_id = $class['0'] ->subject_id;
		
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$this->db->where('subject_id', $subject_id);
		$query = $this->db->get('class');
		return $query->result();
	}
	
	function get_record_by_name_subject_id($name, $subject_id) {
		$this->db->where('name', $name);
		$this->db->where('subject_id', $subject_id);
		$query = $this->db->get('class');
		return $query->result();
	}
}