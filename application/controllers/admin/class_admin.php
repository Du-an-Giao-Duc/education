<?php
class Class_admin extends CI_Controller {
	function index($subject_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0) {
		if ($this->input->post('submit')) {
			$subject_id = $this->input->post('subject');
			if(!isset($this->session->userdata['subject_id']) || $this->session->userdata['subject_id'] != $subject_id) {
				$data = array(
						'subject_id' => $subject_id
				);
				$this->session->set_userdata($data);
				$this->session->unset_userdata('class_id');
				$this->session->unset_userdata('chuong_id');
				$this->session->unset_userdata('chuyen_de_id');
			}
		} else {
			if($this->uri->segment(4)) {
				$subject_id = $this->uri->segment(4);
				if(isset($this->session->userdata['subject_id'])) {
					if($this->session->userdata['subject_id'] != $subject_id) {
						$this->session->unset_userdata('subject_id');
						$this->session->unset_userdata('class_id');
						$this->session->unset_userdata('chuong_id');
						$this->session->unset_userdata('chuyen_de_id');
						$data = array(
								'subject_id' => $subject_id
						);
						$this->session->set_userdata($data);
					}
				} else {
					$data = array(
								'subject_id' => $subject_id
						);
					$this->session->set_userdata($data);
				}
			} else {
				if(isset($this->session->userdata['subject_id'])) {
					$subject_id = $this->session->userdata['subject_id'];
				}
			}
		}

		$limit = 10;
		
		$this->load->model('class_model');
		
		$results = $this->class_model->search($subject_id, $limit, $offset, $sort_by, $sort_order);
		
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/class_admin/index/$subject_id/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_records'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['subject_options'] = $this->class_model->get_subject_options();
		$data['subject_id'] = $subject_id;
		
		$content = $this->load->view('admin/class_view/class_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Lớp Học";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
	
		if($this->input->post('submit'))
		{
				
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Tên Lớp Học', 'trim|required|callback_check_class_name_for_add');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$subject = $this->subject_model->get_record_by_id($this->session->userdata['subject_id']);
				$subject_name = $subject[0]->name;
				$data['subject_name'] = $subject_name;
				$this->load->view('admin/class_view/class_add_form', $data);
			} else {
				$subject_id = $this->session->userdata['subject_id'];
				$data = array(
						'subject_id' => $subject_id,
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
					
				$id = $this->class_model->add_record($data);
					
				$data = array();
				if($id) {
					$query = $this->class_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/class_view/class_confirm',$data);
			}
		}
		else
		{
			$subject = $this->subject_model->get_record_by_id($this->session->userdata['subject_id']);
			$subject_name = $subject[0]->name;
			$data['subject_name'] = $subject_name;
			$this->load->view('admin/class_view/class_add_form', $data);
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Tên Lớp Học', 'trim|required|callback_check_class_name');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$data = array();
				if($query = $this->class_model->get_record_by_id($id))
				{
					$data['record'] = $query;
					$subject = $this->subject_model->get_record_by_id($query[0]->subject_id);
					$subject_name = $subject[0]->name;
					$data['subject_name'] = $subject_name;
				}
				$this->load->view('admin/class_view/class_update_form', $data);
				
			} else {
			
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
					
				$return_true = $this->class_model->update_record_by_id($id, $data);
					
				$data = array();
				if($return_true) {
					$query = $this->class_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/class_view/class_confirm', $data);
			}
		}
		else
		{
			$data = array();
			if($query = $this->class_model->get_record_by_id($id))
			{
				$data['record'] = $query;
				$subject = $this->subject_model->get_record_by_id($query[0]->subject_id);
				$subject_name = $subject[0]->name;
				$data['subject_name'] = $subject_name;
			}
			$this->load->view('admin/class_view/class_update_form', $data);
		}
	}
	
	
	function check_class_name($name) {
		$id = $this->input->post('id');
		if ($this->class_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_class_name', 'Lớp học này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_class_name_for_add($name) {
		$subject_id = $this->session->userdata['subject_id'];
		if ($this->class_model->get_record_by_name_subject_id($name, $subject_id))
		{
			$this->form_validation->set_message('check_class_name_for_add', 'Lớp học này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function delete($id) {
		$return_true = $this->class_model->delete_record_by_id($id);
		redirect("admin/class_admin");
	}
}