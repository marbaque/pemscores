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
		if( function_exists('bcn_display') && !is_singular('lp_course') && !is_bbpress() ) {
			echo '<div class="migajas">';
			bcn_display();
			echo '</div>';
		}
		?>

	<div class="entry-content post-content">

		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'pemscores' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content .post-content -->

	<?php
	if ( is_singular('lp_course') ) {
		get_sidebar( 'cursos' );
	} else {
		get_sidebar( 'page' );
	}
	
	?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	// if ( comments_open() || get_comments_number() ) :
	// 	comments_template();
	// endif;
	?>
</article><!-- #post-## -->
