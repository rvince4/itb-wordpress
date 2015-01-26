<?php

function get_reindex_index_ajax() {
	logg('post_reindex_index_ajax GET request');
	drop_index_status();
	return json_encode(get_index_status(), get_json_option());
}

function post_reindex_index_ajax() {
	logg('post_reindex_index_ajax POST request');
	drop_index_status();
	return json_encode(get_index_status(), get_json_option());
}

?>