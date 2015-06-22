<?php
$left_menu = array(
				'Tin Tức'    		=> 'admin/news_admin',
				'Môn Học'		=> 'admin/subject_admin',
				'Lớp Học'         => 'admin/class_admin',
				'Chương'        => 'admin/chuong_admin',
				'Chuyên Đề'     => 'admin/chuyen_de_admin',
				'Dạng Bài'      => 'admin/dang_bai_admin',
				'Loại Câu Hỏi' => 'admin/question_type_admin'
		);

$user_admin_left_menu = array(
		'Người Dùng'   => 'user_admin/role_assign',
		'Quản Trị Môn' => 'user_admin/subject_admin_role',
		'Quản Trị Lớp'   => 'user_admin/class_admin_role'
);

$roles = array(
		'1' => 'Quản Trị Full',
		'2' => 'Quản Trị Môn',
		'3' => 'Quản Trị Lớp',
		'4' => 'Nhập Câu Hỏi',
		'5' => 'Người Dùng'
);

$full_admin_hMenu = array(
		'Quản Trị Full'             => 'admin',
        'Phân Quyền Quản Trị' 		=> 'user_admin',
		'Duyệt Câu Hỏi'	=> 'home'
);

$subject_admin_hMenu = array(
		'Quản trị Full' 			=> 'admin',
		'Duyệt Câu Hỏi' 	=> 'home'
);

$class_admin_hMenu  = $subject_admin_hMenu;

$typing_question_hMenu = array(
		'Nhập Theo Đề Thi'			=> 'quiz',
		'Nhập Câu Hỏi Tự Do'      => 'question'
);

$normal_user_hMenu = array(
		'Luyện Tập'     => 'luyentap',
		'Kho Đề Thi'    => 'khodethi',
		'Hỏi Đáp'		=> 'hoidap',
		'Tin Tức'		=> 'tintuc'
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

$question_status_options = array(
		'0' => 'Khóa',
		'1' => 'Đã Duyệt',
		'2' => 'Đăng'
);

$config['question_status_options'] = $question_status_options;
