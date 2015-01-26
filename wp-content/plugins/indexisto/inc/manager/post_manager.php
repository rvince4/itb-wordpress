<?php 
function indexisto_post_update($post_id) {
	// post
	logg('========================> post_update');
	$post = get_post($post_id);

	// not public type
	// TODO: make setting to index password protected posts
	if ($post->post_status != 'publish'
			|| !empty($post->post_password)) {
		logg('-> post is not public, delete call');

		// document
		logg('post status: ' . $post->post_status);
		$document = get_document($post, true);
		logg('document: ' . $document);

		indexisto_do_API_call($document, 'DELETE');
		return;
	}

	// system type
	if ($post->post_type == 'revision'
			|| $post->post_type == 'attachment'
					|| $post->post_type == 'nav_menu_item') {
		logg('-> post is a system type, not indexing');
		return;
	}

	// document
	logg('post status: ' . $post->post_status);
	$document = get_document($post);
	logg('document: ' . $document);

	// API post
	$result = indexisto_do_API_call($document);
}

function indexisto_post_delete($post_id) {
	// post
	logg('========================>');
	logg('-> post_delete');

	$post = get_post($post_id);

	// system type
	if ($post->post_type == 'revision'
			|| $post->post_type == 'attachment'
					|| $post->post_type == 'nav_menu_item') {
		logg('-> post is a system type, not indexing');
		return;
	}

	// document
	logg('post status: ' . $post->post_status);
	$document = get_document($post, true);
	logg('document: ' . $document);

	// API post
	$result = indexisto_do_API_call($document, 'DELETE');
}

?>