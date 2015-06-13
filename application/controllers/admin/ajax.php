<?php
class Ajax extends CI_Controller {
	function get_class_options() {
		$subject_id = $this->input->post('subject_id');
		
		$class_options = $this->chuong_model->get_class_options($subject_id);
		echo form_label('Class:', 'class'); 
		echo form_dropdown('class', $class_options, 
		set_value('class', 0), 'id="class"'); 
	}
}