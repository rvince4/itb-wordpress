<?php

/**
 * make Indexisto API call
 */
function indexisto_do_API_call($data, $method = 'POST') {
  $api_url = 'http://api.indexisto.com';
  $api_version = '/1.0';
  $secret = get_option('indexisto_secret');
  $index = get_option('indexisto_index');
  

  // Generate request url.
  $request_url = $api_url . $api_version . '/document/' . $index . '/default';
  //logg('API url: ' . $request_url);
  
  // Url for sign
  $sign_url = $api_version . '/document/' . $index . '/default';

  // Generate key for sending data.
  $code = md5($sign_url . $data . $secret);
  
  // Make http request
  $response = wp_remote_post($request_url . '?code=' . $code, array(
  		'method' => $method,
  		'timeout' => 45,
  		'redirection' => 5,
  		'httpversion' => '1.0',
  		'blocking' => true,
  		'headers' => array(),
  		'body' => $data,
  		'cookies' => array()
  	)
  ); 
  
  if (is_wp_error($response)) {
  	$error_message = $response->get_error_message();
  	logg('API call error: ' . $error_message);
  } else {
  	logg('API call OK: ' . $response['body']);
  }
  return $response;
}

function indexisto_do_register_call($register_host, $register_email, $register_secret) {
	$register_url = 'http://adminpanel.indexisto.com/adminpanel/apireg.rpc?host=' 
		. $register_host . '&email=' . $register_email . '&secret=' . $register_secret;
	$response = wp_remote_post($register_url, array(
			'method' => 'POST',
			'timeout' => 45,
			'redirection' => 5,
			'httpversion' => '1.0',
			'blocking' => true,
			'headers' => array(),
			'body' => '',
			'cookies' => array()
		)
	);

	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		logg('API call error: ' . $error_message);
	} else {
		logg('API call OK: ' . $response['body']);
	}
	return $response;
}

?>