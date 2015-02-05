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


$args = array(
	'sort_order' => 'DESC',			// newest first
	'sort_column' => 'post_date',
	'posts_per_page' => -1, // show all projects
	'post_type' => 'bcl_projects',
); 
$pages = get_posts($args);


?>

<?
// get all filters


$filters =  get_terms( 'bcl_projects_category', array(
 	'orderby'    => 'name',
 ) );
?>

<div id="projectfilters" class="row">
 <p> <a href="#" data-filter="*">Show All</a>
  <? foreach ($filters as $filter){ ?><a href="#" data-filter=".<? echo $filter->name; ?>"><? echo $filter->name; ?></a>

  <? } ?></p>
</div>

<div id="projects" class="row">
<?php



$counter = 0;
foreach ($pages as $page) :

	$link = get_permalink($page->ID);
	$title = $page->post_title;
	
	$image = get_the_post_thumbnail($page->ID,"bcl-preview-4-3",array( 'width' => '100%' ));
	// only projects with images
	if (!$image) continue;
	$project_tags = wp_get_post_terms($page->ID, 'bcl_projects_category', array("fields" => "all"));
	$projectfilter = '';
	foreach ($project_tags as $tag){
		$projectfilter .= ' '.$tag->name;
	}	
?>

<div class="item <? echo $projectfilter?>">
	<a href="<?php echo $link; ?>">
		<div class="imagecaption">
			<?php echo $title; ?>
		</div>
		<div class="imagecurtain"></div>
		<div class="imgContainer">
			<?php echo $image; ?>
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