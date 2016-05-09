<?php 
/*
Template Name: BHA
*/

get_header(); 

?>

<div id="content" class="clearfix row">
<div id="main" class="col-xs-12" role="main">

<?php 

if (have_posts()) : 
	while (have_posts()) : the_post(); 

?>
		<article class="bha center" role="article" itemscope itemtype="http://schema.org/BlogPosting">

			<div class="logos">
				<img src="/wp-content/themes/bcl/images/bioclub_first_logo.png" width="100px">
				<img src="/wp-content/themes/bcl/images/biohack_academy_logo.png" width="100px">
			</div>
			
			<header>
				<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
			</header>
		
			<section class="post_content clearfix" itemprop="articleBody">
				<?php the_content(); ?>

			</section>
			
			<footer>
				<?php the_tags('<p class="tags"><span class="tags-title">Tags:</span> ', ', ', '</p>'); ?>
			</footer>
		
		</article>
<?php 
	endwhile;
endif;

?>

	</div> <!-- end #main -->
</div> <!-- end #content -->


<?php get_footer(); ?>