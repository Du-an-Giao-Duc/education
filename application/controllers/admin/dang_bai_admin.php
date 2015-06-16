<?php
class Dang_bai_admin extends CI_Controller {
	function index($chuyen_de_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0) {
		if($this->input->post('submit'))
		{
			$subject_id = $this->input->post('subject');
			$class_id = $this->input->post('class');
			$chuong_id = $this->input->post('chuong');
			$chuyen_de_id = $this->input->post('chuyen_de');
			$data = array(
				'subject_id' => $subject_id,
				'class_id' => $class_id,
				'chuong_id' => $chuong_id,
				'chuyen_de_id' => $chuyen_de_id
			);
			$this->session->set_userdata($data);
		}else{
			if($this->uri->segment(4))
			{
				$chuyen_de_id = $this->uri->segment(4);
				if(isset($this->session->userdata['chuyen_de_id'])) 
				{
					if($this->session->userdata['chuyen_de_id'] != $chuyen_de_id) 
					{
						$this->session->unset_userdata['subject_id'];
						$this->session->unset_userdata['class_id'];
						$this->session->unset_userdata['chuong_id'];
						$this->session->unset_userdata['chuyen_de_id'];
						$chuyen_de = $this->chuyen_de_model->get_record_by_id($chuyen_de_id);
						$chuong_id = $chuyen_de[0]->chuong_id;
						$chuong = $this->chuong_model->get_record_by_id($chuong_id);
						$class_id = $chuong[0]->class_id;
						$class = $this->class_model->get_record_by_id($class_id);
						$subject_id = $class[0]->subject_id;
						$subject = $this->subject_model->get_record_by_id($subject_id);
						$data = array(
								'subject_id' => $subject_id,
								'class_id' => $class_id,
								'chuong_id' => $chuong_id,
								'chuyen_de_id' => $chuyen_de_id
						);
						$this->session->set_userdata($data);
					} 
					else 
					{
						$subject_id = $this->session->userdata['subject_id'];
						$class_id = $this->session->userdata['class_id'];
						$chuong_id = $this->session->userdata['chuong_id'];
					}
				}
				else 
				{
					$chuyen_de = $this->chuyen_de_model->get_record_by_id($chuyen_de_id);
					$chuong_id = $chuyen_de[0]->chuong_id;
					$chuong = $this->chuong_model->get_record_by_id($chuong_id);
					$class_id = $chuong[0]->class_id;
					$class = $this->class_model->get_record_by_id($class_id);
					$subject_id = $class[0]->subject_id;
					if(isset($this->session->userdata['chuong_id'])) 
					{
						$this->session->unset_userdata['chuong_id'];
					}
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
							'chuong_id' => $chuong_id,
							'chuyen_de_id' => $chuyen_de_id
					);
					$this->session->set_userdata($data);
				}
			}
			else{
				if(isset($this->session->userdata['subject_id'])) 
				{
					$subject_id = $this->session->userdata['subject_id'];
				} 
				else{
					$subject_id = 0;
				}
				if(isset($this->session->userdata['class_id'])) 
				{
					$class_id = $this->session->userdata['class_id'];
				} else{
					$class_id = 0;
				}
				if(isset($this->session->userdata['chuong_id'])) 
				{
					$chuong_id = $this->session->userdata['chuong_id'];
				}else{
					$chuong_id = 0;
				}
				if(isset($this->session->userdata['chuyen_de_id'])) 
				{
					$chuong_id = $this->session->userdata['chuyen_de_id'];
				}
			}
		}
		
		$limit = 10;
		var_dump($subject_id, $class_id,$chuong_id,$chuyen_de_id, $limit, $offset, $sort_by, $sort_order);
		$results = $this->dang_bai_model->search($subject_id, $class_id,$chuong_id,$chuyen_de_id, $limit, $offset, $sort_by, $sort_order);
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/dang_bai_admin/index/$chuyen_de_id/$sort_by/$sort_order");
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
		$data['chuyen_de_options'] = $this->dang_bai_model->get_chuyen_de_options($chuong_id);
		$data['chuyen_de_id'] = $chuyen_de_id;
		$content = $this->load->view('admin/dang_bai_view/dang_bai_list', $data, TRUE);
		$data = array();
		$data['title'] = "Dang bai";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
}