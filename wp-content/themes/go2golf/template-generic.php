<?php /* Template Name: Generic */ get_header(); ?>
<div class="c-woocommerce-breadcrumb">
	<div class="o-wrapper"><h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1></div>
</div>
<div class="o-wrapper">
  <div class="o-grid">
    <div class="o-grid__col o-grid__col--2/3--x-large">
    	<main role="main" class="cms-content" style="margin-top:0">
    		<?php
    		if ( have_posts() ) :
    
    			if ( is_home() && ! is_front_page() ) : ?>
    
    			<?php
    			endif;
    
    			/* Start the Loop */
    			while ( have_posts() ) : the_post();
    
    				/*
    				 * Include the Post-Format-specific template for the content.
    				 * If you want to override this in a child theme, then include a file
    				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
    				 */
    				echo '<div class="c-course-result-item c-blog-item">';
    				
              the_content();
            
            echo '</div>';
            
    			endwhile;
    
    			the_posts_navigation();
    
    		else :
    
    			get_template_part( 'inc/template-parts/content', 'none' );
    
    		endif; ?>
    
    	</main>
    </div>
    <div class="o-grid__col o-grid__col--1/3--x-large"><?php get_sidebar(); ?></div>
  </div>
</div>

<?php get_footer(); ?>