<?php 
/*
Template Name: About
*/

get_header(); 

// edit_post_link('*');

// Events Menu
/* Add walker to provide class names to each level of the nav menu. This allows the third level and more to be hidden */
// UL_Class_Walker now extents Strip_Category_URL_Walker to gain _category or _tag replacing function
$eventsList = array();

// Get the events menu
class BCL_Events_Walker_Nav_Menu extends Walker_Nav_Menu {
	// copied from wp-includes/nav-menu-template.php
	function start_el( &$output, $item, $depth = 3, $args = array(), $id = 0 ) {
		global $wp_query, $eventsList;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$eventsList[] = $item->title;	// add event titles to list
		$output .= $indent . '<li>';
		$href = " href=\"#" . sanitize_title($item->title) . "\"";		// anchor links
		$attributes .= $href;
		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}

$args = array(
	'theme_location'  => '',
	'menu'            => 'Events',
	'container'       => '',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => 'menu',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul class="menu">%3$s</ul>',
	'depth'           => 0,
	'walker'          => new BCL_Events_Walker_Nav_Menu(),
);



function showEvents() {
	global $eventsList;
	// loop over events categories
	foreach($eventsList as $title) {
	
?>
<div class="row event">
	<div class="col-xs-2 text-right date"></div>
	<div class="col-xs-10">
		<a name="<?php echo sanitize_title($title); ?>"></a>
		<h3><?php echo $title; ?></h3>
	</div>
<?php
		$args = array(
			'posts_per_page'   => -1,
			'post_type'        => 'bcl_events',
			'bcl_events_type'   => sanitize_title($title),
			'orderby'          => 'post_date',
			'order'            => 'DESC',
		);
		$events = get_posts($args);
		
		$dateCache = "";
		
		// loop over single events
		foreach ($events as $event) {
			
			
			
?>
<div class="col-xs-2 text-right date">
	<?php 
		$date = date('F Y', strtotime($event->post_date));		// show date only once
		if ($date != $dateCache) echo $date;
		$dateCache = $date;
	?>
</div>
<div class="col-xs-10 listing">
	<?php 
		// loop over ACF and get involved Person
		$involvedArray = get_field('involved', $event->ID);
		foreach ((array)$involvedArray as $involved) {
			if ($involved == 'Georg') echo '<i class="fa fa-user magenta"></i> ';
			if ($involved == 'Shiho') echo '<i class="fa fa-user blue"></i> ';
			if ($involved == 'Yuki') echo '<i class="fa fa-user green"></i> ';
			if ($involved == 'Philipp') echo '<i class="fa fa-user orange"></i> ';
		}
		
		if (empty($event->post_content)) { echo "No Content."; } else { echo $event->post_content; }
		
		$addl_info = get_field('additional_information', $event->ID);
		if (!empty($addl_info)) {
			?>
	<span class="additional">
		<?php echo $addl_info; ?>
	</span>
			<?php
		} 
		
	?>
</div>
<div class="clearfix"></div>

<?php
		}
?>

</div>

<?php
	}
}


?>

<div class="row">
	<div class="col-xs-12 page-header">
		<h1><?php the_title(); ?></h1>
	</div>
</div>

<div class="row">
	<div class="col-sm-3 hidden-xs">
		<?php wp_nav_menu($args); //  Show Events Menu ?>
	</div>
	<div class="col-sm-9">
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10">
				<a name="bcl"></a>
			</div>
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<?php 
					if (have_posts()) : the_post();
						the_content();
					endif;?>
			</div>
		</div>
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing round-images">
				<?php
				// get images
				$shihoImage = get_field('shiho_image');
				$georgImage = get_field('georg_image');
				$yukiImage = get_field('yuki_image');
				$philippImage = get_field('philipp_image');
				?>
				<img src="<?php echo $shihoImage['sizes']['square500']; ?>" class="shiho" alt="<?php echo $shihoImage['alt']; ?>" width='200px' height='200px' />
				&nbsp;&nbsp;
				<img src="<?php echo $georgImage['sizes']['square500']; ?>" class="georg" alt="<?php echo $georgImage['alt']; ?>" width='200px' height='200px' />
				&nbsp;&nbsp;
				<img src="<?php echo $yukiImage['sizes']['square500']; ?>" class="yuki" alt="<?php echo $yukiImage['alt']; ?>" width='200px' height='200px' />
				&nbsp;&nbsp;
				<img src="<?php echo $philippImage['sizes']['square500']; ?>" class="philipp" alt="<?php echo $philippImage['alt']; ?>" width='200px' height='200px' />
			</div>
		</div>
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<i class="fa fa-user blue"></i> <strong>Shiho Fukuhara</strong><br />
				<?php echo get_field('about_shiho'); ?>
			</div>
		</div>
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<i class="fa fa-user magenta"></i> <strong>Georg Tremmel</strong><br />
				<?php echo get_field('about_georg'); ?>
			</div>
		</div>
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<i class="fa fa-user green"></i> <strong>Yuki Yoshioka</strong><br />
				<?php echo get_field('about_yuki'); ?>
			</div>
		</div>
		
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<i class="fa fa-user red"></i> <strong>Philipp Boeing</strong><br />
				<?php echo get_field('about_philipp'); ?>
			</div>
		</div>
		
		<?php showEvents(); // Show Events ?>
		<div class="row event">
			<div class="col-xs-2 text-right date"></div>
			<div class="col-xs-10 listing">
				<i class="fa fa-user magenta"></i>&nbsp;GT &nbsp;&nbsp;&nbsp; 
				<i class="fa fa-user blue"></i>&nbsp;SF &nbsp;&nbsp;&nbsp; 
				<i class="fa fa-user green"></i>&nbsp;YY &nbsp;&nbsp;&nbsp; 
				<i class="fa fa-user red"></i>&nbsp;PB
			</div>
		</div>
			
	</div>
</div>


<?php get_footer(); ?>