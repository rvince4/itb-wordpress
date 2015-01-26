<?php

function rnr_shortcodes_formatter($content) {
	$block = join("|",array(
						"button",
						"full_width_color",
						"contact_box",
						"testimonial_slider_box",
						"testimonial_slide",
						"service_box",
						"parallax_twitter",
						"video",
						"clients_box",
						"milestone_box",
						"icon_box",
						"pullquote",
						"blockquote",
						"parallax_quote",
						"fancy_header",
						"social",
						"alert_box",
						"skill_bar",
						"tabgroup",
						"tab",
						"callout",
						"toggle",
						"accordion",
						"accordion_item",
						"map",
						"testimonial",
						"team_member",
						"one_third", 
						"one_third_last", 
						"two_third", 
						"two_third_last", 
						"one_half", 
						"one_half_last", 
						"one_fourth", 
						"one_fourth_last", 
						"three_fourth", 
						"three_fourth_last", 
						"one_fifth", 
						"one_fifth_last", 
						"two_fifth", 
						"two_fifth_last", 
						"three_fifth", 
						"three_fifth_last", 
						"four_fifth", 
						"four_fifth_last",
						"one_sixth", 
						"one_sixth_last", 
						"five_sixth", 
						"five_sixth_last", 
						"center",
						"pre",
						"br",
						"space",
						"clear",
						"typography",
						"highlight",
						"home_callout",
						"home_callout_line",
						"home_textslides",
						"textslide",
						"home_circle_callout",
						"home_circle_callout_line",
						"home_callout2",
						"home_callout2_line",
						"list",
						"list_item",
						"image_slider",
						"image_slide",
						"blog"
						));

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

	return $rep;
}

add_filter('the_content', 'rnr_shortcodes_formatter');
add_filter('widget_text', 'rnr_shortcodes_formatter');


/*-----------------------------------------------------------------------------------*/
/* Button
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_button( $atts, $content = null ) {	

	extract( shortcode_atts(array(
		"link_url" => '',
		"title" => '',
		"scroll" => '',
		"target" => '_self',
		"lightbox"  => '', 
		"color"     => '',
		"background"  => '' 
	), $atts) );

    
    if($lightbox=="true") {
    	$return_lightbox = 'data-rel="prettyPhoto" ';
    }
    else{
    	$return_lightbox = '';
    }

	if ( $scroll=='true' ){
		$scroll_to = 'scroll-to';
	}
	else{
		$scroll_to = '';
	}
	
	if($background || $color) {
	     $return_colors = 'style="background-color:'.$background.'; color:'.$color.' !important;"';
	}
	else {
		$return_colors ='';
	}

	$rnr_button = '<a href="'. $link_url .'" target="'.$target.'" class="button '. $scroll_to .'" '.$return_lightbox.' '.$return_colors.' >'. $title .'</a>';

    return $rnr_button;  

}

add_shortcode('button', 'rocknrolla_button');




/*-----------------------------------------------------------------------------------*/
/* full width Color Boxes
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_full_width_color( $atts, $content = null ) {
	
extract( shortcode_atts(array(
		"bg_color" => '#f6f6f6',
		"color" => '#333333',
), $atts) );	

   $rnr_full_width_color = '<div class="full-width" style="color: '. $color .';';
   $rnr_full_width_color .= 'background: '. $bg_color .';';   
   $rnr_full_width_color .= '">' . do_shortcode($content) . '</div>';
   
   return $rnr_full_width_color;
}

add_shortcode('full_width_color', 'rocknrolla_full_width_color');



/*-----------------------------------------------------------------------------------*/
/*	Address Box Shortcode, Parallax Section
/*-----------------------------------------------------------------------------------*/

function rocknrolla_contact_box_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "email" => '',
        "telephone" => '',
        "address" => ''
    ), $atts) );    
	
	if ( substr( $email, 0, 7) == "mailto:" ) {
    	$email = '<a href="'. $email .'">'. substr( $email, 7) .'</a>';
    }

	$rnr_contact_box = '<div class="contact-details">';
	$rnr_contact_box .= '<h2>'. $email .'</h2>';
	$rnr_contact_box .= '<h1>'. $telephone .'</h1>';
	$rnr_contact_box .= '<h2>'. $address .'</h2>';
	$rnr_contact_box .= '</div>';

	return $rnr_contact_box;

}

add_shortcode('contact_box', 'rocknrolla_contact_box_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Testimonial Slider Box Shortcode, Parallax
/*-----------------------------------------------------------------------------------*/

function rocknrolla_testimonial_slider_box_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "title" => ''
    ), $atts) );   

	$rnr_testimonial_slider = '<p class="testimonial-icon"><i class="fa fa-quote-left"></i></p><h3 class="title"><span>'. $title .'</span></h3>';
	$rnr_testimonial_slider .= '<div class="testimonial-slider">';
	$rnr_testimonial_slider .= '<div class="flexslider">';
	$rnr_testimonial_slider .= '<ul class="slides styled-list">'. do_Shortcode($content) .'</ul>';
	$rnr_testimonial_slider .= '</div>';
	$rnr_testimonial_slider .= '</div>';

	return $rnr_testimonial_slider;

}

function rocknrolla_testimonial_slides_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "author" => ''
    ), $atts) );   

	$rnr_testimonial_slides = '<li class="testimonial-slide"><p class="client-testimonial">'. do_Shortcode($content) .'</p><div class="client-info">&#151; '. $author .' &#151;</div></li>';

	return $rnr_testimonial_slides;

}

add_shortcode('testimonial_slider_box', 'rocknrolla_testimonial_slider_box_shortcode');
add_shortcode('testimonial_slide', 'rocknrolla_testimonial_slides_shortcode');


/*-----------------------------------------------------------------------------------*/
/*	Service Box Shortcode
/*-----------------------------------------------------------------------------------*/

function rocknrolla_service_box_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "icon" => '',        // icon url or icon class
        "title" => '',
		"background" => '',
        "icon_type" => 'image'
    ), $atts) );    
	
	$id = rand();

    if ( $icon_type == 'image' ) {
    	$rnr_icon_type = '<div class="img-container">';
		$rnr_icon_type .= '<img src="'. $icon .'" alt="'. $title .'">';
		$rnr_icon_type .= '</div>  ';
    }
    else {
    	$rnr_icon_type = '<i class="fa service-icon '. $icon .'"></i>'; 
    }  
	
	if($background) {
	     $return_colors = '<style type="text/css">#service-box-'.$id.':hover { background: '.$background.'; } #service-box-'.$id.' .service-icon { box-shadow: 0px 0px 0px 3px '.$background.'; background: '.$background.'; } #service-box-'.$id.':hover .service-icon { border: 4px solid '.$background.'; color: '.$background.'; box-shadow: 0px 0px 0px 3px #ffffff; background: #ffffff; }</style>';
	}
	else {
		$return_colors ='';
	}	

	   	
    

	$rnr_service_box = $return_colors.'<div id="service-box-'.$id.'" class="service-box">';
	$rnr_service_box .= '<div>';
	$rnr_service_box .= '<h3>'. $title .'</h3>';
	$rnr_service_box .= $rnr_icon_type;
	$rnr_service_box .= '</div>';
	$rnr_service_box .= '<div class="service-description"><p>'. do_Shortcode($content) .'</p></div>';
	$rnr_service_box .= '</div>';

	return $rnr_service_box;

}

add_shortcode('service_box', 'rocknrolla_service_box_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Parallax Twitter Feed */
/*-----------------------------------------------------------------------------------*/

function rocknrolla_parallax_tweets($atts) {

	extract( shortcode_atts(array(
        "count" => '3',
        "title" => 'Follow us on Twitter'
    ), $atts) );  
	
	global $smof_data;

	$consumer_key = $smof_data['rnr_twitter_consumer_key'];
	$consumer_secret = $smof_data['rnr_twitter_cosumer_secret'];
	$access_token = $smof_data['rnr_twitter_access_token'];
	$access_token_secret =  $smof_data['rnr_twitter_access_token_secret'];
	$twitter_id = $smof_data['rnr_twitter_username'];

	if( $twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count ) { 

		$transName = 'list_tweets_1';
		$cacheTime = 10;
		delete_transient($transName);

		if(false === ($twitterData = get_transient($transName))) {

			// require the twitter auth class
			@require_once 'widgets/twitteroauth/twitteroauth.php';

			$twitterConnection = new TwitterOAuth(
				$consumer_key,	// Consumer Key
				$consumer_secret,   	// Consumer secret
				$access_token,       // Access token
				$access_token_secret    	// Access token secret
			);

			$twitterData = $twitterConnection->get(
				'statuses/user_timeline',
				array(
					'screen_name'     => $twitter_id,
					'count'           => $count,
					'exclude_replies' => false
				)
			);

			if($twitterConnection->http_code != 200)
			{
				$twitterData = get_transient($transName);
			}

			// Save our new transient.
			set_transient($transName, $twitterData, 60 * $cacheTime);

		}

		$twitter = get_transient($transName);

		$rnr_tweet_feed = '<div>';
		$rnr_tweet_feed .= '<p class="twitter-feed-icon"><i class="fa fa-twitter"></i></p>';
		$rnr_tweet_feed .= '<p class="twitter-author"><a href="http://twitter.com/'. $twitter_id .'" target="_blank">'. $title .'</a></p>';
		$rnr_tweet_feed .= '</div>';
		$rnr_tweet_feed .= '<div class="twitter-slider" id="twitter-feed"><div class="flexslider">';
		$rnr_tweet_feed .= '<ul class="slides">';
		
		foreach($twitter as $tweet): 
		$rnr_tweet_feed .= '<li class="slide">';
		$rnr_tweet_feed .= '<p class="jtwt_tweet_text">';	
									$latestTweet = $tweet->text;
									$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
									$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
		$rnr_tweet_feed .= $latestTweet . '</p>';
								$twitterTime = strtotime($tweet->created_at);
								$timeAgo = ago($twitterTime);
		$rnr_tweet_feed .= '<a href="http://twitter.com/'. $twitter_id .'/statuses/'. $tweet->id_str .'" class="jtwt_date">'. $timeAgo .'</a>';
		$rnr_tweet_feed .= '</li>';
		endforeach;

		$rnr_tweet_feed .= '</ul></div>';


		$rnr_tweet_feed .= '</div>';	
	
	}

	else{
		$rnr_tweet_feed = '<h4>Configure the Twitter API Settings inside the Theme Options first.</h4>';
	}
	

	return $rnr_tweet_feed;

}

add_shortcode('parallax_twitter', 'rocknrolla_parallax_tweets');


/*-----------------------------------------------------------------------------------*/
/* Media */
/*-----------------------------------------------------------------------------------*/

function rocknrolla_video($atts) {
	extract(shortcode_atts(array(
		'type' 	=> '',
		'id' 	=> '',
		'autoplay' 	=> ''
	), $atts));
	
		$height = 315;
		$width = 560;
	
	
	$autoplay = ($autoplay == 'yes' ? '1' : false);
		
	if($type == "vimeo") $rnr_video = "<div class='video-embed'><iframe src='http://player.vimeo.com/video/$id?autoplay=$autoplay&amp;title=0&amp;byline=0&amp;portrait=0' width='$width' height='$height' class='iframe'></iframe></div>";
	
	else if($type == "youtube") $rnr_video = "<div class='video-embed'><iframe src='http://www.youtube.com/embed/$id?HD=1;rel=0;showinfo=0' width='$width' height='$height' class='iframe'></iframe></div>";
		
	if (!empty($id)){
		return $rnr_video;
	}
}

add_shortcode('video', 'rocknrolla_video');


/*-----------------------------------------------------------------------------------*/
/*	Clients
/*-----------------------------------------------------------------------------------*/

function rocknrolla_client($atts, $content = null) {	

	extract( shortcode_atts(array(
        "logo" => '',
        "url" => '',       
        "title" => '',
		"target" => '_self'
    ), $atts) );  
    
	if($url!='') {
	   return '<a href="'. $url .'" title="'. $title .'" class="clients" target="'.$target.'"><img src="'. $logo .'" alt="'. $title .'"></a>';
	} else {
	   return '<img src="'. $logo .'" alt="'. $title .'"/>';		
	}

	return $$rnr_client;
}

add_shortcode('client', 'rocknrolla_client');

function rocknrolla_clients_box( $atts, $content = null ){

	return '<div class="client-logos">'. do_shortcode($content) .'</div>';

}

add_shortcode('clients_box', 'rocknrolla_clients_box'); 


/*-----------------------------------------------------------------------------------*/
/*	Milestone Box Shortcode
/*-----------------------------------------------------------------------------------*/
function rocknrolla_milestone_box_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "count" => '500',       
        "title" => ''
    ), $atts) );   

	$rnr_milestone_box = '<div class="milestone-counter" data-perc="'. $count .'">';
	$rnr_milestone_box .= '<span class="milestone-count highlight">'. $count .'</span>';
	$rnr_milestone_box .= '<h6 class="milestone-details">'. $title .'</h6>';
	$rnr_milestone_box .= '</div>';

    return $rnr_milestone_box;

}

add_shortcode('milestone_box', 'rocknrolla_milestone_box_shortcode');

/*-----------------------------------------------------------------------------------*/
/*	Icon Box Shortcode
/*-----------------------------------------------------------------------------------*/
  function rocknrolla_icon_box_shortcode( $atts, $content = null ){
          
    extract( shortcode_atts(array(
        "icon" => '',        
        "title" => '',
        "icon_type" => 'image',
		"color" => '',
		"background" => ''
    ), $atts) );    
	
	$id= rand();
	
	if($background || $color) {
	     $return_colors = '<style type="text/css">#service-features-'.$id.' .img-container { background : '.$background.'; } #service-features-'.$id.' .img-container i{ color: '.$color.'; } #service-features-'.$id.' .img-container:after { border-color: '.$background.'; }</style>';
	}
	else {
		$return_colors ='';
	}	

    if ( $icon_type == 'image' ) {
    	$rnr_icon_type = '<div class="img-container">';
		$rnr_icon_type .= '<img src="'. $icon .'" alt="'. $title .'">';
		$rnr_icon_type .= '</div>  ';
    }
    else {
    	$rnr_icon_type = '<div class="img-container">';
		$rnr_icon_type .= '<i class="fa '. $icon .'"></i>';
		$rnr_icon_type .= '</div>  ';
    }

	$rnr_icon_box = '<div id="service-features-'.$id.'" class="service-features">'.$return_colors;
	$rnr_icon_box .= $rnr_icon_type;
	$rnr_icon_box .= '<h3>'. $title .'</h3>                ';
	$rnr_icon_box .= '<p>'. do_Shortcode($content) .'</p>';
	$rnr_icon_box .= '</div>';

	return $rnr_icon_box;

}

add_shortcode('icon_box', 'rocknrolla_icon_box_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Pull Quote */
/*-----------------------------------------------------------------------------------*/

function rocknrolla_pullquote( $atts, $content = null){

	extract( shortcode_atts(array(
        "align" => '',  
    ), $atts) );

    if ( $align == 'right' ) 
        $alignclass = 'align-right';    
    else
    	$alignclass = 'align-left';

	$rnr_pullquote .= '<span class="pullquote ' . $alignclass . '">' . do_shortcode($content) . '</span>';
   
	return $rnr_pullquote;
}

add_shortcode('pullquote', 'rocknrolla_pullquote');

/*-----------------------------------------------------------------------------------*/
/* Block Quote */
/*-----------------------------------------------------------------------------------*/

function rocknrolla_blockquote( $atts, $content = null){

	$rnr_blockquote .= '<blockquote><p>' . do_shortcode($content) . '</p></blockquote>';
   
	return $rnr_blockquote;
}

add_shortcode('blockquote', 'rocknrolla_blockquote');

/*-----------------------------------------------------------------------------------*/
/* Parallax Quote / Testimonial Quote*/
/*-----------------------------------------------------------------------------------*/

function rocknrolla_parallaxquote( $atts, $content = null){

	extract( shortcode_atts(array(
        "author" => 'John Doe'
    ), $atts) ); 
	
	$rnr_parallaxquote = '<p class="quote"><i class="fa fa-quote-left"></i>'. do_shortcode($content)  .'<i class="fa fa-quote-right"></i></p>';
	$rnr_parallaxquote .= '<div class="quote-author">&#151; '. $author .' &#151;</div>';

	return $rnr_parallaxquote;
}

add_shortcode('parallax_quote', 'rocknrolla_parallaxquote');

/*-----------------------------------------------------------------------------------*/
/* Fancy Header */
/*-----------------------------------------------------------------------------------*/

function rocknrolla_fancy_header( $atts, $content = null){

	extract( shortcode_atts(array(
        "type" => '1',       
        "subtitle" => 'Oh yes it is!'
    ), $atts) ); 

	if ( $type == '2') {
		$rnr_fancy_header = '<div class="fancy-header2">';
		$rnr_fancy_header .= '<h4>'. do_shortcode($content) .'</h4>';
		$rnr_fancy_header .= '<h2 class="highlight">'. $subtitle .'</h2>';
		$rnr_fancy_header .= '</div>';
	}
	else if ( $type == '3')  {
		$rnr_fancy_header = '<div class="clearfix aligncenter"><div class="fancy-header1"><h2>'. do_shortcode($content) . '</h2></div></div>';
	}
	else  {
		$rnr_fancy_header = '<div class="fancy-header">';
		$rnr_fancy_header .= '<span>' . do_shortcode($content) . '</span>';
		$rnr_fancy_header .= '</div>';
	}

	return $rnr_fancy_header;
}

add_shortcode('fancy_header', 'rocknrolla_fancy_header');




/*-----------------------------------------------------------------------------------*/
/* Social Icons 
/*-----------------------------------------------------------------------------------*/

function rocknrolla_social( $atts, $content = null) {

extract( shortcode_atts( array(
      'icon' 	=> 'twitter',
      'url'		=> '#',
      'target' 	=> '_blank'
      ), $atts ) );
      
      $capital = ucfirst($icon);
      
      return '<div class="social-icon social-' . $icon . '"><a href="' . $url . '" title="' . $capital . '" target="' . $target . '">' . $capital . '</a></div>';
}

add_shortcode('social', 'rocknrolla_social');


/*-----------------------------------------------------------------------------------*/
/*	Alert Boxes
/*-----------------------------------------------------------------------------------*/

function rocknrolla_alert_boxes($atts, $content = null) {	

	extract( shortcode_atts(array(
        "message" => 'Your Message Here',       
        "type" => 'notice' // Notice, Warning, Success, Error, Info
    ), $atts) );  	

	$rnr_alerts = '<div class="alert-message '. $type .'">'. $message .'<span class="close" href="#">x</span></div>';   

	return $rnr_alerts;           

}

add_shortcode('alert_box', 'rocknrolla_alert_boxes');


/*-----------------------------------------------------------------------------------*/
/*	Skill Bar
/*-----------------------------------------------------------------------------------*/

function rocknrolla_skill_bars($atts, $content = null) {	

	extract( shortcode_atts(array(
        "percentage" => '50',       
        "title" => ''
    ), $atts) );  

	$rnr_skill = '<div class="skillbar" data-perc="'. $percentage .'">';
	$rnr_skill .= '<div class="skill-title">'. $title .'</div>';
	$rnr_skill .= '<div class="skill-percentage"></div>';
	$rnr_skill .= '</div>';

	return $rnr_skill;                  

}

add_shortcode('skill_bar', 'rocknrolla_skill_bars');


/*-----------------------------------------------------------------------------------*/
/*	Tabs
/*-----------------------------------------------------------------------------------*/

function rocknrolla_tabgroup( $atts, $content = null ) {
	$GLOBALS['tab_count'] = 0;
	$i = 1;
	$randomid = rand();

	do_shortcode( $content );

	if( is_array( $GLOBALS['tabs'] ) ){
	
		foreach( $GLOBALS['tabs'] as $tab ){	
			if( $tab['icon'] != '' ){
				$icon = '<i class="fa '.$tab['icon'].'"></i>';
			}
			else{
				$icon = '';
			}
			$tabs[] = '<li class="tab"><a href="#panel'.$randomid.$i.'">'.$icon . $tab['title'].'</a></li>';
			$panes[] = '<div class="panel" id="panel'.$randomid.$i.'"><p>'.$tab['content'].'</p></div>';
			$i++;
			$icon = '';
		}
		$return = '<div class="tabset"><ul class="tabs styled-list">'.implode( "\n", $tabs ).'</ul>'.implode( "\n", $panes ).'</div>';
	}
	$GLOBALS['tab_count'] = '';
	return $return;
}
add_shortcode( 'tabgroup', 'rocknrolla_tabgroup' );

function rocknrolla_tab( $atts, $content = null) {
	extract(shortcode_atts(array(
			'title' => '',
			'icon'  => ''
	), $atts));
	
	$x = $GLOBALS['tab_count'];
	$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'icon' => $icon, 'content' =>  do_shortcode($content) );
	$GLOBALS['tab_count']++;
}
add_shortcode( 'tab', 'rocknrolla_tab' );


/*-----------------------------------------------------------------------------------*/
/* Callout Box
/*-----------------------------------------------------------------------------------*/

function rocknrolla_callout_shortcode( $atts, $content = null ){

	extract( shortcode_atts(array(
			"title" => 'Callout Title',
			"btn_title" => 'Purchase Now',
			"btn_url" => '#',
			"target" => '_self',
		    "color"     => '',
		    "background"  => '' 
	), $atts) );

	
	if($background || $color) {
	     $return_colors = 'style="background-color:'.$background.'; color:'.$color.' !important;"';
	}
	else {
		$return_colors ='';
	}
 
	
	$rnr_callout = '<div class="callout clearfix">';
	$rnr_callout .= '<div class="callout-content">';
	$rnr_callout .= '<h3 class="highlight">'. $title .'</h3>';
	$rnr_callout .= '<p class="lead">' . do_shortcode($content) . '</p></div>';
	$rnr_callout .= '<div class="callout-button">';
	$rnr_callout .= '<a class="button large" href="'. $btn_url .'" target="'.$target.'" '.$return_colors.'>'. $btn_title .'</a>';
	$rnr_callout .= '</div>';
	$rnr_callout .= '</div>';

	return $rnr_callout;

}

add_shortcode('callout', 'rocknrolla_callout_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Toggle Item
/*-----------------------------------------------------------------------------------*/

function rocknrolla_toggle_shortcode( $atts, $content = null ){

	extract( shortcode_atts(array(
			"title" => 'Accordion Title',
			"open" => '0'
	), $atts) );  
	
	if ( $open == '1' || $open == 'yes') {
		$active = 'active';
	}
	else{
		$active = '';
	}

	$rnr_toggle_item = '<div class="toggle">';
	$rnr_toggle_item .= '<div class="toggle-title '. $active .'">';
	$rnr_toggle_item .= '<h3>';
	$rnr_toggle_item .= '<i></i>';
	$rnr_toggle_item .= '<span class="title-name">'. $title .'</span>';
	$rnr_toggle_item .= '</h3>';
	$rnr_toggle_item .= '</div>';
	$rnr_toggle_item .= '<div class="toggle-inner">';
	$rnr_toggle_item .= '<p>' . do_shortcode($content) . '</p>';
	$rnr_toggle_item .= '</div>';
	$rnr_toggle_item .= '</div><!-- END OF TOGGLE -->';

	return $rnr_toggle_item;

}

add_shortcode('toggle', 'rocknrolla_toggle_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Accordions
/*-----------------------------------------------------------------------------------*/

/* ACCORDION BLOCK */
function rocknrolla_accordion_shortcode( $atts, $content = null ){
		
	$rnr_accordion = '<div class="accordion" rel="1">  ' . do_shortcode($content) . '</div>';
	
	return $rnr_accordion;

}

add_shortcode('accordion', 'rocknrolla_accordion_shortcode');


/* ACCORDION ITEM */
function rocknrolla_accordion_item_shortcode( $atts, $content = null ){

	extract( shortcode_atts(array(
			"title" => 'Accordion Title'
	), $atts) );  
	
    $rnr_acc_item = '<div class="accordion-title">';
	$rnr_acc_item .= '<h3><span></span><a href="#">'. $title .'</a></h3>';
	$rnr_acc_item .= '</div>';
	$rnr_acc_item .= '<div class="accordion-inner">' . do_shortcode($content) . '</div>';
	
	return $rnr_acc_item;

}

add_shortcode('accordion_item', 'rocknrolla_accordion_item_shortcode');


/*-----------------------------------------------------------------------------------*/
/* Google Maps
/*-----------------------------------------------------------------------------------*/

function rocknrolla_googlemap( $atts, $content = null ){

	extract( shortcode_atts(array(
			      "width" => '100%',
				  "height" => '330px',
				  "url" => '#'
	), $atts) );  
	
	$rnr_googlemap = '<div class="rnr-google-map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'. $url .'&amp;output=embed"></iframe></div>';
	
	return $rnr_googlemap;

}

add_shortcode('map', 'rocknrolla_googlemap');

/*-----------------------------------------------------------------------------------*/
/*	Team Member
/*-----------------------------------------------------------------------------------*/

function rocknrolla_team_member( $atts, $content = null) {
	extract( shortcode_atts( array(
		'img' 	=> '',
		'name' 	=> '',
		'role'	=> '',
		'viewprofile' => 'yes',
		'link_title' => 'View Profile',
		'size'  =>  ""
    ), $atts ) );

$randomid = rand();

$rnr_team_member  = '<div class="team-member team-' .$size. '">';
$rnr_team_member .= '<div class="team-thumb img-wrp">';
$rnr_team_member .= '<img src="'. $img .'" class="team-image" alt="'. $name .'" />';
$rnr_team_member .= '<div class="team-overlay">';
$rnr_team_member .= '<div class="img-overlay"></div>';
$rnr_team_member .= '<div class="overlay-content"> ';                           
$rnr_team_member .= '<h4>'. $role .'</h4>';

if($viewprofile=="yes"){
$rnr_team_member .= '<p><a data-toggle="modal" href="#team-'.$randomid.'" class="modal-popup-link view-profile">'.$link_title.'</a></p>';
}

$rnr_team_member .= '</div>';
$rnr_team_member .= '</div>';
$rnr_team_member .= '</div>';


$rnr_team_member .= '<div class="team-desc">';
$rnr_team_member .= '<h4>'. $name .'</h4>';
$rnr_team_member .= '</div>';
if($viewprofile=="yes"){
	  $rnr_team_member .= '<div id="team-'.$randomid.'" class="modal hide fade.in animated fadeIn">';
	  $rnr_team_member .= '<div class="member-bio">';
	  $rnr_team_member .= '<div class="container">';  
	  $rnr_team_member .= '<a href="#" class="close" data-dismiss="modal">×</a>';
	  $rnr_team_member .= '<div class="member-role">';
	  $rnr_team_member .= '<h1>'. $name .'</h1>';
	  $rnr_team_member .= '<h4 class="highlight">'. $role .'</h4>';
	  $rnr_team_member .= '</div>';
	  $rnr_team_member .= '<div class="row">';
	  $rnr_team_member .= '<div class="seven columns">';
	  $rnr_team_member .= '<img src="'. $img .'" class="team-image" alt="'. $name .'" />';
	  $rnr_team_member .= ' </div>';
	  $rnr_team_member .= '<div class="nine columns member-description">'.do_shortcode($content).'</div> ';
	  $rnr_team_member .= '</div>';
	  $rnr_team_member .= '</div>';
	  $rnr_team_member .= '</div>';                 
	  $rnr_team_member .= '</div>';                   

}
	  $rnr_team_member .= '</div>';  

return $rnr_team_member;

}

add_shortcode('team_member', 'rocknrolla_team_member');


/*-----------------------------------------------------------------------------------*/
/*	Columns
/*-----------------------------------------------------------------------------------*/
function rocknrolla_one_third( $atts, $content = null ) {

   return '<div class="one_third">' . do_shortcode($content) . '</div>';
}

function rocknrolla_one_third_last( $atts, $content = null ) {
   return '<div class="one_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_two_third( $atts, $content = null ) {
   return '<div class="two_third">' . do_shortcode($content) . '</div>';
}

function rocknrolla_two_third_last( $atts, $content = null ) {
   return '<div class="two_third last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_one_half( $atts, $content = null ) {
   return '<div class="one_half">' . do_shortcode($content) . '</div>';
}

function rocknrolla_one_half_last( $atts, $content = null ) {
   return '<div class="one_half last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_one_fourth( $atts, $content = null ) {
   return '<div class="one_fourth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_one_fourth_last( $atts, $content = null ) {
   return '<div class="one_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_three_fourth( $atts, $content = null ) {
   return '<div class="three_fourth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_three_fourth_last( $atts, $content = null ) {
   return '<div class="three_fourth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_one_fifth( $atts, $content = null ) {
   return '<div class="one_fifth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_one_fifth_last( $atts, $content = null ) {
   return '<div class="one_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_two_fifth( $atts, $content = null ) {
   return '<div class="two_fifth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_two_fifth_last( $atts, $content = null ) {
   return '<div class="two_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_three_fifth( $atts, $content = null ) {
   return '<div class="three_fifth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_three_fifth_last( $atts, $content = null ) {
   return '<div class="three_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_four_fifth( $atts, $content = null ) {
   return '<div class="four_fifth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_four_fifth_last( $atts, $content = null ) {
   return '<div class="four_fifth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_one_sixth( $atts, $content = null ) {
   return '<div class="one_sixth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_one_sixth_last( $atts, $content = null ) {
   return '<div class="one_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

function rocknrolla_five_sixth( $atts, $content = null ) {
   return '<div class="five_sixth">' . do_shortcode($content) . '</div>';
}

function rocknrolla_five_sixth_last( $atts, $content = null ) {
   return '<div class="five_sixth last">' . do_shortcode($content) . '</div><div class="clear"></div>';
}

add_shortcode('one_third', 'rocknrolla_one_third');
add_shortcode('one_third_last', 'rocknrolla_one_third_last');
add_shortcode('two_third', 'rocknrolla_two_third');
add_shortcode('two_third_last', 'rocknrolla_two_third_last');
add_shortcode('one_half', 'rocknrolla_one_half');
add_shortcode('one_half_last', 'rocknrolla_one_half_last');
add_shortcode('one_fourth', 'rocknrolla_one_fourth');
add_shortcode('one_fourth_last', 'rocknrolla_one_fourth_last');
add_shortcode('three_fourth', 'rocknrolla_three_fourth');
add_shortcode('three_fourth_last', 'rocknrolla_three_fourth_last');
add_shortcode('one_fifth', 'rocknrolla_one_fifth');
add_shortcode('one_fifth_last', 'rocknrolla_one_fifth_last');
add_shortcode('two_fifth', 'rocknrolla_two_fifth');
add_shortcode('two_fifth_last', 'rocknrolla_two_fifth_last');
add_shortcode('three_fifth', 'rocknrolla_three_fifth');
add_shortcode('three_fifth_last', 'rocknrolla_three_fifth_last');
add_shortcode('four_fifth', 'rocknrolla_four_fifth');
add_shortcode('four_fifth_last', 'rocknrolla_four_fifth_last');
add_shortcode('one_sixth', 'rocknrolla_one_sixth');
add_shortcode('one_sixth_last', 'rocknrolla_one_sixth_last');
add_shortcode('five_sixth', 'rocknrolla_five_sixth');
add_shortcode('five_sixth_last', 'rocknrolla_five_sixth_last');



/*-----------------------------------------------------------------------------------*/
/* Align Center
/*-----------------------------------------------------------------------------------*/

function rocknrolla_align_center( $atts, $content = null ) {
   return '<div class="aligncenter">' . do_shortcode($content) . '</div>';
}

add_shortcode('center', 'rocknrolla_align_center');


/*-----------------------------------------------------------------------------------*/
/* Preformatted Boxes
/*-----------------------------------------------------------------------------------*/

function rocknrolla_pre_box( $atts, $content = null ){	

return '<pre>' . $content . '</pre>';

}

add_shortcode('pre', 'rocknrolla_pre_box');

/*-----------------------------------------------------------------------------------*/
/*	Br-Tag
/*-----------------------------------------------------------------------------------*/

function rocknrolla_br() {
   return '<br />';
}

 add_shortcode('br', 'rocknrolla_br');



/*-----------------------------------------------------------------------------------*/
/*	Space Dividers
/*-----------------------------------------------------------------------------------*/

function rocknrolla_space( $atts, $content = null) {

extract( shortcode_atts( array(
      'height' 	=> '30'
      ), $atts ) );
      
      if($height == '') {
		  $rnr_space_height = '';
	  }
	  else{
		  $rnr_space_height = 'style="height: '.$height.'px;"';
	  }
      
      return '<div class="space" ' . $rnr_space_height . '></div>';
}

add_shortcode('space', 'rocknrolla_space');

/*-----------------------------------------------------------------------------------*/
/*	Clear-Tag
/*-----------------------------------------------------------------------------------*/

function rocknrolla_clear() {  
    return '<div class="clear"></div>';  
}

add_shortcode('clear', 'rocknrolla_clear');

/*-----------------------------------------------------------------------------------*/
/*	Custom Typography 
/*-----------------------------------------------------------------------------------*/

function rocknrolla_typography( $atts, $content = null) {
extract( shortcode_atts( array(
      	'font' => 'Oswald',
      	'size' => '42px',
      	'margin' => '0px',
      	'weight' => '400'
      ), $atts ) );
	  
	  global $rocknrolla_fonts_regular;
	  
	  if(!in_array($font,$rocknrolla_fonts_regular)) {
	  
      $google = preg_replace("/ /","+",$font);
      
     $typography = '<link href="http://fonts.googleapis.com/css?family='.$google.'" rel="stylesheet" type="text/css">';
	 
	  } else { $typography = '';}
      		return	$typography.'<div class="custom-typography" style="font-family:\'' .$font. '\', serif !important; font-size:' .$size. ' !important; margin: ' .$margin. ' !important; font-weight:' .$weight .'">' . do_shortcode($content) . '</div>';

}

add_shortcode('typography', 'rocknrolla_typography');


/*-----------------------------------------------------------------------------------*/
/* Highlight
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_highlight( $atts, $content = null ) {	

   return '<span class="highlight">'. do_shortcode($content) . '</span>';  

}

add_shortcode('highlight', 'rocknrolla_highlight');



/*-----------------------------------------------------------------------------------*/
/*	Home 1
/*-----------------------------------------------------------------------------------*/

function rocknrolla_home_callout($atts, $content = null) {	
	

	$rnr_home_callout = '<div class="container clearfix home1">
					<div class="home-quote">
					  <h1>'. do_shortcode($content) . '</h1>
					</div>
				 </div>';   

	return $rnr_home_callout;           

}

add_shortcode('home_callout', 'rocknrolla_home_callout');

/*-----------------------------------------------------------------------------------*/
/* Home 1 lines
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_home_callout_lines( $atts, $content = null ) {	

	extract( shortcode_atts(array(
        "bg_highlight" => 'false',
        "highlight" => 'false',		
    ), $atts) );  
	
	$child='';
	$child2='';
	
	if($bg_highlight=='true') {
		$child = 'second-child';
	}
	
	if($highlight=='true') {
		$child2 = 'highlight';
	}	

   return '<span class="slabtext '.$child.' '.$child2.'">'. do_shortcode($content) . '</span>';  

}

add_shortcode('home_callout_line', 'rocknrolla_home_callout_lines');



/*-----------------------------------------------------------------------------------*/
/*	Home 2
/*-----------------------------------------------------------------------------------*/

function rocknrolla_home_textslides($atts, $content = null) {	


	$rnr_home_callout = '<div id="home-slider" class="flexslider">			
                          <ul class="slides styled-list">'. do_shortcode($content) . '</ul>
					   </div>';   

	return $rnr_home_callout;           

}

add_shortcode('home_textslides', 'rocknrolla_home_textslides');

/*-----------------------------------------------------------------------------------*/
/* Home 2 slides
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_home_textslide( $atts, $content = null ) {	

   return '<li class="home-slide"><p class="home-slide-content">'. do_shortcode($content) . '</p></li>';  

}

add_shortcode('textslide', 'rocknrolla_home_textslide');



/*-----------------------------------------------------------------------------------*/
/*	Home 3 circle text
/*-----------------------------------------------------------------------------------*/

function rocknrolla_home_circle_callout($atts, $content = null) {	


	$rnr_home_callout = '<div class="home3">
						  <div class="container clearfix">
							<div class="home-quote">
							  <h1>'. do_shortcode($content) . '</h1>
							</div>
						  </div>
						 </div>';   

	return $rnr_home_callout;           

}

add_shortcode('home_circle_callout', 'rocknrolla_home_circle_callout');

/*-----------------------------------------------------------------------------------*/
/* Home 3 lines
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_home_circle_callout_lines( $atts, $content = null ) {	

	extract( shortcode_atts(array(
        "bg_highlight" => 'false',
        "highlight" => 'false',		
    ), $atts) );  
	
	$child = '';
	$child2 = '';
	
	if($bg_highlight=='true') {
		$child = 'second-child';
	}
	
	if($highlight=='true') {
		$child2 = 'highlight';
	}	

   return ' <span class="slabtext '.$child.' '.$child2.'">'. do_shortcode($content) . '</span>';  

}

add_shortcode('home_circle_callout_line', 'rocknrolla_home_circle_callout_lines');


/*-----------------------------------------------------------------------------------*/
/*	Home 4
/*-----------------------------------------------------------------------------------*/

function rocknrolla_home_callout2($atts, $content = null) {	


	$rnr_home_callout = '<div class="home4">
						  <div class="container clearfix">
							<div class="home-quote">
							  <h1>'. do_shortcode($content) . '</h1>
							</div>
						  </div>
						 </div>';   

	return $rnr_home_callout;           

}

add_shortcode('home_callout2', 'rocknrolla_home_callout2');

/*-----------------------------------------------------------------------------------*/
/* Home 4 lines
/*-----------------------------------------------------------------------------------*/	
function rocknrolla_home_callout2_lines( $atts, $content = null ) {	

	extract( shortcode_atts(array(
        "bg_highlight" => 'false',
        "highlight" => 'false',		
    ), $atts) );  
	$child = '';
	$child2 = '';
	
	if($bg_highlight=='true') {
		$child = 'second-child';
	}
	
	if($highlight=='true') {
		$child2 = 'highlight';
	}	

   return ' <span class="slabtext '.$child.' '.$child2.'">'. do_shortcode($content) . '</span>';  

}

add_shortcode('home_callout2_line', 'rocknrolla_home_callout2_lines');	

            


/*-----------------------------------------------------------------------------------*/
/*	Lists
/*-----------------------------------------------------------------------------------*/

function rocknrolla_list( $atts, $content = null ) {
    extract(shortcode_atts(array(), $atts));
	$rnr_lists = '<ul class="styled-list">'. do_shortcode($content) . '</ul>';
    return $rnr_lists;
}

/*-----------------------------------------------------------------------------------*/

function rocknrolla_list_item( $atts, $content = null ) {
	extract(shortcode_atts(array(
       	"icon"      => '',
		"color" => ''
    ), $atts));
	
		if($color) {
	     $return_colors = 'style="color:'.$color.' !important;"';
	}
	$rnr_list_item = '<li><i class="fa '.$icon.'" '.$return_colors.'></i>'. do_shortcode($content) . '</li>';
    return $rnr_list_item;
}


add_shortcode('list', 'rocknrolla_list');
add_shortcode('list_item', 'rocknrolla_list_item');




/*-----------------------------------------------------------------------------------*/
/*	FlexSlider
/*-----------------------------------------------------------------------------------*/

function rocknrolla_flexslider( $atts, $content = null ) {
    extract(shortcode_atts(array(), $atts));
	$rnr_slider = '<div class="flexslider section-slider clearfix"><ul class="slides">'. do_shortcode($content) . '</ul></div>';
    return $rnr_slider;
}

/*-----------------------------------------------------------------------------------*/

function rocknrolla_flexslider_slide( $atts, $content = null ) {
	extract(shortcode_atts(array(
	    "url" => '',
       	"image_url"  => '',
		"lightbox" => ''
		
		
    ), $atts));

    if($lightbox=="true") {
    	$return_lightbox = 'data-rel="prettyPhoto" ';
    }
    else{
    	$return_lightbox = '';
    }
	
	if($url) {
	     $rnr_slide = '<li><a href="'.$url.'" '.$return_lightbox.'><img src="'. $image_url . '"/></a></li>';
	}
	else {
		$rnr_slide = '<li><img src="'. $image_url . '"/></li>';
	}
    return $rnr_slide;
}


add_shortcode('image_slider', 'rocknrolla_flexslider');
add_shortcode('image_slide', 'rocknrolla_flexslider_slide');

/*-----------------------------------------------------------------------------------*/
/*	Latest Blog
/*-----------------------------------------------------------------------------------*/

function rocknrolla_blog($atts){
	extract(shortcode_atts(array(
       	'posts'      => '4',
       	'categories' => 'all',
		'columns'  =>  '4',
		'excerpt_size' => '15'
    ), $atts));
    
    global $post;
	$blog_post_type = '';

	$args = array(
		'post_type' => 'post',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	//var_dump($arr);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts( $args );
    $out = '';
    
		if($columns == '3'){
			$return = 'one_third';
			$image_grid = 'span4';
		}
		elseif($columns == '2'){
			$return = 'one_half';
			$image_grid = 'span6';
		}
		else{
			$return = 'one_fourth';
			$image_grid = 'span3';
		}
		
		
   

	if( have_posts() ) :
	$count = 0;

    	$out .= '<div class="latest-blog row"><ul class="styled-list">';	
		
		while ( have_posts() ) : the_post();
		$count++;

		if($count%$columns=='0' && $count!='1') {
			$last = 'last';
		} else {
			$last = '';
		}
			
			$out .= '<li class="blog-item '. $return .' '.$last.'">';
			$out .= '<div class="inner"><div class="blog">';			
			
			if ( has_post_thumbnail()) {
				$blog_thumbnail= wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), $image_grid );
				$out .= '<a href="'.get_permalink().'" title="' . get_the_title() . '" class="blog-image"><img src="'.$blog_thumbnail[0].'" /><div class="blog-overlay">';
				
					if ( has_post_format( 'audio' )) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon audio"></div>';
					}
					if ( has_post_format( 'gallery' )) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon imagegallery"></div>';						
					}
					if ( has_post_format( 'link' )) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon link"></div>';						
					}
					if ( has_post_format( 'quote' )) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon quote"></div>';						
					}
					if ( has_post_format( 'video' )) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon video"></div>';						
					}
					if ( get_post_format() == false ) {
						$out .= '<div class="thumb-info"><i class="fa fa-plus"></i></div>';
						$blog_post_type='<div class="desc post-icon standard"></div>';						
					}
				
				$out .= '</div></a></div>';
			}
			
			$out .= '<div class="blog-item-description">
			            '.$blog_post_type.'<div class="post-details"> 
						<a href="'.get_permalink().'" title="' . get_the_title() . '"><h4>'.get_the_title() .'</h4></a>
						<span class="date">'.get_the_time('d').' '.get_the_time('M').' </span><span class="post-comments">'.get_comments_number().' '.__( 'Comments', 'rocknrolla' ) .'</span>
						<p>'.rocknrolla_limit_words(get_the_excerpt(), $excerpt_size).'</p><p><a href="'. get_permalink($post->ID) . '" class="read-more-link">' . '' . __('Read More', 'rocknrolla') . ' &rarr;' . '</a></p>
						</div>
						
					</div>';
		
		    $out .='</div></li>';
			
		endwhile;
		
		$out .='</ul></div><div class="clear"></div>';
		
		
		
		 wp_reset_query();
	
	endif;

	return $out;
}
add_shortcode('blog', 'rocknrolla_blog');

?>