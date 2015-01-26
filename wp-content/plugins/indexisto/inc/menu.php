<?php
require_once("menu/account_controller.php");
require_once("menu/appearance_controller.php");
require_once("menu/index_controller.php");

function manage_menu() {
	security_check();
	
	$subpage = isset($_POST['subpage']) ? $_POST['subpage'] : (isset($_GET['subpage']) ? $_GET['subpage'] : 'index');
	
	// base variables
	$indexisto_secret = get_option('indexisto_secret');
	$indexisto_index = get_option('indexisto_index');
	
	logg('>>> $subpage:' . $subpage);
	logg('>>> REQUEST_METHOD:' . $_SERVER['REQUEST_METHOD']);
	logg('>>> !empty($indexisto_index):' . !empty($indexisto_index));
	
	// only registered
	if (!empty($indexisto_index)) {
		if ($subpage == 'appearance') {
			return $_SERVER['REQUEST_METHOD'] === 'POST' ? post_menu_appearance_page() : get_menu_appearance_page();
			
		} else if ($subpage == 'index') {
			return $_SERVER['REQUEST_METHOD'] === 'POST' ? post_menu_index_page() : get_menu_index_page();
			
		} else if ($subpage == 'account') {
			return $_SERVER['REQUEST_METHOD'] === 'POST' ? post_menu_account_page() : get_menu_account_page();
	
		}

	// not registered	
	} else {
		return $_SERVER['REQUEST_METHOD'] === 'POST' ? post_menu_account_page() : get_menu_account_page();
	}
}

function security_check() {
	if ( function_exists('current_user_can') &&
	!current_user_can('manage_options'))
		die (_e('Hacker?', 'Indexisto'));
	if ($_SERVER['REQUEST_METHOD'] === 'POST' 
			&& function_exists ('check_admin_referer'))
	{
		check_admin_referer('indexisto_form');
	}
}

function isAllIndexed() {
	$post_types = get_post_types('', 'names');
	$indexed = true;
	foreach ($post_types as $post_type) {
		if ($post_type == 'revision'
				|| $post_type == 'attachment'
						|| $post_type == 'nav_menu_item') {
			continue;
		}
		$offset = get_option('indexisto_initial_index_offset_by_type_' . $post_type);
		if (empty($offset)) $offset = 0;
		if ($offset > -1) $indexed = false;
	}
	return $indexed;
}
?>