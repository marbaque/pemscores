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

		<?php if ( has_post_thumbnail() ) : ?>
			
			
			<figure class="recurso-index-img">
			<a href="<?= esc_url( get_permalink() ); ?>"><?php the_post_thumbnail('thumbnail'); ?></a>
			</figure>
			
			<?php else : ?>
				<?php if( $fuente == 'ext' ): ?>
				<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="200" height="200"]'); ?>
				<?php elseif( $fuente == 'int' ): ?>
				<?php
					if( $file['type'] == 'image' ) {
						echo '<img src="' . $file['url'] . '" alt="' . $file['filename'] . '">';
					} else {
						echo do_shortcode('[snapshot url="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200" height="200"]');
					}?>
				<?php endif; ?>		
		<?php endif; ?>

		<div class="recurso__text">
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
				<?php the_excerpt(); ?>

			<div class="recurso-cats">
				<!-- Ejes temáticos -->
				    <?php echo get_the_term_list(
				            $post->ID, 'temas', __('<span>', 'pemscores'), ' ', '</span>' ); ?>
				<!-- coberturas -->
				    <?php echo get_the_term_list(
				            $post->ID, 'cobertura', __('<span>', 'pemscores'), ' ', '</span>' ); ?>
				<!-- tipos de recurso -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_recurso', __('<span> ', 'pemscores'), ' ', '</span>' ); ?>
				<!-- Formato -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_medio', __('<span> ', 'pemscores'), ' ', '</span>' ); ?>

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
