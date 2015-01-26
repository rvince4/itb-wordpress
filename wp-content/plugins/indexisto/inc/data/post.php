<?php

function get_document($post, $only_id = false) {
	$documentArray = array();
	$documentArray['_id'] = $post->ID;
	if (!$only_id) {
		$documentArray['title'] = $post->post_title;
		$documentArray['_image'] = get_post_image($post);
		$documentArray['_url'] = get_permalink($post->ID);
		$documentArray['description'] = strip_tags($post->post_excerpt);
		$documentArray['tags'] = get_post_tags($post);
		$documentArray['body'] = strip_tags($post->post_content);
		$documentArray['date'] = get_post_date($post);
		$documentArray['author'] = get_post_author_name($post);
		$documentArray['_subtype'] = $post->post_type;
		$documentArray['_sumtext'] = get_document_sumtext($post);
		$documentArray['comment_count'] = $post->comment_count;
	}	
	$document = json_encode($documentArray, get_json_option());
	return $document;
}

function get_document_sumtext($post) {
	$sumtext = strip_tags($post->post_content);
	$tags = get_post_tags($post);
	foreach($tags as $tag) {
		$sumtext = $sumtext . ' ' . $tag;
	}
	return $sumtext;
}


function get_post_author_name($post) {
	$user = get_userdata($post->post_author);
	return $user->user_login;
}

function get_post_date($post) {
	$pieces = explode(' ', $post->post_date);
	return $pieces[0] . 'T' . $pieces[1];
}

function get_post_tags($post) {
	$tagsArray = array();
	$posttags = get_the_tags($post->ID);
	if ($posttags) {
		foreach($posttags as $tag) {
			$tagsArray[] = $tag->name;
			//$sumtext = $sumtext . ' ' . $tag->name;
		}
	}
	return $tagsArray;
}

function get_post_image($post) {
	$imageUrl = '';
	if (has_post_thumbnail($post->ID)) {
		$imageUrl = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail');
		$imageUrl = $imageUrl[0];
	}
	if ($imageUrl == '') {
		$args = array(
				'post_type' => 'attachment',
				'numberposts' => -1,			// posts per page (posts_per_page)
				'post_status' => null,			// Attachments don't have a publish status, which is default for the query | 'any' - all types except revisions
				'post_parent' => $post->ID
		);
		$attachments = get_posts($args);
		if ($attachments) {
			foreach ($attachments as $attachment) {
				$imageObj = wp_get_attachment_image_src($attachment->ID);
				$imageUrl = $imageObj[0];
				break;
			}
		}
	}
	return $imageUrl;
}

?>