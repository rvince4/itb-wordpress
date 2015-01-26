<?php 

function get_menu_index_page($autostart = false) {
	include ("view/index_page.php");
	return;
}

function post_menu_index_page() {
	if ( function_exists('current_user_can') &&
	!current_user_can('manage_options'))
		die (_e('Hacker?', 'Indexisto'));
	
	get_menu_index_page(true);
}

?>