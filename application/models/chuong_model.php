<?php
class Chuong_model extends CI_Model {
	function get_all_records() {
		$query = $this->db->get('chuong');
		return $query->result();
	}
	
	function get_record_by_id($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('chuong');
		return $query->result();
	}
	
	function get_record_by_class_id($class_id) {
		$this->db->where('class_id', $class_id);
		$query = $this->db->get('chuong');
		return $query->result();
	}
	
	function add_record($data) {
		$order_number = $data['order_number'];
		
		$this->db->where('order_number >=', $order_number);
		$records = $this->db->get('chuong')->result();
		if ($records) {
			foreach ($records as $chuong) {
				$data_1['order_number'] = $chuong->order_number + 1;
				$this->db->where('id', $chuong->id);
				$this->db->update('chuong', $data_1);
			}
		}
		
		$data['order_number'] = $order_number;
		if ($this->db->insert('chuong', $data)) {
			$id = $this->db->insert_id();
			return $id;
		} else {
			return 0;
		}
	}
	
	function update_record_by_id($id, $data) {
		
		$record = $this->get_record_by_id($id);
		$old_order_number = $record[0]->order_number;
		
		$new_order_number = $data['order_number'];
		
		if ($old_order_number < $new_order_number) {
			$this->db->where('order_number >', $old_order_number);
			$this->db->where('order_number <=', $new_order_number);
			$records = $this->db->get('chuong')->result();
			if ($records) {
				foreach ($records as $chuong) {
					$data_1['order_number'] = $chuong->order_number - 1;
					$this->db->where('id', $chuong->id);
					$this->db->update('chuong', $data_1);
				}
			}
		} else if($old_order_number > $new_order_number) {
			$this->db->where('order_number <', $old_order_number);
			$this->db->where('order_number >=', $new_order_number);
			$records = $this->db->get('chuong')->result();
			if ($records) {
				foreach ($records as $chuong) {
					$data_1['order_number'] = $chuong->order_number + 1;
					$this->db->where('id', $chuong->id);
					$this->db->update('chuong', $data_1);
				}
			}
		}
		
		$this->db->where('id', $id);
		$this->db->update('chuong', $data);
		
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
		$record = $this->get_record_by_id($id);
		$order_number = $record[0]->order_number;
		
		$this->db->where('order_number >', $order_number);
		$records = $this->db->get('chuong')->result();
		if ($records) {
			foreach ($records as $chuong) {
				$data['order_number'] = $chuong->order_number - 1;
				$this->db->where('id', $chuong->id);
				$this->db->update('chuong', $data);
			}
		}
		$this->db->where('id', $id);
		$this->db->delete('chuong');
	}
	
	function get_class_options($subject_id) {
		$rows = $this->db->select('id,name')
		->from('class')
		->where('subject_id', $subject_id)
		->get()->result();
		
		$class_options = array('0' => '');
		foreach ($rows as $row) {
			$class_options[$row->id] = $row->name;
		}
		
		return $class_options;
	}
	
	function get_order_number_options($class_id) {
		
		$rows = $this->db->select('order_number')
		->from('chuong')
		->where('class_id', $class_id)
		->order_by('order_number')
		->get()->result();
		
		$options = array();
		if($rows) {
			foreach ($rows as $row) {
				$options[$row->order_number] = $row->order_number;
			}
		}
		
		return $options;
	}
	
	
	function search($subject_id, $class_id, $limit, $offset, $sort_by, $sort_order) {
	
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id', 'order_number', 'semester' , 'name', 'class_name', 'description');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
	
		// results query
		$q = $this->db->select('chuong.id, chuong.order_number , chuong.semester, chuong.name, class.name class_name, chuong.description')
		->from('chuong')
		->join('class', 'chuong.class_id=class.id','left')
		->join('subject','class.subject_id=subject.id','left')
		->limit($limit, $offset)
		->order_by($sort_by, $sort_order);
		
		if ($subject_id != 0) {
			$q->where('subject.id', $subject_id);
		}
		
		if ($class_id != 0) {
			$q->where('class.id', $class_id);
		}
	
		$ret['rows'] = $q->get()->result();
	
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('chuong')
		->join('class', 'chuong.class_id=class.id','left')
		->join('subject','class.subject_id=subject.id','left');
		
		if ($subject_id != 0) {
			$q->where('subject.id', $subject_id);
		}
		
		if ($class_id != 0) {
			$q->where('class.id', $class_id);
		}
		
		$tmp = $q->get()->result();
	
		$ret['num_rows'] = $tmp[0]->count;
	
		return $ret;
	}
	
	function get_record_by_name_id($name, $id) {
		
		$chuong = $this->get_record_by_id($id);
		$class_id = $chuong['0']->class_id;
		
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$this->db->where('class_id', $class_id);
		$query = $this->db->get('chuong');
		return $query->result();
	}
}