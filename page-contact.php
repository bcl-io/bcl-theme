<?php 
/*
Template Name: Contact
*/

get_header(); 

?>

<div class="page-header">
	<h1><?php the_title(); ?></h1>
</div>

<div id="content" class="clearfix row">
        
          <div id="main" class="col-xs-12" role="main">


            
              <section class="post_content clearfix" itemprop="articleBody">
				<?php 
					if (have_posts()) : the_post();
						the_content();
					endif;?>
            
              </section> <!-- end article section -->
              
             
        
          </div> <!-- end #main -->
            
        </div> <!-- end #content -->


<?php get_footer(); ?>