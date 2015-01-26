<?php

function get_index_status() {
	
	$result = array();
	$types = array();
	
	$post_types = get_post_types('', 'names');
	$indexed = true;
	
	foreach ($post_types as $post_type) {
		$posts_count = wp_count_posts($post_type);
		if ($posts_count->publish == 0) continue;
		
		$offset = get_option('indexisto_initial_index_offset_by_type_' . $post_type);
		if (empty($offset)) $offset = 0;
		$types[$post_type] = array($offset, $posts_count->publish);
		if ($offset > -1) $indexed = false;
	}
	$result['types'] = $types;
	$result['indexed'] = $indexed;
	return $result;
}

function drop_index_status() {
	$post_types = get_post_types('', 'names');
	foreach ($post_types as $post_type) {
		update_option('indexisto_initial_index_offset_by_type_' . $post_type, 0);
	}
}	
?>