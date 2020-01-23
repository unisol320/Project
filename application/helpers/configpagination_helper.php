<?php

function paginationConfig($base_url,$id , $order , $totalRows , $per_page , $uri_segment)
{

	$config['base_url'] = $base_url;
	$config['total_rows'] = $totalRows;
	$config['per_page'] = $per_page;
	$config['uri_segment'] = $uri_segment;
	return $config;
}
