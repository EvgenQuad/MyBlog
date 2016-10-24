<?php 
	return array(
		'news/([0-9]+)/download' => 'news/download/$1/',
		'page-([0-9]+)' => 'news/index/$1/',
		'news/([0-9]+)' => 'news/view/$1/', //actionView
		'add' => 'news/add',
		'' => 'news/index',				//actionIndex
	);

 ?>