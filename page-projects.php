<?php 
/*
Template Name: Projects
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	
<div class="row">
	<div class="col-xs-12 page-header">
		<h1><?php the_title(); ?></h1>
	</div>
</div>



<?php

global $menuPages;

$menuPageIds = "";
foreach ($menuPages as $name) {
	$page = get_page_by_title($name);
	$menuPageIds .= $page->ID . ",";
}

$args = array(
	'sort_order' => 'DESC',			// newest first
	'sort_column' => 'post_date',
	'exclude' => $menuPageIds,
); 
$pages = get_pages($args);

?>


<div id="projects" class="row">
<?php



$counter = 0;
foreach ($pages as $page) :

	$link = get_permalink($page->ID);
	$title = $page->post_title;
	
	$image = get_field('preview_image', $page->ID);
	
	// only projects with images
	if (!$image) continue;
	$imageHtml = "<img src='".$image['sizes']['small_cinemascope']."' width='100%'>\n";
	
?>

<div class="item">
	<a href="<?php echo $link; ?>">
		<div class="imgContainer">
			<?php echo $imageHtml; ?>
		</div>
	</a>
</div>


<?php 

endforeach;

?>

</div><?php // end row ?>

<?php endif; ?>

<div class="clearfix"></div> 
</div>
</div>
</div>

<?php get_footer(); ?>