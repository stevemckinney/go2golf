<?php get_header(); ?>

	<main role="main">
  	<section class="o-wrapper t-push-bottom--half">
  
    	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
    
    		<!-- article -->
    		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    			<!-- post thumbnail -->
    			<?php if ( has_post_thumbnail()) : ?>
    				<?php the_post_thumbnail('single'); ?>
    			<?php endif; ?>
    			
    			<div class="post-header">
      			<h1><?php the_title(); ?></h1>
      			<span class="date published"><?php the_time('F j, Y'); ?></span>
      			<span class="author"><?php the_author_posts_link(); ?></span>
          </div>
          
          <div class="cms-content">
      			<?php the_content(); ?>
          </div>
          
          <div class="social">
            <h2 class="dib vam">Share this post</h2>
      			<a href="http://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="dib vam"><img alt="facebook" src="<?php echo get_template_directory_uri() ?>/dist/images/icon-facebook.svg"></a>
      			<a href="https://twitter.com/intent/tweet?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>" class="dib vam"><img alt="twitter" src="<?php echo get_template_directory_uri() ?>/dist/images/icon-twitter.svg"></a>
      			<a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" class="dib vam"><img alt="google+" src="<?php echo get_template_directory_uri() ?>/dist/images/icon-google.svg"></a>
          </div>
    
    		</article>
    		<!-- /article -->
    
    	<?php endwhile; ?>
    
    	<?php else: ?>
    
    		<!-- article -->
    		<article>
    
    			<h1><?php _e( 'Sorry, nothing to display.', 'html5blank' ); ?></h1>
    
    		</article>
    		<!-- /article -->
    
    	<?php endif; ?>
  
  	</section>
	</main>

<?php get_footer(); ?>
