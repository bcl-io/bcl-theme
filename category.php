<?php

get_header(); ?>

<div class="left">
<?php
$showCategories = getCategories();
$showPosts = getPosts();

showFeaturedPosts();
/*
// show first post when category is selected
$categoryName = single_cat_title('', false);
$categoryID = get_cat_ID($categoryName);

$args = array(
    'orderby'	=> 'post_date',
    'order'		=> 'DESC',
	'category'	=> $categoryID,
);
$posts = get_posts($args);
$firstPost = $posts[0];
$title = $firstPost->post_title;
$excerpt = $firstPost->post_excerpt;



addNextLinkToContent($firstPost->post_content); 
*/
?>
</div><!--end left -->

<div class="right">
<div class="title">
<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
</div><!--end title -->
<div class="title">
</div><!--end title -->
<div class="textcolumn">
<div class="medianav">
<?php echo $showCategories; ?>
</div><!--end medianav -->
<?php echo $showPosts; ?>
</div><!--end textcolumn -->
<div class="textcolumn">
<?php get_sidebar(); ?>
</div><!--end textcolumn -->
</div><!--end right -->
<?php get_footer(); ?>