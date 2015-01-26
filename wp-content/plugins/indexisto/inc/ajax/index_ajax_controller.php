<?php

function get_menu_index_ajax() {
	logg('initial_index GET request');
	return post_menu_index_ajax();
}

function post_menu_index_ajax() {
	logg('initial_index POST request');
	return initial_index_loop();
}

function initial_index_loop() {
	logg('========================> indexing');
	$post_types = get_post_types('', 'names');
	
	$batch_documents = '[';
	$first_document = true;
	
	foreach ($post_types as $post_type) {
		$posts_count = wp_count_posts($post_type);
		$offset = get_option('indexisto_initial_index_offset_by_type_' . $post_type);
		if (empty($offset)) $offset = 0;
		//logg($post_type . ' - posts indexed ' . $offset . ' / ' . $posts_count->publish);
		if ($offset == -1) {
			continue;
		}
		
		//TODO: check bad types normally?
		// zero published instances mean system type
		if ($posts_count->publish == 0) continue;
		
		$args = array(
				'posts_per_page'   => settings_index_batch_size,
				'offset'           => $offset,
				'category'         => '',				// ?
				'orderby'          => 'post_date',
				'order'            => 'ASC',
				'post_type'        => $post_type,
				'post_status'      => 'publish',
				'suppress_filters' => true);
		$posts = get_posts($args);
		foreach ($posts as $post) {
			if (empty($post->post_password)) {
				$document = get_document($post);
				if (!$first_document) {
					$batch_documents .= ',';
				} else {
					$first_document = false;
				}
				$batch_documents .= $document;
				//$api_call_result = indexisto_do_API_call($document);
				// TODO: check response
				// TODO: make batch post
			} else {}
		}
		if (empty($posts)) {
			update_option('indexisto_initial_index_offset_by_type_' . $post_type, -1);
		} else {
			$new_offset = $offset + settings_index_batch_size;
			if ($new_offset >= $posts_count->publish) {
				update_option('indexisto_initial_index_offset_by_type_' . $post_type, -1);
			} else {
				update_option('indexisto_initial_index_offset_by_type_' . $post_type, $new_offset);
			}
		}
	}
	$batch_documents .= ']';
	
	logg($batch_documents);
	$api_call_result = indexisto_do_API_call($batch_documents);
	logg(json_encode(get_index_status(), get_json_option()));
	return json_encode(get_index_status(), get_json_option());
}
?>