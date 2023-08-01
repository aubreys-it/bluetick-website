<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package _bluetick
 */

if ( ! function_exists( '_bluetick_body_classes' ) ) {
	/**
	 * Adds custom classes to the array of body classes.
	 *
	 * @param array $classes Classes for the body element.
	 *
	 * @return array
	 */
	function _bluetick_body_classes( $classes ) {
		// Adds a class of group-blog to blogs with more than 1 published author.
		if ( is_multi_author() ) {
			$classes[] = 'group-blog';
		}
		// Adds a class of hfeed to non-singular pages.
		if ( ! is_singular() ) {
			$classes[] = 'hfeed';
		}

		return $classes;
	}
}
add_filter( 'body_class', '_bluetick_body_classes' );

// Removes tag class from the body_class array to avoid Bootstrap markup styling issues.
add_filter( 'body_class', 'adjust_body_class' );

if ( ! function_exists( 'adjust_body_class' ) ) {
	/**
	 * Setup body classes.
	 *
	 * @param string $classes CSS classes.
	 *
	 * @return mixed
	 */
	function adjust_body_class( $classes ) {

		foreach ( $classes as $key => $value ) {
			if ( 'tag' == $value ) {
				unset( $classes[ $key ] );
			}
		}

		return $classes;

	}
}

// Filter custom logo with correct classes.
add_filter( 'get_custom_logo', 'change_logo_class' );

if ( ! function_exists( 'change_logo_class' ) ) {
	/**
	 * Replaces logo CSS class.
	 *
	 * @param string $html Markup.
	 *
	 * @return mixed
	 */
	function change_logo_class( $html ) {

		$html = str_replace( 'class="custom-logo"', 'class="img-fluid"', $html );
		$html = str_replace( 'class="custom-logo-link"', 'class="navbar-brand custom-logo-link"', $html );
		$html = str_replace( 'alt=""', 'title="Home" alt="logo"' , $html );

		return $html;
	}
}

/**
 * Display navigation to next/previous post when applicable.
 */
if ( ! function_exists( '_bluetick_post_nav' ) ) :

	function _bluetick_post_nav() {
		// Don't print empty markup if there's nowhere to navigate.
		$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
		$next     = get_adjacent_post( false, '', false );

		if ( ! $next && ! $previous ) {
			return;
		}
		?>
				<nav class="container navigation post-navigation">
					<h2 class="sr-only"><?php _e( 'Post navigation', '_bluetick' ); ?></h2>
					<div class="row nav-links justify-content-between">
						<?php

							if ( get_previous_post_link() ) {
								previous_post_link( '<span class="nav-previous">%link</span>', _x( '<i class="fa fa-angle-left"></i>&nbsp;%title', 'Previous post link', '_bluetick' ) );
							}
							if ( get_next_post_link() ) {
								next_post_link( '<span class="nav-next">%link</span>',     _x( '%title&nbsp;<i class="fa fa-angle-right"></i>', 'Next post link', '_bluetick' ) );
							}
						?>
					</div><!-- .nav-links -->
				</nav><!-- .navigation -->

		<?php
	}
endif;



function remove_evil_slugs($post_link, $post, $leavename) {

    if('locations' != $post->post_type ||'publish' != $post->post_status) {
        return $post_link;
    }

    $post_link = str_replace('/' . $post->post_type . '/', '/', $post_link);

    return $post_link;
}
//add_filter('post_type_link', 'remove_evil_slugs', 10, 3);

function  parse_evil_slugs($query) {

    if(!$query->is_main_query() || 2 != count($query->query) || !isset($query->query['page'])) {
        return;
    }

    if(!empty($query->query['name'])) {
        $query->set('post_type', array('post', 'locations', 'page'));
    }
}
//add_action('pre_get_posts', 'parse_evil_slugs');

add_action('nav_menu_css_class', 'add_current_nav_class', 10, 2 );
	
function add_current_nav_class($classes, $item) {
	
	// Getting the current post details
	global $post;
	
	// Getting the post type of the current post
	$current_post_type = get_post_type_object(get_post_type($post->ID));
	$current_post_type_slug = $current_post_type->rewrite['slug'];
		
	// Getting the URL of the menu item
	$menu_slug = strtolower(trim($item->url));
	
	// If the menu item URL contains the current post types slug add the current-menu-item class
	if (strpos($menu_slug,$current_post_type_slug) !== false) {
	
	   $classes[] = 'current-menu-item';
	
	}
	
	// Return the corrected set of classes to be added to the menu item
	return $classes;

}

// add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10, 3 );

// function remove_thumbnail_dimensions( $html, $post_id, $post_image_id ) {
//     $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
//     return $html;
// }

// function remove_image_size_attributes( $html ) {
// return preg_replace( '/(width|height)="\d*"/', '', $html );
// }

// // Remove image size attributes from post thumbnails
// add_filter( 'post_thumbnail_html', 'remove_image_size_attributes' );

// // Remove image size attributes from images added to a WordPress post
// add_filter( 'image_send_to_editor', 'remove_image_size_attributes' );

add_filter( 'post_thumbnail_html', 'remove_size_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_size_attribute', 10 );
function remove_size_attribute( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

function location_map_publish( $post_id, $post, $update) {
    global $post;
    
    if ( $_POST['page_template'] == 'page-templates/neighborhood.php' )
    {      
          $repeater1  = 'location_map_types';
          $repeater2  = 'type_list';
          $latitude = 'item_latitude'; 
          $longitude = 'item_longitude'; 
          $address= 'item_address';
        
          // get the number of rows in the repeater
          $count1 = intval(get_post_meta($post_id, $repeater1, true));

          // loop through the rows
          for ($i=0; $i<$count1; $i++) {
      
            $count2 = intval(get_post_meta($post_id, $repeater1.'_'.$i.'_'.$repeater2, true));

            for ($j=0; $j<$count2; $j++) {
                $address_array = $repeater1.'_'.$i.'_'.$repeater2.'_'.$j.'_'.$address;
                $address_value = get_post_meta($post_id, $address_array, true);
                
                $latitude_array = $repeater1.'_'.$i.'_'.$repeater2.'_'.$j.'_'.$latitude;
                $longitude_array = $repeater1.'_'.$i.'_'.$repeater2.'_'.$j.'_'.$longitude;

                $new_address = urlencode($address_value);
                //echo '<br>$new_address = '.$new_address;
                $geocode_request = 'https://maps.googleapis.com/maps/api/geocode/json?key=AIzaSyB0SiBenSmzW8V8mEIY__LIz9C8GIexnq8&address=' . $new_address;
                $response = wp_remote_get( $geocode_request );
                $obj = json_decode($response['body'], true);
                $location = $obj["results"][0]['geometry']['location'];
                update_post_meta($post_id, $latitude_array, $location['lat']);
                update_post_meta($post_id, $longitude_array, $location['lng']);                
            }              
            
        }
    }
    else
    {
        return;
    }    
}
//add_action( 'save_post',  'location_map_publish', 10, 3 );

session_start();

function generateFormToken($form) {
    
       // generate a token from an unique value
    	$token = md5(uniqid(microtime(), true));  
    	
    	// Write the generated token to the session variable to check it against the hidden field when the form is sent
    	$_SESSION[$form.'_token'] = $token; 
    	
    	return $token;

}

function verifyContactFormToken($form) {
    
    // check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) { 
		return false;
    }
	
	// check if the form is sent with token in it
	if(!isset($_POST['contact_token'])) {
		return false;
    }
	
	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $_POST['contact_token']) {
		return false;
    }
	
	return true;
}

function verifyLeaseFormToken($form) {
    
    // check if a session is started and a token is transmitted, if not return an error
	if(!isset($_SESSION[$form.'_token'])) { 
		return false;
    }
	
	// check if the form is sent with token in it
	if(!isset($_POST['lease_token'])) {
		return false;
    }
	
	// compare the tokens against each other if they are still the same
	if ($_SESSION[$form.'_token'] !== $_POST['lease_token']) {
		return false;
    }
	
	return true;
}

add_action( 'wp_ajax_send_contact_form', 'send_contact_form' );
add_action( 'wp_ajax_nopriv_send_contact_form', 'send_contact_form' );
function send_contact_form() {

	if (verifyContactFormToken('contact_form')) {

	   if(isset($_POST['hiddenRecaptcha'])) {
     
	         $email_to = "csarvis@matrixresidential.com";
	         //$email_to = "robb@visual23.com";

	         $email_subject = "‐‐New Email Lead For Olea at Viera‐‐";

	        $first_name = $_POST['FirstName']; // not required
	        $last_name = $_POST['LastName']; // not required
	        $email_from = $_POST['EmailAddr']; // required
	        $phone_number = $_POST['PhoneNumber']; // required        
	        $move_in_date = $_POST['MoveInDate']; // not required
	        $bedrooms = $_POST['Bedrooms']; // not required
	        $pets = $_POST['Pets']; // not required
	        $how_did_you_hear_about_us = $_POST['HowDidYouHearAboutUs']; // not required	        
	        $message = $_POST['Message']; // not required

	        $email_message = "I'm interested in more information about Olea at Viera!\n\n";
  	
  			function clean_string($string) {
	          $bad = array("content-type","bcc:","to:","cc:","href");
	          return str_replace($bad,"",$string);
	        } 

	         $email_message .= "First Name: ".clean_string($first_name)."\n"; 
	        $email_message .= "Last Name: ".clean_string($last_name)."\n";
	        $email_message .= "Address: "."\n";
	        $email_message .= "Address2: "."\n";
	        $email_message .= "City: "."\n";
	        $email_message .= "State: "."\n";
	        $email_message .= "Zip: "."\n";
	        $email_message .= "Home Phone: ".clean_string($phone_number)."\n";
	        $email_message .= "Cell Phone: "."\n";
	        $email_message .= "Work Phone: "."\n";
	        $email_message .= "Email Address: ".clean_string($email_from)."\n";        
	        $email_message .= "Lead Channel: "."\n";
	        $email_message .= "Lead Priority: "."\n";
	        $email_message .= "Desired Move In: ".clean_string($move_in_date)."\n";
	        $email_message .= "Desired Lease Term: "."\n";
	        $email_message .= "Desired Unit Type: "."\n";
	        $email_message .= "Desired Bedrooms: ".clean_string($bedrooms)."\n";
	        $email_message .= "Desired Bathrooms: "."\n";
	        $email_message .= "Pets: ".clean_string($pets)."\n";
	        $email_message .= "Pet Types: "."\n";
	        $email_message .= "How did you hear about us?: ".clean_string($how_did_you_hear_about_us)."\n";
	        $email_message .= "Comments: ".clean_string($message)."\n";


	        $to = $email_to;
			$subject = $email_subject;
			$txt = $email_message;
			$headers = "From: ".$email_from;
			mail($to,$subject,$txt,$headers);
	        
	        // A default response holder, which will have data for sending back to our js file
		    $response = array(
		    	'error' => false,
		    );
		 	$response['success_message'] = 'Form Sent'; 
		 	exit(json_encode($response));
	   //      //return true;
	    }
	    else
	    {
	        return false;
	    }

	} else {
	   
	   echo "Hack-Attempt detected. Got ya!.";
	   //writeLog('Formtoken');
	   return false;

	}
}

