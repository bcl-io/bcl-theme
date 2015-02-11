<?php

/*
// Update Addresses in General Settings manually, after DB Import
update_option('siteurl','http://127.0.0.1/bcl/');
update_option('home','http://127.0.0.1/bcl/');
*/

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
	
	// Projects
	register_post_type( 
		'bcl_projects',
		array(
			'labels' => array(
				'name' => __( 'Projects' ),
				'singular_name' => __( 'Project' ),
				'all_items' => __( 'All Projects' ),
			),
			'has_archive' => false,
			'public' => true,
			'rewrite' => array('slug' => 'projects'),
			'taxonomies' => array('bcl_projects_category'),
		//	'exclude_from_search' => true,
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'custom-fields', 'post-formats' ),
			'query_var' => true,
		)
	);
	register_taxonomy(
		'bcl_projects_category',
		'bcl_projects',
		array(
			'label' => __( 'Project Category' ),
			'rewrite' => array( 'slug' => 'type'),
			'hierarchical' => true,		// true -> like category, false -> like tags
			'show_admin_column' => true,
			'query_var' => true,
			'labels' => array(
				'add_new_item' => __( 'Add New Project Category' ),
				'edit_item' => __( 'Edit Project Category' ),
			)
		)
	);
	
	// Events
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


// bcl custom image sizes
add_image_size('bcl-preview-4-3', 640, 480, true);
add_image_size('bcl-preview-3-2', 720, 480, true);
add_image_size('bcl-preview-16-9', 640, 360, true);
add_image_size('bcl-standard-4-3', 1280, 960, true);
add_image_size('bcl-standard-3-2', 1440, 960, true);
add_image_size('bcl-standard-16-9', 1280, 720, true);




// Bones

require_once( 'library/navwalker.php' ); //needed for bootstrap navigation


// Custom metaboxes and fields
// https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );
function be_initialize_cmb_meta_boxes() {
  if ( !class_exists( 'cmb_Meta_Box' ) ) {
    require_once( 'library/metabox/init.php' );
  }
}

// Redux Framework.  Needed for custom options in admin panel
// https://github.com/twittem/wp-bootstrap-navwalker
// WIP.  Uncomment if you wish to use.
/*
if(!class_exists('ReduxFramework')){
    require_once(dirname(__FILE__) . '/library/admin/framework.php');
}
require_once(dirname(__FILE__).'/library/option-config.php');
*/


/* library/bones.php (functions specific to BREW)
  - navwalker
  - Redux framework
  - Read more > Bootstrap button
  - Bootstrap style pagination
  - Bootstrap style breadcrumbs
*/
require_once( 'library/brew.php' ); // if you remove this, BREW will break
/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
// require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
/*
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );
*/
/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));


// add footer widgets

  register_sidebar(array(
    'id' => 'footer-1',
    'name' => __( 'Footer Widget 1', 'bonestheme' ),
    'description' => __( 'The first footer widget.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget widgetFooter %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-2',
    'name' => __( 'Footer Widget 2', 'bonestheme' ),
    'description' => __( 'The second footer widget.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget widgetFooter %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'footer-3',
    'name' => __( 'Footer Widget 3', 'bonestheme' ),
    'description' => __( 'The third footer widget.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget widgetFooter %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

    register_sidebar(array(
    'id' => 'footer-4',
    'name' => __( 'Footer Widget 4', 'bonestheme' ),
    'description' => __( 'The fourth footer widget.', 'bonestheme' ),
    'before_widget' => '<div id="%1$s" class="widget widgetFooter %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=64" class="load-gravatar avatar avatar-48 photo" height="64" width="64" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!


?>
