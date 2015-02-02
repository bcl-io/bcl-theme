<?php 
/*
Template Name: Front
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	
<div class="container-fluid">
	<div class="bigentry">
		<h1><?php echo get_the_content();  // no autop... ?></h1>
	</div>
</div>

<div class="container-fluid">
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

	<div class="col-xs-12">
		<a href="nbj">
		<div id="carousel-top" class="carousel slide" data-ride="carousel" data-interval="false">
			<ol class="carousel-indicators">
				<li data-target="#carousel-top" data-slide-to="0" class="active"></li>
				<li data-target="#carousel-top" data-slide-to="1"></li>
				<li data-target="#carousel-top" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<img src="http://127.0.0.1/bcl/wp-content/uploads/2013/11/Parts-Unknown-938x576.png">
					<div class="carousel-caption">
						<h3>Plastic Islanfn ns fs fhs</h3>
						fsfsf
					</div>
				</div>
				<div class="item">
					<img src="http://127.0.0.1/bcl/wp-content/uploads/2013/11/Parts-Unknown-938x576.png">
					<div class="carousel-caption">
						fsfsfsfgsgs
					</div>
				</div>
				<div class="item">
					<img src="http://127.0.0.1/bcl/wp-content/uploads/2013/11/Parts-Unknown-938x576.png">
					<div class="carousel-caption">
						fsfsfsfgsgsfsfv
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#carousel-top" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			</a>
			<a class="right carousel-control" href="#carousel-top" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			</a>
		</div>
		</a>
	</div>
	
</div>


<div class="row project-row">

<div class="col-xs-6">
	<a href="<?php echo get_permalink($featureLeft->ID); ?>">
		<div class="imgContainer">
			<?php
				if ($leftImage) {
					echo "<img src='".$leftImage['sizes']['large']."' width='100%'>\n";
				}
			?>
			<div class="imagecaption">
				<?php echo get_field('preview_text', $featureLeft->ID); ?>
			</div>
		</div>
		<div class="project-title"><h3><?php echo $featureLeft->post_title; ?></h3></div>
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
		<div class="project-title"><h3><?php echo $featureRight->post_title; ?></h3></div>
	</a>
</div>

<div class="clearfix"></div>


</div><?php // end row ?>
</div><!-- /container -->



<div class="container">
	
<?php endif; ?>

<?php get_footer(); ?>