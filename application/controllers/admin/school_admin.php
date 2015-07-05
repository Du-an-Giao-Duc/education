<?php
class School_admin extends CI_Controller {
function index() {
		$data = array();
		if($query = $this->school_model->get_all_records())
		{
			$data['records'] = $query;
		}
		$content = $this->load->view('admin/school_view/school_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Trường/Đại học";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
		
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name', 'Tên Trường/Đại học', 'trim|required|is_unique[school.name]');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if($this->form_validation->run() == false) {
				$this->load->view('admin/school_view/school_add_form');
			} else {
			
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$id = $this->school_model->add_record($data);
				
				$data = array();
				if($id) {
					$query = $this->school_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/school_view/school_confirm',$data);
			}
		}
		else
		{
			$this->load->view('admin/school_view/school_add_form');
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->form_validation->set_rules('name', 'Tên Trường/Đại học', 'trim|required|callback_check_school_name');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if ($this->form_validation->run() == false) {
				$data = array();
				if($query = $this->school_model->get_record_by_id($id))
				{
					$data['record'] = $query;
				}
				$this->load->view('admin/school_view/school_update_form', $data);
			} else {
				
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$return_true = $this->school_model->update_record_by_id($id, $data);
				
				$data = array();
				if($return_true) {
					$query = $this->school_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/school_view/school_confirm', $data);
			}
		}
		else
		{
			$data = array();
			if($query = $this->school_model->get_record_by_id($id))
			{
				$data['record'] = $query;
			}
			$this->load->view('admin/school_view/school_update_form', $data);
		}
	}
	
	function check_school_name($name) {
		$id = $this->input->post('id');
		if ($this->school_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_school_name', 'Trường/Đại học này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function delete($id) {
		$return_true = $this->school_model->delete_record_by_id($id);
		redirect("admin/school_admin");
	}
}