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
		
		<?php
			$medioClass = "empty";
			
			if ( has_term('documento', 'tipo_medio') ) {
				$medioClass = "documento";
			}
			if ( has_term('audio', 'tipo_medio') ) {
				$medioClass = "audio";
			}
			if ( has_term('sitio-web', 'tipo_medio') ) {
				$medioClass = "sitio-web";
			}
			if ( has_term('video', 'tipo_medio') ) {
				$medioClass = "video";
			}

		?>
		
		<div class="recurso-icon <?= $medioClass; ?>"></div>

		<div class="recurso__text">
				<?php
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				?>
				<?php the_excerpt(); ?>

			<div class="recurso-cats">
				<!-- Ejes temáticos -->
				    <?php echo get_the_term_list(
				            $post->ID, 'temas', __('<span>', 'pemscores'), ', ', '</span>' ); ?>
				<!-- coberturas -->
				    <?php echo get_the_term_list(
				            $post->ID, 'cobertura', __('<span>', 'pemscores'), ', ', '</span>' ); ?>
				<!-- tipos de recurso -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_recurso', __('<span> ', 'pemscores'), ', ', '</span>' ); ?>
				<!-- Formato -->
				    <?php echo get_the_term_list(
				        $post->ID, 'tipo_medio', __('<span> ', 'pemscores'), ', ', '</span>' ); ?>

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
