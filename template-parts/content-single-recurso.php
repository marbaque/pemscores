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

	<div class="recurso-wrap">

		<div class="recurso-media">
			<?php
			if ( has_post_thumbnail() ) { ?>
			<figure class="recurso-image">
				<?php
				the_post_thumbnail('pemscores-index-img');
				?>
				<figcaption>
					<?php echo get_the_post_thumbnail_caption(); ?>
				</figcaption>
			</figure><!-- .featured-image full-bleed -->
			<?php } ?>


				<?php get_template_part( 'template-parts/recurso', 'link' ); ?>

		</div>

		<div class="recurso-content">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="recurso-descripcion">

				<?php get_template_part( 'template-parts/recurso', 'meta' ); ?>

			</div>
		</div> <!-- recurso-content -->

	</div>

</article><!-- #post-## -->
