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

<?
// get all (used) filters dynamically
// inefficient, but makes sure only used tags are displayed and method not too tied to the backend
$filters = array();
foreach ($pages as $page){
	$project_tags = get_field('project_tags',$page->ID);
	foreach ($project_tags as $tag){
		if (in_array($tag->name, $filters) == false){
			$filters[] = $tag->name;
		}
	}
}
?>

<div id="projectfilters" class="row">
 <p> <a href="#" data-filter="*">Show All</a>
  <? foreach ($filters as $filter){ ?><a href="#" data-filter=".<? echo $filter; ?>"><? echo $filter; ?></a>

  <? } ?></p>
</div>

<div id="projects" class="row">
<?php



$counter = 0;
foreach ($pages as $page) :

	$link = get_permalink($page->ID);
	$title = $page->post_title;
	
	$image = get_field('preview_image', $page->ID);
	$project_tags = get_field('project_tags',$page->ID);
	$projectfilter = '';
	foreach ($project_tags as $tag){
		$projectfilter .= ' '.$tag->name;
	}
	// only projects with images
	if (!$image) continue;
	$imageHtml = "<img src='".$image['sizes']['small_cinemascope']."' width='100%'>\n";
	
?>

<div class="item <? echo $projectfilter?>">
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