jQuery(document).ready(function() {
  jQuery('input[name=s]').each(function() {
	  jQuery(this).attr('autocomplete', 'off');
	  jQuery(this).attr('autocorrect', 'off');
	  jQuery(this).attr('id', 'indx_srchbox_<?php echo $_GET['indexisto_index'] ?>');
	  jQuery(this).attr('placeholder', 'Start typing');
  });
});