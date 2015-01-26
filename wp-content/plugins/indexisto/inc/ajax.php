<?php
require_once("ajax/index_ajax_controller.php");
require_once("ajax/index_status_ajax_controller.php");
require_once("ajax/index_reindex_ajax_controller.php");

function indexisto_index_ajax() {
	echo $_SERVER['REQUEST_METHOD'] === 'POST' ? post_menu_index_ajax() : get_menu_index_ajax();
	die();
}

function indexisto_index_status_ajax() {
	echo $_SERVER['REQUEST_METHOD'] === 'POST' ? get_index_status_ajax() : get_index_status_ajax();
	die();
}

function indexisto_index_reindex_ajax() {
	echo $_SERVER['REQUEST_METHOD'] === 'POST' ? post_reindex_index_ajax() : get_reindex_index_ajax();
	die();
}
?>