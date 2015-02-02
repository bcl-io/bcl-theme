<?php 
/*
Template Name: Projects
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	
<div class="page-header">
	<h1><?php the_title(); ?>
	<!--
	<div class="btn-group">
		<button type="button" class="btn btn-default glyphicon glyphicon-th"> </button>
		<button type="button" class="btn btn-default glyphicon glyphicon-align-justify"> </button>
	</div>
-->
	</h1>
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

$featureLeft = array_shift($pages);
$leftImage = get_field('preview_image', $featureLeft->ID);

$featureRight = array_shift($pages);
$rightImage = get_field('preview_image', $featureRight->ID);

// Left Feature
?>
<div class="row project-row">

<div class="col-xs-6">
	<a href="<?php echo get_permalink($featureLeft->ID); ?>">
		<div class="imgContainer">
			<?php
				if ($leftImage) {
					echo "<img src='".$leftImage['sizes']['cinemascope']."' width='100%'>\n";
				}
			?>
			<div class="imagecaption">
				<?php echo get_field('preview_text', $featureLeft->ID); ?>
			</div>
		</div>
		<div class="project-title"><h4><?php echo $featureLeft->post_title; ?></h4></div>
	</a>
</div>

<div class="col-xs-6">
	<a href="<?php echo get_permalink($featureRight->ID);?>">
		<div class="imgContainer">
			<?php
				if ($rightImage) {
					echo "<img src='".$rightImage['sizes']['cinemascope']."' width='100%'>\n";
				}
			?>
			<div class="imagecaption">
				<?php echo get_field('preview_text', $featureRight->ID); ?>
			</div>
		</div>
		<div class="project-title"><h4><?php echo $featureRight->post_title; ?></h4></div>
	</a>
</div>

</div><?php // end row ?>

<div class="row project-row">
<?php



$counter = 0;
foreach ($pages as $page) :

	$link = get_permalink($page->ID);
	$title = $page->post_title;
	
	$image = get_field('preview_image', $page->ID);
	if ($image) $imageHtml = "<img src='".$image['sizes']['small_cinemascope']."' width='100%'>\n";

	$previewText = get_field('preview_text', $page->ID) . "<br />\n";
	
	$tags = get_field('project_tags', $page->ID);
	if ($tags != null) {
		$tagsHtml = "";
		foreach ($tags as $tag) {
			$tagsHtml .= "<span class='tag'>" . $tag->name . "</span>\n";
		}	
		$tagsHtml .= "<br />\n";
	}
	
?>

<div class="col-xs-3">
	<a href="<?php echo $link; ?>">
		<div class="imgContainer">
			<?php if ($image) echo $imageHtml; ?>
			<div class="imagecaption">
				<?php echo $tagsHtml; ?>
				<?php echo $previewText; ?>
			</div>
		</div>
		<div class="project-title"><h5><?php echo $title; ?></h5></div>
	</a>
</div>


<?php 

$counter++;
if ($counter%4 == 0) {
	echo "</div>\n";
	echo "<div class=\"row project-row\">\n";	
}


endforeach;

?>

</div><?php // end row ?>

<?php endif; ?>
<div class="clearfix"></div> 

<div class="clearfix"></div> 
</div>
</div>
</div>

<?php get_footer(); ?>