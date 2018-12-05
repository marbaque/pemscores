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
			</figure><!-- .featured-image full-bleed -->
			<?php } ?>
		</div>

		<div class="recurso-content">

			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<div class="recurso-descripcion">
				<?php
					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continuar leyendo %s <span class="meta-nav">&rarr;</span>', 'pemscores' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'pemscores' ),
						'after'  => '</div>',
					) );

					get_template_part( 'template-parts/recurso', 'meta' );
				?>

			</div>
		</div> <!-- recurso-content -->

	</div>

</article><!-- #post-## -->
