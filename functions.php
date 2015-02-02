<?php

// Update Addresses in General Settings manually, after DB Import
update_option('siteurl','http://127.0.0.1/bcl/');
update_option('home','http://127.0.0.1/bcl/');


/*
Example:

To save some data into the session

$_SESSION['myKey'] = "Some data I need later";
And to get that data out at a later time

if(isset($_SESSION['myKey'])) {
    $value = $_SESSION['myKey'];
} else {
    $value = '';
}
*/


// remove wp header junk, Wordpress 3.0+

remove_action( 'wp_head', 'feed_links', 2 );					// Display the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links_extra', 3 );				// Display the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'rsd_link' ); 						// Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'wlwmanifest_link' ); 				// Display the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'index_rel_link' ); 					// index link
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); 	// Display relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'wp_generator' );						// Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 		// prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); 		// start link
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

// disable the admin bar
show_admin_bar(false);

// disable auto p
//remove_filter ('the_content',  'wpautop');

// --> are converted into em-dash by wptexturize, therefore HTML comments would not work
remove_filter( 'the_content', 'wptexturize' );

// Add Main Menu
function register_navigation_menu() {
  register_nav_menu('header-menu',__( 'Navigation Menu' ));
}
add_action( 'init', 'register_navigation_menu' );


// Define Image Sizes
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size('project-thumb', 300, 300, true );		//(cropped)   ...remove
	add_image_size('square300', 300, 300, true );		 	//(cropped)
	add_image_size('square500', 500, 500, true ); 			//(cropped)
	add_image_size('cinemascope', 1024, 576, true ); 		//(cropped)
	add_image_size('small_cinemascope', 512, 288, true ); 	//(cropped)
}





$menuPages = array('projects', 'about', 'contact', 'journal', 'recherche', 'texts', 'front');

function getPages() {
	global $post, $menuPages;
	$html = "";
	foreach ($menuPages as $name) {
		$page = get_page_by_title($name);
		if ($post->ID == $page->ID) {
			$html .= "<li class=\"active\"><a href=\"" . get_permalink($page->ID) . "\">$page->post_title</a></li>\n";
		} else {
			$html .= "<li><a href=\"" . get_permalink($page->ID) . "\">$page->post_title</a></li>\n";
		}		
	}
	echo $html;
}


// Get Advanced Custom Fields, Text
function showText($key) {
	global $post;
	$text = get_field($key, $post->ID);
	if ($text) echo "$text\n";
}

// Get Advanced Custom Fields, Image
function showImage($key, $size='medium') {
	global $post;
	$image = get_field($key, $post->ID);
	if ($image) echo "<img src='".$image['sizes'][$size]."' width='100%'>\n";
}






// Custom Event Post Type
add_action( 'init', 'create_event_post_type' );

function create_event_post_type() {
	register_post_type( 
		'bcl_events',
		array(
			'labels' => array(
				'name' => __( 'Events' ),
				'singular_name' => __( 'Event' ),
				'all_items' => __( 'All Events' ),
			),
			'has_archive' => true,
			'public' => true,
			'rewrite' => array('slug' => 'events'),
			'taxonomies' => array('bcl_events_type'),
		//	'exclude_from_search' => true,
		//	'supports' => array( 'title', 'editor', 'thumbnail' ),
			'query_var' => true,
		)
	);
	register_taxonomy(
		'bcl_events_type',
		'bcl_events',
		array(
			'label' => __( 'Event Type' ),
			'rewrite' => array( 'slug' => 'type'),
			'hierarchical' => true,		// true -> like category, false -> like tags
			'show_admin_column' => true,
			'query_var' => true,
			'labels' => array(
				'add_new_item' => __( 'Add New Event Type' ),
				'edit_item' => __( 'Edit Event Type' ),
			)
		)
	);
}




?>