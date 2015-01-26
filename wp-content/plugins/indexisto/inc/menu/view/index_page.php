<script type='text/javascript'>
		var inderval = ''; 
		
		jQuery(document).ready(
			function() {
				indexistoIndexStatusCall();
			}
		);

		
	   function indexistoIndexReindexCall() {
		   jQuery('#indexButton').attr('disabled', 'disabled');
		   jQuery('#reindexButton').attr('disabled', 'disabled');

		    var data = {
	    		action: 'indexisto_index_reindex_ajax',
	    		testvar: 'testval'
	    	};

		    jQuery.post(ajaxurl, data, function(response) {
	    		try {
		    		var indexed = JSON.parse(response);
		    		jQuery("#menuIndexed").css("display", "none");
				    jQuery("#menuNotIndexed").css("display", "block");
					jQuery("#progressBar").progressbar({value: 0.1});
					jQuery("#progressBar").progressbar("enable");			    		
		    		showProgress(indexed, true);
		    		indexistoIndexCall();
				} catch(e) {
					alert(e);
				}
	    	});
	   }
		
	   function indexistoIndexStatusCall() {
		    var data = {
	    		action: 'indexisto_index_status_ajax',
	    		testvar: 'testval'
	    	};

		    jQuery.post(ajaxurl, data, function(response) {
	    		try {
		    		var indexed = JSON.parse(response);
		    		var isIndexed = indexed['indexed'];
				    jQuery("#menuLoading").css("display", "none");

				    if (!isIndexed) {
					    jQuery("#menuNotIndexed").css("display", "block");
					    jQuery("#progressBar").progressbar({value: 0.1});
						jQuery("#progressBar").progressbar("enable");			    
			    		showProgress(indexed, false);
			    		<?php if ($autostart) {	?>
			    			indexistoIndexCall();		
			    		<?php }	?>						
				    } else {
				    	jQuery("#menuIndexed").css("display", "block");
					}
				} catch(e) {
					alert(e);
				}
	    	});
	   }	   
		
	   function indexistoIndexCall() {
	       window.clearInterval(window.callTimer);
	       window.callTimer = null;
		   jQuery('#indexButton').attr('disabled', 'disabled');
		   jQuery('#reindexButton').attr('disabled', 'disabled');
		   
		    var data = {
	    		action: 'indexisto_index_ajax',
	    		testvar: 'testval'
	    	};

		    jQuery.post(ajaxurl, data, function(response) {
	    		try {
		    		var indexed = JSON.parse(response);
		    		var isIndexed = indexed['indexed'];
				    if (isIndexed) {
					    jQuery("#menuNotIndexed").css("display", "none");
					    jQuery("#menuIndexed").css("display", "block");
					    jQuery('#indexButton').removeAttr('disabled');
					    jQuery('#reindexButton').removeAttr('disabled');
				    } else {
				    	showProgress(indexed, true);
				    	window.callTimer = window.setInterval(function(){indexistoIndexCall()}, <?php echo settings_index_ajax_call_timeout; ?>);
				    }		    		
				} catch(e) {
					alert(e);
				}
	    	});
	   }

	   function showProgress(indexed)
	   {
	   		try {
		   		var types = indexed['types'];
				var progressBarIndexed = 0;
				var progressBarTotal = 0;
				var progressTabHtml = '';
		   		
	    		for (var prop in types) {
		    		var currentIndexed = parseInt(types[prop][0]) == -1 ? parseInt(types[prop][1]) : parseInt(types[prop][0]);
		    		progressBarIndexed += currentIndexed;
		    		progressBarTotal += parseInt(types[prop][1]);
		    		progressTabHtml += '<i>' + prop + '</i>' + ':&nbsp;&nbsp;&nbsp;<b>' + currentIndexed + '</b> / ' + parseInt(types[prop][1]) + '</br>';
		    	}
		    	
		    	// output 
	    		jQuery("#progressBar").progressbar({
					value: 100 / (progressBarTotal/progressBarIndexed)
				});			    	
	    		jQuery('#progressTab').html(progressTabHtml);
			} catch(e) {
				alert('---' + e);
			} 
			return false;
	   }		   		
</script>
</br>
<h1>Indexisto settings - Index</h1>
<?php include ("parts/menu_breadcrumbs.php"); ?>


<div id='menuLoading' style='display:block;'>
	<div id='statusDiv'><b>Loading...</b></div></br>
</div>	


<div id='menuNotIndexed' style='display:none;'>
	<div id='statusDiv'><b>Your data is not yet indexed:</b></div></br>
	
	<div id='progressDiv' style='background-color: #ffffff; width: 450px;'>
		<div id='progressTab' style='width: 70%; margin: 10px 40px;'>
		</div>
		<div id='progressBar' style='width: 90%; margin: 0 auto;'></div>
		</br>
	</div>
	
	<div id='operationDiv'>
		Please press <b>"Index data"</b> and wait until your data is indexed</br>
		New data will be added automaticaly into search index as new posts added</br></br>
		<input id='indexButton' type='button' name='button' value='Index data' onClick='indexistoIndexCall()' class='button-primary'></input>
	</div>
</div>	


<div id='menuIndexed' style='display:none;'>
	<div id='statusDiv'><b>Your data is indexed:</b></div></br>
	
	<div id='operationDiv'>
		Press <b>"Reindex data"</b> if you want to reindex all your data.</br>
		New data(posts, pages ..) are added automaticaly into search index as new posts added.</br></br>
		<input id='reindexButton' type='button' name='button' value='Reindex data' onClick='indexistoIndexReindexCall()' class='button-primary'></input>
	</div>
</div>	

<br>