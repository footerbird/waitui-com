<?php
	$config['page_query_string'] = TRUE; //设置为get参数的形式
	$config['use_page_numbers'] = TRUE; //设置为page为实际的页数而不是偏移量
	$config['query_string_segment'] = 'page';//设置传递的参数，默认per_page
	
	$config['full_tag_open'] = '<div class="pagination"><ul>';
	$config['full_tag_close'] = '</ul></div>';
	
	$config['first_tag_open'] = '<li class="first">';
	$config['first_tag_close'] = '</li>';
	
	$config['last_tag_open'] = '<li class="last">';
	$config['last_tag_close'] = '</li>';
	
	$config['next_tag_open'] = '<li class="next">';
	$config['next_tag_close'] = '</li>';
	
	$config['prev_tag_open'] = '<li class="prev">';
	$config['prev_tag_close'] = '</li>';
	
	$config['num_tag_open'] = '<li>';
	$config['num_tag_close'] = '</li>';
	
	$config['cur_tag_open'] = ' <li class="current"><a>'; // 当前页开始样式   
	$config['cur_tag_close'] = '</a></li>'; 
	
	$config['first_link'] = '<<'; // 第一页显示   
	$config['last_link'] = '>>'; // 最后一页显示   
// 	$config['first_link'] = false;//不显示首页
// 	$config['last_link'] = false;//不显示末页
	$config['next_link'] = '>'; // 下一页显示   
	$config['prev_link'] = '<'; // 上一页显示   
?>