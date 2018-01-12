<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package goandgolf
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
    /*
		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php goandgolf_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; */ ?>
	</header>

	<?php goandgolf_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'goandgolf' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->
  
  <?php /*
	<footer class="entry-footer">
		<?php goandgolf_entry_footer(); ?>
	</footer>
	*/ ?>
</article>
