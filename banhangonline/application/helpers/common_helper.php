<?php
function public_url($url = ''){
	return base_url('public/'.$url);
}

function pre($data, $exit = true){
	echo "<pre>";
	print_r($data);
	if ($exit) {
		die();
	}
}