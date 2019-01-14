<?php
/**
 * Template part for displaying posts.
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

	<?php if( $fuente == 'ext' ): ?>
		<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="200" height="200"]'); ?>
	<?php elseif( $fuente == 'int' ): ?>
		<?php echo do_shortcode('[snapshot url="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200" height="200"]'); ?>
	<?php endif; ?>

	<div class="recurso__content">
		<header class="entry-header">
			<?php

				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>

		</header><!-- .entry-header -->

		<div class="recurso-content">
			<!-- coberturas -->
			<?php
			 $cobertura = get_field('cobertura_field');

			    if( $cobertura ): ?>
			        <p><strong><?php echo __('Cobertura:', 'pemscores'); ?></strong>
			        <?php echo get_the_term_list(
			            $post->ID,
			            'cobertura',
			            ' ',
			            ', ',
			            ''
			        ); ?>
			    </p>

			<?php endif; ?>


			<!-- tipos de recurso -->
			<?php
			    $tipos_recurso = get_field('tipo_recurso_field');

			    if( $tipos_recurso ): ?>

			    <p><strong><?php echo __('Tipo de recurso:', 'pemscores'); ?></strong>

			        <?php echo get_the_term_list(
			            $post->ID,
			            'tipo_recurso',
			            ' ',
			            ', ',
			            ''
			        ); ?>
			    </p>

			<?php endif; ?>

			<!-- Formato -->
			<?php

			    $medio = get_field('medio_field');

			    if( $medio ): ?>

			    	<p><strong>Formato:</strong> <a href="<?php echo get_term_link( $medio ); ?>"><?php echo $medio->name; ?></a></p>

			<?php endif; ?>

		</div><!-- .entry-content -->

		<div class="continue-reading">
			<?php
			$read_more_link = sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Ver recurso %s', 'pemscores' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			);
			?>

			<a href="<?php echo esc_url( get_permalink() ) ?>" rel="bookmark">
				<?php echo $read_more_link; ?>
			</a>
		</div><!-- .continue-reading -->

	</div><!-- .post__content -->
</article><!-- #post-## -->
