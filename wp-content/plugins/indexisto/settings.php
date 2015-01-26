<?php
define('ENVIRONMENT_TYPE_DEV', 'dev');
define('ENVIRONMENT_TYPE_PROD', 'prod');
define('ENVIRONMENT', ENVIRONMENT_TYPE_PROD);

define('JSON_DEFAULT', 0);
define('JSON_PRETTY', 128);

define('settings_search_input_inline_style', 'outline-color:transparent; box-sizing:content-box; outline:none; background:#FFF url(http://servant.indexisto.com/files/searchbox/search_icon_21px.png) no-repeat scroll 6px center; border:2px solid rgb(255, 151, 18); border-radius:5px; width:202px; padding:0 0 0 31px; height:32px; line-height:23px; color:#abaaaa; font-family:Arial; font-size:18px;');
define('settings_search_input_mode_default', 'default');
define('settings_search_input_mode_custom', 'custom');

define('settings_index_batch_size', 20);
define('settings_index_ajax_call_timeout', 300);

define('settings_search_input_placeholder', 'Start typing');

function get_json_option() {
	return ENVIRONMENT == ENVIRONMENT_TYPE_DEV ? JSON_PRETTY : JSON_DEFAULT;
}

?>