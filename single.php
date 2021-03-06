<?php get_header(); ?>
      
    <div class="container">  

			<div id="content" class="clearfix row">

				<div id="main" class="col-md-8 clearfix" role="main">

          <!-- UNCOMMENT FOR BREADCRUMBS
          <?php if ( function_exists('custom_breadcrumb') ) { custom_breadcrumb(); } ?> -->

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

							<header class="article-header single-header">

								<h1 class="entry-title single-title" itemprop="headline"><?php the_title(); ?></h1>
								<p class="byline vcard"><?php
                  printf( __( '<time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), bones_get_the_author_posts_link(), get_the_category_list(', '));
								?></p>

							</header> <?php // end article header ?>
							
<section class="entry-content clearfix" itemprop="articleBody">
<?php

$img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'cinemascope', true);
$imgObj = get_post( get_post_thumbnail_id() );

if ($img) { 
	echo '<div class="image">'."\n";
	echo '<img src="'.$img[0].'">'."\n";
	if ($imgObj->post_excerpt) echo '<span>'.$imgObj->post_excerpt.'</span><br />'."\n";
	echo '</div>'."\n";;
}

the_content(); 
?>

</section> <?php // end article section ?>

							<footer class="article-footer">
                  <p class="tags"><?php printf( '<span class="">' . __( 'in %1$s&nbsp;&nbsp;', 'bonestheme' ) . '</span>', get_the_category_list(', ') ); ?> <?php the_tags( '<span class="tags-title">' . __( '<i class="icon-tags"></i>', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

							</footer> <?php // end article footer ?>

							<?php //comments_template(); ?>

						</article> <?php // end article ?>

					<?php endwhile; ?>

					<?php else : ?>

						<article id="post-not-found" class="hentry clearfix">
								<header class="article-header">
									<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
								</header>
								<section class="entry-content">
									<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
								</section>
								<footer class="article-footer">
										<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
								</footer>
						</article>

					<?php endif; ?>

				</div> <?php // end #main ?>

				<?php get_sidebar(); ?>

			</div> <?php // end #content ?>

    </div> <?php // end ./container ?>

<?php get_footer(); ?>
