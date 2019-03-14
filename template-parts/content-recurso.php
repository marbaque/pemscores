<?php
/**
 * Template part for displaying recursos en el archive.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>

<?php
	$fuente = get_field('fuente');
	$url = get_field('url_externo');
	$file = get_field('subir_arch');
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="recurso__content">

		<?php if( $fuente == 'ext' ): ?>
			<figure class="recurso-index-img">
				<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="200" height="200"]'); ?>
			</figure>
		<?php elseif( $fuente == 'int' ): ?>
			<figure>
				<?php echo do_shortcode('[snapshot url="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200" height="200"]'); ?>
			</figure>
		<?php endif; ?>

		<div class="recurso__text">
			<header class="entry-header">
				<?php

					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
					?>

			</header><!-- .entry-header -->

			<div class="recurso-cats">
				<!-- coberturas -->
				    <?php echo get_the_term_list(
				            $post->ID, 'cobertura', __('<p><strong>Cobertura:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

				<!-- tipos de recurso -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_recurso', __('<p><strong>Tipo de recurso:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

				<!-- Formato -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_medio', __('<p><strong>Formato:</strong> ', 'pemscores'), ', ', '</p>' ); ?>



				<!-- Interacciones -->
				    <?php echo get_the_term_list(
				        $post->ID, 'interaccion', __('<p><strong>Interacción:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

			</div><!-- .recurso-cats -->
		</div><!-- .recurso__content -->




	</div><!-- .post__content -->

		<?php
		$read_more_link = sprintf(
			/* translators: %s: Name of current post. */
			wp_kses( __( 'Ver recurso %s', 'pemscores' ), array( 'span' => array( 'class' => array() ) ) ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		);
		?>

		<a href="<?php echo esc_url( get_permalink() ) ?>" class="read-more" rel="bookmark">
			<?php echo $read_more_link . pemscores_get_svg( array('icon' => 'arrow-right', 'fallback' => true ) ); ?>
		</a>
</article><!-- #post-## -->
