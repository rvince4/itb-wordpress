<?php

function get_menu_appearance_page() {
	include ("view/appearance_page.php");
}

function post_menu_appearance_page() {
	
	// save settings
	if (isset($_POST['submit'])) {
		logg('--> appearance submit');
		logg('--> ' . $_POST['search_input_mode']);

		if ($_POST['search_input_mode'] == settings_search_input_mode_custom) {
			update_option('indexisto_settings_search_input_mode', 
			settings_search_input_mode_custom);
			update_option('indexisto_settings_search_input_inline_style',
			$_POST['inline_style']);
		} else {
			update_option('indexisto_settings_search_input_mode',
			settings_search_input_mode_default);
		}
		update_option('indexisto_settings_search_input_placeholder',
			$_POST['placeholder']);		
		
	// reset inline
	} else if (isset($_POST['reset'])) {
		logg('--> appearance reset');
		update_option('indexisto_settings_search_input_inline_style',
		settings_search_input_inline_style);
	}
	
	get_menu_appearance_page();
}
?>