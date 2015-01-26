<?php 
	$inline_style = get_option('indexisto_settings_search_input_inline_style');
	if (empty($inline_style)) $inline_style = settings_search_input_inline_style;

	$indexisto_index = get_option('indexisto_index');
	$search_input_placeholder = get_option('indexisto_settings_search_input_placeholder');
	$mode = get_option('indexisto_settings_search_input_mode');
	
	if ($mode == settings_search_input_mode_custom) {
		$radioDefault = "";
		$radioCustom = "checked";
		$inputCustom = "";
	} else {
		$radioDefault = "checked";
		$radioCustom = "";
		$inputCustom = "disabled";
	}
?>


</br>
	<h1>Indexisto settings - Appearance</h1>
<?php include ("parts/menu_breadcrumbs.php"); ?>

<form method='post' name='indexisto' action='<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=appearance&updated=true'>
	<?php 
		if (function_exists ('wp_nonce_field'))
		{
			echo wp_nonce_field('indexisto_form');
		}
	?>
	
	Search input placeholder:&nbsp;&nbsp;&nbsp;<input type='text' name='placeholder' value='<?php echo $search_input_placeholder ?>'></input></br></br>
	
	<input id="radioInject" type="radio" name="search_input_mode" value="default" <?php echo $radioDefault ?>> Default search input<br>
	</br>
	<input id="radioCustom" type="radio" name="search_input_mode" value="custom" <?php echo $radioCustom ?>> Custom search input with style customization<br>
	</br>
	Inline style of custom input: </br>
	<input id="inputCustom" type="text" name="inline_style" value="<?php echo $inline_style ?>" style="width:500px;" <?php echo $inputCustom ?>>
	&nbsp;<input id="inputCustomSubmit" type="submit" name="reset" value="Reset style" <?php echo $inputCustom ?> class='button-primary'>
	</br>
	</br>

	<input type='hidden' name='page_options' value='indexisto_secret, indexisto_index'/>
	<input type='hidden' name='reindex' value='true'/>
	<input type='submit' name='submit' value='Save settings' class='button-primary'></input>
</form>

<script type='text/javascript'>
	jQuery("#radioDefault").change(function() {
		jQuery("#inputCustom").prop('disabled', true);
		jQuery("#inputCustomSubmit").prop('disabled', true);
	});
	jQuery("#radioCustom").change(function() {
		jQuery("#inputCustom").prop('disabled', false);
		jQuery("#inputCustomSubmit").prop('disabled', false);
	});	
	 //onclick="alert('asd')"
</script>
