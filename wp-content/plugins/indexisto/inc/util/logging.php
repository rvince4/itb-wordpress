<?php

function logg($message) {
	if (true === WP_DEBUG && ENVIRONMENT == ENVIRONMENT_TYPE_DEV) {
		if (is_array($message) || is_object($message)) {
			error_log(print_r($message, true));
		} else {
			error_log($message);
		}
	}
}

/* function boolString($bValue = false) {
 return ($bValue ? 'true' : 'false');
} */

?>