<?php
class Chuyen_de_model extends CI_Model{
	function get_all_record(){
		$query = $this->db->get('chuyen_de');
		return  $query->result();
	}
	
	function  get_record_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get('chuyen_de');
		return $query->result();
	}
	
	function  get_record_by_chuong_id($chuong_id){
		$this->db->where('chuong_id',$chuong_id);
		$query = $this->db->get('chuyen_de');
		return $query->result();
	}
	
	function add_record($data) {
		$order_number = $data['order_number'];
		
		$this->db->where('order_number >=', $order_number);
		$this->db->where('chuong_id', $data['chuong_id']);
		$records = $this->db->get('chuyen_de')->result();
		if ($records) {
			foreach ($records as $chuyende) {
				$data_1['order_number'] = $chuyende->order_number + 1;
				$this->db->where('id', $chuyende->id);
				$this->db->update('chuyen_de', $data_1);
			}
		}
		
		$data['order_number'] = $order_number;
		if ($this->db->insert('chuyen_de', $data)) {
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
			$this->db->where('chuong_id', $record[0]->chuong_id);
			$records = $this->db->get('chuyen_de')->result();
			if ($records) {
				foreach ($records as $chuyende) {
					$data_1['order_number'] = $chuyende->order_number - 1;
					$this->db->where('id', $chuyende->id);
					$this->db->update('chuyen_de', $data_1);
				}
			}
		} else if($old_order_number > $new_order_number) {
			$this->db->where('order_number <', $old_order_number);
			$this->db->where('order_number >=', $new_order_number);
			$this->db->where('chuong_id', $record[0]->chuong_id);
			$records = $this->db->get('chuyen_de')->result();
			if ($records) {
				foreach ($records as $chuyende) {
					$data_1['order_number'] = $chuyende->order_number + 1;
					$this->db->where('id', $chuyende->id);
					$this->db->update('chuyen_de', $data_1);
				}
			}
		}
		
		$this->db->where('id', $id);
		$this->db->update('chuyen_de', $data);
		
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
		$this->db->where('chuong_id', $record[0]->chuong_id);
		$records = $this->db->get('chuyen_de')->result();
		if ($records) {
			foreach ($records as $chuyende) {
				$data['order_number'] = $chuyende->order_number - 1;
				$this->db->where('id', $chuyende->id);
				$this->db->update('chuyen_de', $data);
			}
		}
		$this->db->where('id', $id);
		$this->db->delete('chuyen_de');
	}
	function get_chuong_options($class_id) {
		$rows = $this->db->select('id,name')
		->from('chuong')
		->where('class_id', $class_id)
		->get()->result();
	
		$chuong_options = array('0' => '');
		foreach ($rows as $row) {
			$chuong_options[$row->id] = $row->name;
		}
	
		return $chuong_options;
	}
	function search($subject_id,$class_id,$chuong_id, $limit, $offset, $sort_by, $sort_order) {
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id', 'order_number', 'name','chuong_name','class_name','subject_name','description');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
		// results query
		$q = $this->db->select('chuyen_de.id, chuyen_de.order_number, chuyen_de.name, chuong.name chuong_name, class.name class_name, subject.name subject_name, chuyen_de.description')
		->from('chuyen_de')
		->join('chuong','chuyen_de.chuong_id = chuong.id','left')
		->join('class','chuong.class_id = class.id','left')
		->join('subject','class.subject_id=subject.id','left')
		->limit($limit, $offset)
		->order_by($sort_by, $sort_order);
		if ($subject_id != 0) {
			$q->where('subject.id', $subject_id);
		}
		if($class_id != 0){
			$q->where('class.id',$class_id);
		}
		if($chuong_id != 0){
			$q->where('chuong.id',$chuong_id);
		}
	
		$ret['rows'] = $q->get()->result();
	
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('chuyen_de')
		->join('chuong','chuyen_de.chuong_id=chuong.id','left')
		->join('class', 'chuong.class_id=class.id','left')
		->join('subject','class.subject_id=subject.id','left');
		
		if ($subject_id != 0) {
			$q->where('subject.id', $subject_id);
		}
		
		if ($class_id != 0) {
			$q->where('class.id', $class_id);
		}
		if($chuong_id != 0){
			$q->where('chuong_id',$class_id);
		}
		
		$tmp = $q->get()->result();
	
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function get_order_number_options($chuong_id) {
	
		$rows = $this->db->select('order_number')
		->from('chuyen_de')
		->where('chuong_id', $chuong_id)
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
	
	function get_record_by_name_id($name, $id) {
	
		$chuyende = $this->get_record_by_id($id);
		$chuong_id = $chuyende['0']->chuong_id;
	
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$this->db->where('chuong_id', $chuong_id);
		$query = $this->db->get('chuyen_de');
		return $query->result();
	}
	
	function get_record_by_name_chuong_id($name, $chuong_id) {
		$this->db->where('name', $name);
		$this->db->where('chuong_id', $chuong_id);
		$query = $this->db->get('chuyen_de');
		return $query->result();
	}
}
