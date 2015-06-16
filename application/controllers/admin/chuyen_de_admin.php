<?php
class Chuyen_de_admin extends CI_Controller{
	function index($chuong_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0){
		if($this->input->post('submit'))
		{
			$subject_id = $this->input->post('subject');
			$class_id = $this->input->post('class');
			$chuong_id = $this->input->post('chuong');
			$data = array(
				'subject_id' => $subject_id,
				'class_id' => $class_id,
				'chuong_id' => $chuong_id
			);
			$this->session->set_userdata($data);
		}
		else {
			if($this->uri->segment(4))
			{
				$chuong_id = $this->uri->segment(4);
				if(isset($this->session->userdata['chuong_id'])) 
				{
					if($this->session->userdata['chuong_id'] != $chuong_id) 
					{
						$this->session->unset_userdata['subject_id'];
						$this->session->unset_userdata['class_id'];
						$this->session->unset_userdata['chuong_id'];
						$chuong = $this->class_model->get_record_by_id($chuong_id);
						$class_id = $chuong[0]->class_id;
						$class = $this->class_model->get_record_by_id($class_id);
						$subject_id = $class[0]->subject_id;
						$data = array(
								'subject_id' => $subject_id,
								'class_id' => $class_id,
								'chuong_id' => $chuong_id
						);
						$this->session->set_userdata($data);
					} 
					else 
					{
						$subject_id = $this->session->userdata['subject_id'];
						$class_id = $this->session->userdata['class_id'];
					}
				}
				else 
				{
					$chuong = $this->chuong_model->get_record_by_id($chuong_id);
					$class_id = $chuong[0]->class_id;
					$class = $this->class_model->get_record_by_id($class_id);
					$subject_id = $class[0]->subject_id;
					if(isset($this->session->userdata['class_id'])) 
					{
						$this->session->unset_userdata['class_id'];
					}
					if(isset($this->session->userdata['subject_id'])) 
					{
						$this->session->unset_userdata['subject_id'];
					}
					$data = array(
							'subject_id' => $subject_id,
							'class_id' => $class_id,
							'chuong_id' => $chuong_id
					);
					$this->session->set_userdata($data);
				}
			}
			else 
			{
				if(isset($this->session->userdata['subject_id'])) 
				{
					$subject_id = $this->session->userdata['subject_id'];
				} 
				else 
				{
					$subject_id = 0;
				}
				if(isset($this->session->userdata['class_id'])) 
				{
					$class_id = $this->session->userdata['class_id'];
				} else 
				{
					$class_id = 0;
				}
				if(isset($this->session->userdata['chuong_id'])) 
				{
					$chuong_id = $this->session->userdata['chuong_id'];
				}
			}
		}
		$limit = 10;
		$results = $this->chuyen_de_model->search($subject_id, $class_id,$chuong_id, $limit, $offset, $sort_by, $sort_order);
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/chuyen_de_admin/index/$chuong_id/$sort_by/$sort_order");
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
		$data['chuong_options'] = $this->chuyen_de_model->get_chuong_options($class_id);
		$data['chuong_id'] = $chuong_id;
		$content = $this->load->view('admin/chuyende_view/chuyende_list', $data, TRUE);
		$data = array();
		$data['title'] = "Chuyen de";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	function add()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name','Name','trim|required|is_unique[chuyende_name]');
			$this->form_validation->set_rules('description','Description','trim|required');
			if($this->form_validation->run() == FALSE)
			{
				//
			}
			else 
			{
				$chuong_id = $this->session->userdata['chuong_id'];
				$data = array(
					'chuong_id'    => $chuong_id,
					'order_number' => $this->input->post('order_number'),
					'name'         => $this->input->post('name'),		
					'description'  => $this->input->post('description')
				);
				var_dump($data);
				$id = $this->chuyen_de_model->add_record($data);
				$data = array();
				if($id) 
				{
					$query = $this->chuyen_de_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/chuyen_de_view/chuyende_confirm',$data);
			}
		}
		else 
		{
// 			$chuong = $this->chuong_model->get_record_by_id($this->session->userdata['chuong_id']);
// 			$chuong_name = $chuong[0]->name;
// 			$data['chuong_name'] = $chuong_name;
			$this->load->view('admin/chuyende_view/chuyende_add_form');
				
		}
	}
	function update($id=0)
	{
		if($this->input->post('submit'))
		{
			
			$id= $this->input->post('id');
			$this->load->library('form_validation');
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_check_class_name');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			$query = $this->chuyen_de_model->get_record_by_id($id);
			$chuong_id = $query[0]->chuong_id;
			if($this->form_validation->run() == FALSE)
			{
				$data = array(
						'chuong_id'    => $chuong_id,
						'order_number' => $this->input->post('order_number'),
						'name'         => $this->input->post('name'),
						'description'  => $this->input->post('description')
				);		
			$return_true = $this->chuyen_de_model->update_record_by_id($id,$data);
			$data = array();
				if($return_true)
				{
					$query = $this->chuyen_de_model->get_record_by_id($id);
					$data['record'] = $query;
				}
			$this->load->view('admin/chuyende_view/chuyende_confirm',$data);
			//
			}
			else 
			{
				$data = array(
						'chuong_id'    => $chuong_id,
						'order_number' => $this->input->post('order_number'),
						'name'         => $this->input->post('name'),
						'description'  => $this->input->post('description')
				);		
			$return_true = $this->chuyen_de_model->update_record_by_id($id,$data);
			$data = array();
				if($return_true)
				{
					$query = $this->chuyen_de_model->get_record_by_id($id);
					$data['record'] = $query;
				}
			$this->load->view('admin/chuyende_view/chuyende_confirm',$data);
			}
		}
		else 
		{
			$data = array();
			if($query = $this->chuyen_de_model->get_record_by_id($id));
			{
				$data['record'] = $query;
				$chuong = $this->chuong_model->get_record_by_id($query[0]->chuong_id);
				$chuong_name = $chuong[0]->name;
				$data['chuong_name'] = $chuong_name;
			}
			$this->load->view('admin/chuyende_view/chuyende_update_form', $data);
		}
		
	}
	function check_chuyende_name($name)
	{
		$id = $this->input->post('id');
		if ($this->chuyende_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_class_name', 'The class name already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function delete($id) 
	{
		$return_true = $this->chuyen_de_model->delete_record_by_id($id);
		redirect("admin/chuyen_de_admin");
	}
}