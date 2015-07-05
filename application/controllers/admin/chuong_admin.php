<?php
class Chuong_admin extends CI_Controller {
function index($class_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0) {
		if ($this->input->post('submit')) { // If user clicks submit in search function
			$subject_id = $this->input->post('subject');
			$class_id = $this->input->post('class');
			if(!isset($this->session->userdata['class_id']) || $this->session->userdata['class_id']!= $class_id){
				$this->session->unset_userdata('subject_id');
				$this->session->unset_userdata('class_id');
				$this->session->unset_userdata('chuong_id');
				$this->session->unset_userdata('chuyen_de_id');
				$data = array(
						'subject_id' => $subject_id,
						'class_id' => $class_id
				);
				$this->session->set_userdata($data);
			}
		} else {
			if($this->uri->segment(4)) {
				$class_id = $this->uri->segment(4);
				if(isset($this->session->userdata['class_id'])) {
					if($this->session->userdata['class_id'] != $class_id) {
						$this->session->unset_userdata('subject_id');
						$this->session->unset_userdata('class_id');
						$this->session->unset_userdata('chuong_id');
						$this->session->unset_userdata('chuyen_de_id');
						$class = $this->class_model->get_record_by_id($class_id);
						$subject_id = $class[0]->subject_id;
						$data = array(
								'subject_id' => $subject_id,
								'class_id' => $class_id
						);
						$this->session->set_userdata($data);
					} else {
						$subject_id = $this->session->userdata['subject_id'];
					}
				} else {
					$class = $this->class_model->get_record_by_id($class_id);
					$subject_id = $class[0]->subject_id;
					if(isset($this->session->userdata['subject_id'])) {
						$this->session->unset_userdata('subject_id');
					}
					$data = array(
								'subject_id' => $subject_id,
								'class_id' => $class_id
						);
					$this->session->set_userdata($data);
				}
			} else {
				if(isset($this->session->userdata['subject_id'])) {
					$subject_id = $this->session->userdata['subject_id'];
				} else {
					$subject_id = 0;
				}
				if(isset($this->session->userdata['class_id'])) {
					$class_id = $this->session->userdata['class_id'];
				}
			}
		}

		$limit = 10;
		
		$results = $this->chuong_model->search($subject_id, $class_id, $limit, $offset, $sort_by, $sort_order);
		
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/chuong_admin/index/$class_id/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_records'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['subject_options'] = $this->class_model->get_subject_options();
		$data['subject_id'] = $subject_id;
		
		$data['class_options'] = $this->chuong_model->get_class_options($subject_id);
		$data['class_id'] = $class_id;
		
		$content = $this->load->view('admin/chuong_view/chuong_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Chương";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
	
		if($this->input->post('submit'))
		{
				
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Tên Chương', 'trim|required|callback_check_chuong_name_for_add');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$class = $this->class_model->get_record_by_id($this->session->userdata['class_id']);
				$class_name = $class[0]->name;
				$data['class_name'] = $class_name;
				$order_number_options = $this->chuong_model->get_order_number_options($this->session->userdata['class_id']);
				$size = sizeof($order_number_options);
				if($size == 0) {
					$order_number_options['1'] = '1';
					$size = 1;
				} else {
					$order_number_options[$size + 1] = $size + 1;
					$size = $size + 1;
				}
				$data['order_number_options'] = $order_number_options;
				$data['order_number'] = $size;
				$this->load->view('admin/chuong_view/chuong_add_form', $data);
			} else {
				$class_id = $this->session->userdata['class_id'];
				$data = array(
						'class_id' => $class_id,
						'order_number' => $this->input->post('order_number'),
						'semester' => $this->input->post('semester'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
					
				$id = $this->chuong_model->add_record($data);
					
				$data = array();
				if($id) {
					$query = $this->chuong_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/chuong_view/chuong_confirm',$data);
			}
		}
		else
		{
				$class = $this->class_model->get_record_by_id($this->session->userdata['class_id']);
				$class_name = $class[0]->name;
				$data['class_name'] = $class_name;
				$order_number_options = $this->chuong_model->get_order_number_options($this->session->userdata['class_id']);
				$size = sizeof($order_number_options);
				if($size == 0) {
					$order_number_options['1'] = '1';
					$size = 1;
				} else {
					$order_number_options[$size + 1] = $size + 1;
					$size = $size + 1;
				}
				$data['order_number_options'] = $order_number_options;
				$data['order_number'] = $size;
				$this->load->view('admin/chuong_view/chuong_add_form', $data);
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Tên Chương', 'trim|required|callback_check_chuong_name');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$data = array();
				if($query = $this->chuong_model->get_record_by_id($id))
				{
					$data['record'] = $query;
					$class = $this->class_model->get_record_by_id($query[0]->class_id);
					$class_name = $class[0]->name;
					$data['class_name'] = $class_name;
					
					$order_number_options = $this->chuong_model->get_order_number_options($query[0]->class_id);
					$data['order_number_options'] = $order_number_options;
					
				}
				$this->load->view('admin/chuong_view/chuong_update_form', $data);
				
			} else {
			
				$data = array(
						'order_number' => $this->input->post('order_number'),
						'semester' => $this->input->post('semester'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
					
				$return_true = $this->chuong_model->update_record_by_id($id, $data);
					
				$data = array();
				if($return_true) {
					$query = $this->chuong_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/chuong_view/chuong_confirm', $data);
			}
		}
		else
		{
			$data = array();
			if($query = $this->chuong_model->get_record_by_id($id))
			{
				$data['record'] = $query;
				$class = $this->class_model->get_record_by_id($query[0]->class_id);
				$class_name = $class[0]->name;
				$data['class_name'] = $class_name;
				$order_number_options = $this->chuong_model->get_order_number_options($query[0]->class_id);
				$data['order_number_options'] = $order_number_options;
				
			}
			$this->load->view('admin/chuong_view/chuong_update_form', $data);
		}
	}
	
	function delete($id) {
		$return_true = $this->chuong_model->delete_record_by_id($id);
		redirect("admin/chuong_admin");
	}
	
	function check_chuong_name($name) {
		$id = $this->input->post('id');
		if ($this->chuong_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_chuong_name', 'Chương này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_chuong_name_for_add($name) {
		$class_id = $this->session->userdata['class_id'];
		if ($this->chuong_model->get_record_by_name_class_id($name, $class_id))
		{
			$this->form_validation->set_message('check_chuong_name_for_add', 'Chương này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}