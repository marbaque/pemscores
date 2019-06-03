<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>

<?php if ( has_post_thumbnail() ) : ?>
	<div class="full-bleed featured-image">
		<?php
			the_post_thumbnail('pemscores-full-bleed');
			?>
		<?php if ( is_singular('lp_course') ): ?>
			<?php the_title( '<h1 class="course-title">', '</h1>' ); ?>
		<?php endif; ?>
	</div><!-- .full-bleed -->

	<?php elseif ( !has_post_thumbnail() && is_singular('lp_course') ) : ?>
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
<?php endif; ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>




	<?php if ( !is_singular('lp_course') && !is_buddypress() ): ?>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		</header><!-- .entry-header -->
	<?php endif; ?>


	<?php
		if( function_exists('bcn_display') && !is_singular('lp_course') && !is_bbpress() ) {
			echo '<div class="migajas">';
			bcn_display();
			echo '</div>';
		}
		?>

	<div class="entry-content post-content">

		<?php if ( is_buddypress() ): ?>
			<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
		<?php endif; ?>
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
	// if ( comments_open() || get_comments_number() ) :
	// 	comments_template();
	// endif;
	?>
</article><!-- #post-## -->
