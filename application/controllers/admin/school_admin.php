<?php
class School_admin extends CI_Controller {
	function index($school_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0) {
		if ($this->input->post('submit')) {
			$school_id = $this->input->post('school');
			$data = array(
					'school_id' => $school_id
			);
			$this->session->set_userdata($data);
		} else {
			if($this->uri->segment(4)) {
				$school_id = $this->uri->segment(4);
				if(isset($this->session->userdata['school_id'])) {
					if($this->session->userdata['school_id'] != $school_id) {
						$this->session->unset_userdata['school_id'];
						$data = array(
								'school_id' => $school_id
						);
						$this->session->set_userdata($data);
					}
				} else {
					$data = array(
								'school_id' => $school_id
						);
					$this->session->set_userdata($data);
				}
			} else {
				if(isset($this->session->userdata['school_id'])) {
					$school_id = $this->session->userdata['school_id'];
				}
			}
		}

		$limit = 10;
		
		$this->load->model('class_model');
		
		$results = $this->class_model->search($school_id, $limit, $offset, $sort_by, $sort_order);
		
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		// pagination
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/class_admin/index/$school_id/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_records'];
		$config['per_page'] = $limit;
		$config['uri_segment'] = 7;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['school_options'] = $this->class_model->get_school_options();
		$data['school_id'] = $school_id;
		
		$content = $this->load->view('admin/class_view/class_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Class";
		$data['leftmenu'] = array(
				'News'    => 'admin/news_admin',
				'Subject' => 'admin/subject_admin',
				'Class'   => 'admin/class_admin',
				'Chuong'  => 'admin/chuong_admin',
				'Chuyen De' => 'admin/chuyen_de_admin',
				'Dang Bai' => 'admin/dang_bai_admin',
				'Question Type' => 'admin/question_type_admin',
				'School/University' => 'admin/school_admin'
		);
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
	
		if($this->input->post('submit'))
		{
				
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[class.name]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$school = $this->school_model->get_record_by_id($this->session->userdata['school_id']);
				$school_name = $school[0]->name;
				$data['school_name'] = $school_name;
				$this->load->view('admin/class_view/class_add_form', $data);
			} else {
				$school_id = $this->session->userdata['school_id'];
				$data = array(
						'school_id' => $school_id,
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
			$school = $this->school_model->get_record_by_id($this->session->userdata['school_id']);
			$school_name = $school[0]->name;
			$data['school_name'] = $school_name;
			$this->load->view('admin/class_view/class_add_form', $data);
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_check_class_name');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$data = array();
				if($query = $this->class_model->get_record_by_id($id))
				{
					$data['record'] = $query;
					$school = $this->school_model->get_record_by_id($query[0]->school_id);
					$school_name = $school[0]->name;
					$data['school_name'] = $school_name;
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
				$school = $this->school_model->get_record_by_id($query[0]->school_id);
				$school_name = $school[0]->name;
				$data['school_name'] = $school_name;
			}
			$this->load->view('admin/class_view/class_update_form', $data);
		}
	}
	
	
	function check_class_name($name) {
		$id = $this->input->post('id');
		if ($this->class_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_class_name', 'The class name already exists.');
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