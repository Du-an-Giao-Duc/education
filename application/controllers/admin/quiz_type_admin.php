<?php
class Quiz_type_admin extends CI_Controller {
function index() {
		$data = array();
		if($query = $this->quiz_type_model->get_all_records())
		{
			$data['records'] = $query;
		}
		$content = $this->load->view('admin/quiz_type_view/quiz_type_list', $data, TRUE);
		
		$data = array();
		$data['title'] = "Loại câu hỏi";
		$data['leftmenu'] = $this->config->item('left_menu');
		$data['content'] = $content;
		$this->load->view('template', $data);
	}
	
	function add() {
		
		if($this->input->post('submit'))
		{
			$this->form_validation->set_rules('name', 'Loại câu hỏi', 'trim|required|is_unique[quiz_type.name]');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if($this->form_validation->run() == false) {
				$this->load->view('admin/quiz_type_view/quiz_type_add_form');
			} else {
			
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$id = $this->quiz_type_model->add_record($data);
				
				$data = array();
				if($id) {
					$query = $this->quiz_type_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/quiz_type_view/quiz_type_confirm',$data);
			}
		}
		else
		{
			$this->load->view('admin/quiz_type_view/quiz_type_add_form');
		}
	}
	
	function update($id=0) {
		if($this->input->post('submit'))
		{
			$id = $this->input->post('id');
			
			$this->form_validation->set_rules('name', 'Loại câu hỏi', 'trim|required|callback_check_quiz_type_name');
			$this->form_validation->set_rules('description', 'Mô Tả', 'trim|required');
			
			if ($this->form_validation->run() == false) {
				$data = array();
				if($query = $this->quiz_type_model->get_record_by_id($id))
				{
					$data['record'] = $query;
				}
				$this->load->view('admin/quiz_type_view/quiz_type_update_form', $data);
			} else {
				
				$data = array(
						'name' => $this->input->post('name'),
						'description' => $this->input->post('description')
				);
				
				$return_true = $this->quiz_type_model->update_record_by_id($id, $data);
				
				$data = array();
				if($return_true) {
					$query = $this->quiz_type_model->get_record_by_id($id);
					$data['record'] = $query;
				}
				$this->load->view('admin/quiz_type_view/quiz_type_confirm', $data);
			}
		}
		else
		{
			$data = array();
			if($query = $this->quiz_type_model->get_record_by_id($id))
			{
				$data['record'] = $query;
			}
			$this->load->view('admin/quiz_type_view/quiz_type_update_form', $data);
		}
	}
	
	function check_quiz_type_name($name) {
		$id = $this->input->post('id');
		if ($this->quiz_type_model->get_record_by_name_id($name, $id))
		{
			$this->form_validation->set_message('check_quiz_type_name', 'Trường/Đại học này đã tồn tại');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function delete($id) {
		$return_true = $this->quiz_type_model->delete_record_by_id($id);
		redirect("admin/quiz_type_admin");
	}
}