<?php

get_header();
get_sidebar(); ?>

<div class="maincolumn">
<?php while ( have_posts() ) : the_post(); ?>
<?php the_content(); ?>	
<?php endwhile; ?>
</div><!--end maincolumn -->

<?php get_footer(); ?>
