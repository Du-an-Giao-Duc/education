<?php
class Dang_bai_admin extends CI_Controller {
function index($chuyen_de_id = 0, $sort_by = 'id', $sort_order = 'asc', $offset = 0){
		if($this->input->post('submit')){
			$subject_id = $this->input->post('subject');
			$class_id = $this->input->post('class');
			$chuong_id = $this->input->post('chuong');
			$chuyen_de_id = $this->input->post('chuyen_de');
			if(!isset($this->session->userdata['chuyen_de_id']) || $this->session->userdata['chuyen_de_id']!=$chuyen_de_id) {
				$this->session->unset_userdata('subject_id');
				$this->session->unset_userdata('class_id');
				$this->session->unset_userdata('chuong_id');
				$this->session->unset_userdata('chuyen_de_id');
				$data = array(
					'subject_id' 	=> $subject_id,
					'class_id' 		=> $class_id,
					'chuong_id' 	=> $chuong_id,
					'chuyen_de_id' 	=> $chuyen_de_id
				);
				$this->session->set_userdata($data);
			}
		} else {
			if($this->uri->segment(4)){
				$chuyen_de_id = $this->uri->segment(4);
				if(isset($this->session->userdata['chuyen_de_id'])) {
					if($this->session->userdata['chuyen_de_id'] != $chuyen_de_id) {
						$this->session->unset_userdata('subject_id');
						$this->session->unset_userdata('class_id');
						$this->session->unset_userdata('chuong_id');
						$this->session->unset_userdata('chuyen_de_id');
						
						$chuyende = $this->chuyen_de_model->get_record_by_id($chuyen_de_id);
						$chuong_id = $chuyende[0]->chuong_id;
						$chuong = $this->chuong_model->get_record_by_id($chuong_id);
						$class_id = $chuong[0]->class_id;
						$class = $this->class_model->get_record_by_id($class_id);
						$subject_id = $class[0]->subject_id;
						$data = array(
								'subject_id' => $subject_id,
								'class_id' => $class_id,
								'chuong_id' => $chuong_id,
								'chuyen_de_id' => $chuyen_de_id
						);
						$this->session->set_userdata($data);
					} 
					else {
						$subject_id = $this->session->userdata['subject_id'];
						$class_id = $this->session->userdata['class_id'];
						$chuong_id = $this->session->userdata['chuong_id'];
					}
				} else {
					$chuyende = $this->chuyen_de_model->get_record_by_id($chuyen_de_id);
					$chuong_id = $chuyende[0]->chuong_id;
					$chuong = $this->chuong_model->get_record_by_id($chuong_id);
					$class_id = $chuong[0]->class_id;
					$class = $this->class_model->get_record_by_id($class_id);
					$subject_id = $class[0]->subject_id;
					
					$data = array(
							'subject_id' => $subject_id,
							'class_id' => $class_id,
							'chuong_id' => $chuong_id,
							'chuyen_de_id' => $chuyen_de_id
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
				} else {
					$chuong_id = 0;
				}
				if(isset($this->session->userdata['chuyen_de_id'])) {
					$chuyen_de_id = $this->session->userdata['chuyen_de_id'];
				}
			}
		}
		$limit = 10;
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
		
		$content = $this->load->view('admin/dangbai_view/dangbai_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Dạng Bài";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add()
	{
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name','Tên Dạng Bài','trim|required|callback_check_dang_bai_name_for_add');
			$this->form_validation->set_rules('description','Mô Tả','trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$chuyende = $this->chuyen_de_model->get_record_by_id($this->session->userdata['chuyen_de_id']);
				$chuyende_name = $chuyende[0]->name;
				$data['chuyen_de_name'] = $chuyende_name;
				$order_number_options = $this->dang_bai_model->get_order_number_options($this->session->userdata['chuyen_de_id']);
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
				$this->load->view('admin/dangbai_view/dangbai_add_form', $data);
			}
			else 
			{
				$chuyen_de_id = $this->session->userdata['chuyen_de_id'];
				$data = array(
					'chuyen_de_id'    => $chuyen_de_id,
					'order_number' => $this->input->post('order_number'),
					'name'         => $this->input->post('name'),		
					'description'  => $this->input->post('description')
				);
				$id = $this->dang_bai_model->add_record($data);
				
				$data = array();
				if($id) 
				{
					$query = $this->dang_bai_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/dangbai_view/dangbai_confirm',$data);
			}
		}
		else 
		{
				$chuyende = $this->chuyen_de_model->get_record_by_id($this->session->userdata['chuyen_de_id']);
				$chuyende_name = $chuyende[0]->name;
				$data['chuyen_de_name'] = $chuyende_name;
				$order_number_options = $this->dang_bai_model->get_order_number_options($this->session->userdata['chuyen_de_id']);
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
				$this->load->view('admin/dangbai_view/dangbai_add_form', $data);
				
		}
	}
	function update($id=0)
	{
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->load->library('form_validation');
			
			// field name, error message, validation rules
			$this->form_validation->set_rules('name', 'Tên Dạng Bài', 'trim|required|callback_check_dangbai_name');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if($this->form_validation->run() == FALSE)
			{
				$data = array();
				if($query = $this->dang_bai_model->get_record_by_id($id))
				{
					$data['record'] = $query;
					$chuyende = $this->chuyen_de_model->get_record_by_id($query[0]->chuyen_de_id);
					$chuyende_name = $chuyende[0]->name;
					$data['chuyen_de_name'] = $chuyende_name;
					
					$order_number_options = $this->dang_bai_model->get_order_number_options($query[0]->chuyen_de_id);
					$data['order_number_options'] = $order_number_options;
					
				}
				$this->load->view('admin/dangbai_view/dangbai_update_form', $data);
				
			} else {
			
				$data = array(
						'order_number' => $this->input->post('order_number'),
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
					
				$return_true = $this->dang_bai_model->update_record_by_id($id, $data);
					
				$data = array();
				if($return_true) {
					$query = $this->dang_bai_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/dangbai_view/dangbai_confirm', $data);
			}
		}
		else
		{
				$data = array();
				if($query = $this->dang_bai_model->get_record_by_id($id))
				{
					$data['record'] = $query;
					$chuyende = $this->chuyen_de_model->get_record_by_id($query[0]->chuyen_de_id);
					$chuyende_name = $chuyende[0]->name;
					$data['chuyen_de_name'] = $chuyende_name;
					
					$order_number_options = $this->dang_bai_model->get_order_number_options($query[0]->chuyen_de_id);
					$data['order_number_options'] = $order_number_options;
					
				}
				$this->load->view('admin/dangbai_view/dangbai_update_form', $data);
		}
		
	}
	function check_dangbai_name($name)
	{
		$id = $this->input->post('id');
		if ($this->dang_bai_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_dangbai_name', 'Dạng bài này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function check_dang_bai_name_for_add($name) {
		$chuyen_de_id = $this->session->userdata['chuyen_de_id'];
		if ($this->dang_bai_model->get_record_by_name_chuyen_de_id($name, $chuyen_de_id))
		{
			$this->form_validation->set_message('check_dang_bai_name_for_add', 'Dạng bài này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	function delete($id) 
	{
		$return_true = $this->dang_bai_model->delete_record_by_id($id);
		redirect("admin/dang_bai_admin");
	}
}