<?php
class Dang_bai_model extends CI_Model{
	function get_all_record(){
		$query = $this->db->get('dang_bai');
		return  $query->result();
	}
	
	function  get_record_by_id($id){
		$this->db->where('id',$id);
		$query = $this->db->get('dang_bai');
		return $query->result();
	}
	
	function  get_record_by_chuyen_de_id($chuyen_de_id){
		$this->db->where('chuyen_de_id',$chuyen_de_id);
		$query = $this->db->get('dang_bai');
		return $query->result();
	}
	
	function add_record($data) {
		$order_number = $data['order_number'];
		
		$this->db->where('order_number >=', $order_number);
		$this->db->where('chuyen_de_id', $data['chuyen_de_id']);
		$records = $this->db->get('dang_bai')->result();
		if ($records) {
			foreach ($records as $dangbai) {
				$data_1['order_number'] = $dangbai->order_number + 1;
				$this->db->where('id', $dangbai->id);
				$this->db->update('dang_bai', $data_1);
			}
		}
		
		$data['order_number'] = $order_number;
		if ($this->db->insert('dang_bai', $data)) {
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
			$this->db->where('chuyen_de_id', $record[0]->chuyen_de_id);
			$records = $this->db->get('dang_bai')->result();
			if ($records) {
				foreach ($records as $dangbai) {
					$data_1['order_number'] = $dangbai->order_number - 1;
					$this->db->where('id', $dangbai->id);
					$this->db->update('dang_bai', $data_1);
				}
			}
		} else if($old_order_number > $new_order_number) {
			$this->db->where('order_number <', $old_order_number);
			$this->db->where('order_number >=', $new_order_number);
			$this->db->where('chuyen_de_id', $record[0]->chuyen_de_id);
			$records = $this->db->get('dang_bai')->result();
			if ($records) {
				foreach ($records as $dangbai) {
					$data_1['order_number'] = $dangbai->order_number + 1;
					$this->db->where('id', $dangbai->id);
					$this->db->update('dang_bai', $data_1);
				}
			}
		}
		
		$this->db->where('id', $id);
		$this->db->update('dang_bai', $data);
		
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
		$this->db->where('chuyen_de_id', $record[0]->chuyen_de_id);
		$records = $this->db->get('dang_bai')->result();
		if ($records) {
			foreach ($records as $dangbai) {
				$data['order_number'] = $dangbai->order_number - 1;
				$this->db->where('id', $dangbai->id);
				$this->db->update('dang_bai', $data);
			}
		}
		$this->db->where('id', $id);
		$this->db->delete('dang_bai');
	}
	
	function get_chuyen_de_options($chuong_id) {
		$rows = $this->db->select('id,name')
		->from('chuyen_de')
		->where('chuong_id', $chuong_id)
		->get()->result();
	
		$chuyen_de_options = array('0' => '');
		foreach ($rows as $row) {
			$chuyen_de_options[$row->id] = $row->name;
		}
	
		return $chuyen_de_options;
	}
	
	function search($subject_id,$class_id,$chuong_id, $chuyen_de_id,$limit, $offset, $sort_by, $sort_order) {
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id', 'order_number', 'name', 'chuyen_de_name', 'chuong_name','class_name','subject_name','description');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id';
		// results query
		$q = $this->db->select('dang_bai.id, dang_bai.order_number, dang_bai.name, chuyen_de.name chuyen_de_name, chuong.name chuong_name, class.name class_name, subject.name subject_name, dang_bai.description')
		->from('dang_bai')
		->join('chuyen_de','dang_bai.chuyen_de_id = chuyen_de.id','left')
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
		if($chuyen_de_id != 0){
			$q->where('chuyen_de.id',$chuyen_de_id);
		}
	
		$ret['rows'] = $q->get()->result();
	
		// count query
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('dang_bai')
		->join('chuyen_de','dang_bai.chuyen_de_id = chuyen_de.id','left')
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
		if($chuyen_de_id != 0){
			$q->where('chuyen_de.id',$chuyen_de_id);
		}
		$tmp = $q->get()->result();
	
		$ret['num_rows'] = $tmp[0]->count;
		
		return $ret;
	}
	
	function get_order_number_options($chuyen_de_id) {
	
		$rows = $this->db->select('order_number')
		->from('dang_bai')
		->where('chuyen_de_id', $chuyen_de_id)
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
	
		$dangbai = $this->get_record_by_id($id);
		$chuyen_de_id = $dangbai['0']->chuyen_de_id;
	
		$this->db->where('name', $name);
		$this->db->where('id !=', $id);
		$this->db->where('chuyen_de_id', $chuyen_de_id);
		$query = $this->db->get('dang_bai');
		return $query->result();
	}
	
	function get_record_by_name_chuyen_de_id($name, $chuyen_de_id) {
		$this->db->where('name', $name);
		$this->db->where('chuyen_de_id', $chuyen_de_id);
		$query = $this->db->get('dang_bai');
		return $query->result();
	}
}
