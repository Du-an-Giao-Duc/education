<?php
class Ajax extends CI_Controller {
	function get_class_options() {
		$subject_id = $this->input->post('subject_id');
		
		$class_options = $this->chuong_model->get_class_options($subject_id);
		echo form_label('Class:', 'class'); 
		echo form_dropdown('class', $class_options, 
		set_value('class', 0), 'id="class"'); 
	}
	
	function get_classes() {
		$subject_id = $this->input->post('subject_id');
		$classes = $this->class_model->get_record_by_subject_id($subject_id);
		echo form_label('Classes:', 'classes');
		foreach ($classes as $class) {
			echo "<li>";
			echo form_label($class->name, 'class_name');
			echo form_checkbox('role_code[]', set_value('role_code', $class->id), false, 'id="role_code"');
			echo "</li>";
		}
	}
}