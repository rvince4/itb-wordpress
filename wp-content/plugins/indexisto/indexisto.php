<?php
/*
Plugin Name: Indexisto
Plugin URI: http://indexisto.com
Description: Brings a fabulous and interactive search to your site
Version: 1.0.5
Author: Indexisto
Author URI: http://indexisto.com
*/

/*  Copyright 2014 Indexisto  (email : info {at} indexisto.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.
*/


require_once('settings.php');
require_once('inc/util/logging.php');

require_once("inc/manager/index_manager.php");
require_once('inc/manager/api_manager.php');
require_once('inc/manager/search_form_manager.php');
require_once('inc/manager/post_manager.php');
require_once("inc/manager/search_form_manager.php");

require_once('inc/data/post.php');

require_once("inc/ajax.php");
require_once('inc/menu.php');


function indexisto_activate() {
	logg('indexisto_activate');
	update_option('indexisto_settings_search_input_placeholder',
		settings_search_input_placeholder);
}

/*
 *  runs on every page
 *  mainly JS includes
 */
function indexisto_init() {
	
	// libs
	wp_register_style('jqueryui', plugins_url() . '/indexisto/theme/jquery-ui.css');
	wp_enqueue_style('jqueryui');
	wp_register_style('jqueryuicore', plugins_url() . '/indexisto/theme/jquery.ui.core.css');
	wp_enqueue_style('jqueryuicore');
	wp_register_style('jqueryuiprogressbar', plugins_url() . '/indexisto/theme/jquery.ui.progressbar.css');
	wp_enqueue_style('jqueryuiprogressbar');	
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-progressbar');
	
	// searchbox
	wp_register_script('indexisto-searchbox', 'http://servant.indexisto.com/files/searchbox/searchbox.nocache.js?type=edit');
	wp_enqueue_script('indexisto-searchbox');
}

function indexisto_deactivation() {
	logg('indexisto_deactivation');
	clear_all();
}

function indexisto_uninstall() {
	logg('indexisto_uninstall');
	clear_all();
}

function clear_all() {

	// delete base values
	delete_option('indexisto_secret');
	delete_option('indexisto_index');

	// delete initial index progress
	$post_types = get_post_types('', 'names');
	foreach ($post_types as $post_type) {
		delete_option('indexisto_initial_index_offset_by_type_' . $post_type);
	}

	// delete settings
	delete_option('indexisto_settings_search_input_mode');
	delete_option('indexisto_settings_search_input_placeholder');
	delete_option('indexisto_settings_search_input_inline_style');
	
	delete_option('indexisto_settings_search_input_integration_type');
}


function indexisto_menu()
{
	echo manage_menu();
}

function indexisto_admin_menu()
{
	if (function_exists('add_options_page'))
	{
		$index_id = get_option('indexisto_index');
		add_options_page(
			'Indexisto',
			'Indexisto',
			'manage_options',
			'IndexistoMenu',
			'indexisto_menu');		
	}
}


function indexisto_search_form($form) {
	$index_id = get_option('indexisto_index');
	$input_mode = get_option('indexisto_settings_search_input_mode');
	$inline_style = '';
	
	if ($input_mode == settings_search_input_mode_custom) {
		$inline_style = get_option('indexisto_settings_search_input_inline_style');
		if (empty($inline_style)) $inline_style = settings_search_input_inline_style;
	}
	
	$placeholder = get_option('indexisto_settings_search_input_placeholder');
	$form = indexisto_get_search_form($index_id, $placeholder, $inline_style);
	return $form;
}


/*
 * Post changes hooks
 */
add_action('init', 'indexisto_init');
add_action('admin_menu', 'indexisto_admin_menu');
add_action('save_post', 'indexisto_post_update');
add_action('deleted_post', 'indexisto_post_delete'); //delete_post, deleted_post

/*
 * Install / Uninstall hooks
 */
register_activation_hook( __FILE__, 'indexisto_activate');
register_deactivation_hook(__FILE__, 'indexisto_deactivation');
register_uninstall_hook(__FILE__, 'indexisto_uninstall');

/*
 * AJAX
 */
add_action('wp_ajax_indexisto_index_ajax', 'indexisto_index_ajax' );
add_action('wp_ajax_indexisto_index_status_ajax', 'indexisto_index_status_ajax');
add_action('wp_ajax_indexisto_index_reindex_ajax', 'indexisto_index_reindex_ajax');

/*
 * Search form
 */
add_filter('get_search_form', 'indexisto_search_form');
?>