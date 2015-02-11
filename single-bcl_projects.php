<?php 
/*
Template Name: Single Project
*/

get_header(); ?>

<?php if ( have_posts() ) : the_post(); ?>
	
<div class="page-header">
	<h1><?php the_title(); ?><? edit_post_link('*'); ?></h1>
</div>

<div class="row ">
	<div class="col-xs-8">
		<?php 
			$previewText = get_field('preview_text', $post->ID);
			if ($previewText) {
				echo '<p class="lead">'.$previewText.'</p>'."\n";
			}
		?>
		<?php
			
			$image = get_field('preview_image', $page->ID);
			if ($image) {
				echo "<p><img src='".$image['sizes']['cinemascope']."' width='100%'></p>\n";
				
				$caption = $image['caption'];
				if ($caption) {
					echo "<div class=\"imagecaption\">$caption</div>\n";
				}
			}
		
		?>
	

		<?php the_content(); ?>

<!--
		<blockquote class="pull-left">
		  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
		  <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
		</blockquote>
-->	
	
		
	</div>
</div>

<?php endif; ?>

<?php get_footer(); ?>