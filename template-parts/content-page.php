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
	
	<!-- custom-fields.php -->
	<?php $meta = get_post_meta( $post->ID, 'page_options', true ); ?>

	<?php if (is_array($meta) && isset($meta['checkbox'])) : ?>
			<!-- Checkbox is checked. -->
			<?php the_title( '<h1 class="screen-reader-text">', '</h1>' ); ?>
	<?php else: ?>
			<!-- Checkbox is not checked. -->
			<header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

				<?php if (is_array($meta) && isset($meta['subtitle'])) : ?>
					<?php if ( strlen( $meta['subtitle'] ) > 0 ) {
						echo '<h2 class="subheader">' . $meta['subtitle'] . '</h2>';
					}
					?>
				<?php endif; ?>
				
			</header><!-- .entry-header -->
	<?php endif; ?>

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
	get_sidebar( 'page' );
	?>

	<?php
	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;
	?>
</article><!-- #post-## -->
