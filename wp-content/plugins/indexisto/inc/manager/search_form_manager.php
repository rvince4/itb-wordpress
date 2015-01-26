<?php 
function indexisto_get_search_form($index_id, $placeholder, $inline_style) {
	$form = "<input autocomplete='off' autocorrect='off' 
	id='indx_srchbox_" . $index_id . "' 
	placeholder='" . $placeholder ."' type='text' ";
	if (!empty($inline_style)) $form .= "style='" . $inline_style . "' ";
	$form .= "/>";
	return $form;
}
?>