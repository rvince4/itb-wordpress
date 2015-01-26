<?php

function get_index_status_ajax() {
	logg('post_index_status_ajax GET request');
	logg('JSON_PRETTY_PRINT: ' . JSON_PRETTY_PRINT);
	
	return json_encode(get_index_status(), get_json_option());
}

function post_index_status_ajax() {
	logg('post_index_status_ajax POST request');
	return json_encode(get_index_status(), get_json_option());
}

?>