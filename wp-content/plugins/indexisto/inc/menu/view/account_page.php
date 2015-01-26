</br>
<h1>Indexisto settings - Account</h1>
<?php include ("parts/menu_breadcrumbs.php"); ?> 
<form method='post' name='indexisto' action='<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=account'><!-- &updated=true -->
Your email:&nbsp;&nbsp;&nbsp;<input type='text' name='register_email' value='<?php echo $register_email ?>'></input></br>
Your secret code:&nbsp;&nbsp;&nbsp;<input type='text' name='register_secret' value='<?php echo $register_secret ?>'></input></br>
Enter a secret code of your choice or use proposed one.</br>
Keep it in a safe place to be able to recover account or log in to admin panel on our site.</br>
</br>
<?php 
	if (function_exists ('wp_nonce_field'))
	{
		echo wp_nonce_field('indexisto_form');
	}
?>
<!-- <input type='hidden' name='page_options' value='indexisto_secret, indexisto_index'/> -->
<?php 
if (!empty($error)) { ?>
	<font color='red'><?php echo $error ?></font></br>
	</br>
<?php } ?>
<input type='submit' name='submit' value='Register' class='button-primary'></input></br>
</form>