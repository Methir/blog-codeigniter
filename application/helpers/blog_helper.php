<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//-----------------------------------------------------------------------------------------------
function paginationConfig($config){

	$config['per_page']	= 5;
	$config['num_links'] = 5;
	$config['use_page_numbers']	= TRUE;
	$config['full_tag_open'] = "<nav aria-label='Page navigation'><ul class='pagination'>";
	$config['full_tag_close'] =	"<ul></nav>";
	$config['first_link'] = "Primeira";
	$config['first_tag_open'] =	"<li>";
	$config['first_tag_close'] = "</li>";
	$config['last_link'] = "Última";
	$config['last_tag_open'] = "<li>";
	$config['last_tag_close'] =	"</li>";
	$config['next_link'] = "Próxima";
	$config['next_tag_open'] = "<li>";
	$config['next_tag_close'] =	"</li>";
	$config['prev_link'] = "Anterior";
	$config['prev_tag_open'] = "<li>";
	$config['prev_tag_close'] =	"</li>";
	$config['cur_tag_open']	= "<li class='active'><a href='#'>";
	$config['cur_tag_close'] = "</a></li>";
	$config['num_tag_open']	= "<li>";
	$config['num_tag_close'] = "</li>";

return $config;			
}



