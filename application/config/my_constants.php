<?php
$left_menu = array(
				'News'    		=> 'admin/news_admin',
				'Subject'		=> 'admin/subject_admin',
				'Class'         => 'admin/class_admin',
				'Chuong'        => 'admin/chuong_admin',
				'Chuyen De'     => 'admin/chuyen_de_admin',
				'Dang Bai'      => 'admin/dang_bai_admin',
				'Question Type' => 'admin/question_type_admin'
		);

$user_admin_left_menu = array(
		'Role Assignation' => 'user_admin/role_assign',
		'Subject Admin Role' => 'user_admin/subject_admin_role',
		'Class Admin Role' => 'user_admin/class_admin_role'
);
$config['left_menu'] = $left_menu;
$config['user_admin_left_menu'] = $user_admin_left_menu;