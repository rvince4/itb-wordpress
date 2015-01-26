<?php 

function get_menu_account_page($error = '') {

	$indexisto_secret = get_option('indexisto_secret');
	$indexisto_index = get_option('indexisto_index');
	
	if (!$indexisto_index) {
		
		$register_email = $_POST['register_email'];
		$register_secret = $_POST['register_secret'];
		$register_host = home_url();
		
		if (empty($register_email) || empty($register_secret)) {
			if (empty($register_email)) $register_email = get_option('admin_email', '');
			if (empty($register_secret)) $register_secret = generate_random_string();
		}		
		
		include ("view/account_page.php");
		return;
	} else {
		
		include ("view/account_page_registered.php");
		return;
	}		
}

function post_menu_account_page() {
	
	// collect data
	$register_secret = $_POST['register_secret'];
	$register_email = $_POST['register_email'];
	$register_host = home_url();
	
	// error not correct field
	if (empty($register_email) || empty($register_secret)) {
		return get_menu_account_page('One of the fields was empty');
	}
	
	// API call
	$result = indexisto_do_register_call(
			$register_host,
			$register_email,
			$register_secret);
	$indexisto_index = $result['body'];
	
	// ?error API
	if (strpos(strtolower($indexisto_index), 'error') !== false) {
		return get_menu_account_page('User allready exists or secret is wrong');
	}
	
	// save
	update_option('indexisto_secret', $register_secret);
	update_option('indexisto_index', $indexisto_index);
	return get_menu_account_page();
}

function generate_random_string($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$randomString = '';
	for ($i = 0; $i < $length; $i++) {
		$randomString .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $randomString;
}
?>