<?php	
	include widget_config_form('forum');
	include widget_config_form('title');
	widget_config_extra_begin();		
	include widget_config_form('text', array(
		'name'				=> 'no',
		'caption'			=> ln('No.', '글 갯수'),
		'placeholder'	=> ln("Insert No of Posts", "출력할 글 개 수를 입력하세요.")
		)
	);
	include widget_config_form( 'file', array(
		'name'		=>	'icon',
		'caption'	=>	'icon (15x15)'
		)
	);
	include widget_config_form('css');
	widget_config_extra_end();