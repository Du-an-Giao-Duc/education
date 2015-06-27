<?php
class Question extends CI_Controller {
	function add() {
              if($this->input->post('submitButton')) {
                     $content = $this->input->post('editor_noi_dung');
                     $solution = $this->input->post('editor_loi_giai');
                     $status = $this->input->post('status');
                     $post_user = $this->session->userdata['username'];
                    
                     $data = array(
                                  'content'            => $content,
                                  'solution'           => $solution,
                                  'status'             => $status,
                                  'post_user'          => $post_user
                     );
                     $right_answers = $this->input->post('chb_dap_an_dung[]');
                     $question_id = $this->question_model->add_record($data);
                     if($question_id) {
                           $number_of_answers = $this->input->post('so_dap_an');
                           for ($i = 1; $i <= $number_of_answers; $i++) {
                                  $data = array();
                                  $data['question_id'] = $question_id;
                                  $data['content'] = $this->input->post('txt_dap_an_' . $i);
                                  $data['is_true'] = 0;
                                  if($right_answers) {
                                  	foreach ($right_answers as $right_answer) {
                                  		if($right_answer == $i) {
                                  			$data['is_true'] = 1;
                                  			break;
                                  		}
                                  	}
                                  }
                                  
                                  $this->answer_model->add_record($data);
                           }
                     }
              }
       }
	
}
