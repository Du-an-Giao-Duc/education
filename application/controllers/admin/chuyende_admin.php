<?php
class Chuyende_admin extends CI_Controller{
	function index($chuong_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0){
		if($this->input->post('submit')){
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
			if($this->uri->segment(4)){
				$chuong_id = $this->uri->segment(4);
				if(isset($this->session->userdata['chuong_id'])) {
					if($this->session->userdata['chuong_id'] != $chuong_id) {
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
					else {
						$subject_id = $this->session->userdata['subject_id'];
						$class_id = $this->session->userdata['class_id'];
					}
				}
				else {
					$chuong = $this->chuong_model->get_record_by_id($chuong_id);
					$class_id = $chuong[0]->class_id;
					$class = $this->class_model->get_record_by_id($class_id);
					$subject_id = $class[0]->subject_id;
					if(isset($this->session->userdata['class_id'])) {
						$this->session->unset_userdata['class_id'];
					}
					if(isset($this->session->userdata['subject_id'])) {
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
			else {
				if(isset($this->session->userdata['subject_id'])) {
					$subject_id = $this->session->userdata['subject_id'];
				} else {
					$subject_id = 0;
				}
				if(isset($this->session->userdata['class_id'])) {
					$class_id = $this->session->userdata['class_id'];
				} else {
					$class_id = 0;
				}
				if(isset($this->session->userdata['chuong_id'])) {
					$chuong_id = $this->session->userdata['chuong_id'];
				}
			}
		}
		$limit = 10;
		
		$results = $this->chuyende_model->search($subject_id, $class_id,$chuong_id, $limit, $offset, $sort_by, $sort_order);
		
		$data['records'] = $results['rows'];
		$data['num_records'] = $results['num_rows'];
		
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = site_url("admin/chuyende_admin/index/$chuong_id/$sort_by/$sort_order");
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
		$content = $this->load->view('admin/chuyende_view/chuyende_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Chuyen de";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	
}