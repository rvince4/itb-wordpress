</br>
<h1>Indexisto settings - Account</h1>
<?php include ("parts/menu_breadcrumbs.php"); ?>
Your index ID:&nbsp;&nbsp;&nbsp;
<input type='text' name='index_id' value='<?php echo $indexisto_index ?>' readonly></input></br>
</br>
Your secret code:&nbsp;&nbsp;&nbsp;
<input type='text' name='secret_code' value='<?php echo $indexisto_secret ?>' readonly></input></br>
<font color='green'>Keep secret code in a safe place to be able to recover account or log in to admin panel on our site.</font>
<?php 
	$index_status = get_index_status();
	if (!$index_status['indexed']) {
?>
	</br></br>
	<form method='post' name='start_indexing' action='<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=index'>
		<?php 
			if (function_exists ('wp_nonce_field'))
			{
				echo wp_nonce_field('indexisto_form');
			}
		?>		
		<input type='submit' name='start_indexing' value='NEXT => Start indexing content' class='button-primary'></input>
	</form>	
<?php		
	} 
?> 
</br></br>
<font size="1">Note that serch result overlay is provided with a "powered by" link.</br>
If you do not agree with that you should uninstall Indexisto plugin.</font>
