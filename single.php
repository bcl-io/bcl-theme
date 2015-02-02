<?php

get_header(); ?>

<div class="left">
<?php
// initiates $nextLink, which is needed in addNextLinkToContent() below
$showCategories = getCategories();
$showPosts = getPosts();

while ( have_posts() ) : the_post();
	addNextLinkToContent(get_the_content()); 
	$title = get_the_title();
	$excerpt = get_the_excerpt();
endwhile;

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
<span class="projectname"><?php echo $postNumber . ". " . $title; ?>:</span><br />
<span class="description"><?php echo $excerpt; ?></span>
<br /><br />
<a href="<?php echo $nextLink; ?>">next.</a><br />
<?php get_sidebar(); ?>
</div><!--end textcolumn -->
</div><!--end right -->

<?php get_footer(); ?>