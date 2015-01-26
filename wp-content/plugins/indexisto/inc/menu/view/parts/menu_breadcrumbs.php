<?php 
	$indexisto_index = get_option('indexisto_index');
	if (!empty($indexisto_index)) { 
	?> 
		<a href="<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=index">Index</a>
		|<a href="<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=account">Account</a> 
		|<a href="<?php echo $_SERVER['PHP_SELF'] ?>?page=IndexistoMenu&subpage=appearance">Appearance</a>
		</br>
		</br>
		</br>
<?php } ?>