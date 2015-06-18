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
		'Role Assignation'   => 'user_admin/role_assign',
		'Subject Admin Role' => 'user_admin/subject_admin_role',
		'Class Admin Role'   => 'user_admin/class_admin_role'
);

$roles = array(
		'1' => 'Full Admin',
		'2' => 'Subject Admin',
		'3' => 'Class Admin',
		'4' => 'Typing Question',
		'5' => 'Normal User'
);

$full_admin_hMenu = array(
		'Admin'             => 'admin',
        'User Admin' 		=> 'user_admin',
		'Review Question'	=> 'home'
);

$subject_admin_hMenu = array(
		'Admin' 			=> 'admin',
		'Review Question' 	=> 'home'
);

$class_admin_hMenu  = $subject_admin_hMenu;

$typing_question_hMenu = array(
		'Quiz'			=> 'quiz',
		'Question'      => 'question'
);

$normal_user_hMenu = array(
		'Luyen tap'     => 'luyentap',
		'Kho de thi'    => 'khodethi',
		'Hoi dap'		=> 'hoidap',
		'Tin tuc'		=> 'tintuc'
);

$no_user_hMenu = $normal_user_hMenu;

$hMenu = array();
$hMenu['0'] = $no_user_hMenu;
$hMenu['1'] = $full_admin_hMenu;
$hMenu['2'] = $subject_admin_hMenu;
$hMenu['3'] = $class_admin_hMenu;
$hMenu['4'] = $typing_question_hMenu;
$hMenu['5'] = $normal_user_hMenu;

$config['hMenu'] = $hMenu;

$config['left_menu'] = $left_menu;
$config['user_admin_left_menu'] = $user_admin_left_menu;
$config['roles'] = $roles;
