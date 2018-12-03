<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	if ( has_post_thumbnail() ) { ?>
	<figure class="featured-image full-bleed">
		<?php
		the_post_thumbnail('pemscores-full-bleed');
		?>
	</figure><!-- .featured-image full-bleed -->
	<?php } ?>




	<div class="entry-content post-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'pemscores' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content .post-content -->

</article><!-- #post-## -->
