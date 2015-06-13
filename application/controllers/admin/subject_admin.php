<?php
class Subject_admin extends CI_Controller {
	
	function index() {
		
		$data = array();
		if($query = $this->subject_model->get_all_records())
		{
			$data['records'] = $query;
		}
		$content = $this->load->view('admin/subject_view/subject_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Subject";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
		
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required|is_unique[subject.name]');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			
			if($this->form_validation->run() == false) {
				$this->load->view('admin/subject_view/subject_add_form');
			} else {
			
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$id = $this->subject_model->add_record($data);
				
				$data = array();
				if($id) {
					$query = $this->subject_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/subject_view/subject_confirm',$data);
			}
		}
		else
		{
			$this->load->view('admin/subject_view/subject_add_form');
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required|callback_check_subject_name');
			$this->form_validation->set_rules('description', 'Description', 'trim|required');
			
			if ($this->form_validation->run() == false) {
				$data = array();
				if($query = $this->subject_model->get_record_by_id($id))
				{
					$data['record'] = $query;
				}
				$this->load->view('admin/subject_view/subject_update_form', $data);
			} else {
				
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$return_true = $this->subject_model->update_record_by_id($id, $data);
				
				$data = array();
				if($return_true) {
					$query = $this->subject_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/subject_view/subject_confirm', $data);
			}
		}
		else
		{
			$data = array();
			if($query = $this->subject_model->get_record_by_id($id))
			{
				$data['record'] = $query;
			}
			$this->load->view('admin/subject_view/subject_update_form', $data);
		}
	}
	
	function check_subject_name($name) {
		$id = $this->input->post('id');
		if ($this->subject_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_subject_name', 'The subject name already exists.');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function delete($id) {
		$return_true = $this->subject_model->delete_record_by_id($id);
		redirect("admin/subject_admin");
	}
}