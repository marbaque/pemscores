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
	<?php
		if( function_exists('bcn_display') && !is_singular('lp_course') ) {
			echo '<div class="migajas">';
			bcn_display();
			echo '</div>';
		}
		?>
	<div class="recurso-wrap">

		<header class="recurso-header">
			<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			endif; ?>

		</header><!-- .entry-header -->

		<div class="recurso-inner">

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

			<div class="recurso-media">

				<!-- si se subió una imagen al recurso -->
				<?php if ( has_post_thumbnail() ) : ?>
					
					<?php the_post_thumbnail('recurso-portada'); ?>
					
				<?php else : ?>
				
					<!-- si es una fuente externa, obtener la captura de pantalla -->
					<?php if( $fuente == 'ext' ): ?>
						<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="700" height="440"]'); ?>
					
					<?php elseif( $fuente == 'int' ): ?>
						<?php
						if( $file['type'] == 'image' ) {
							echo '<img src="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200px" height"auto">';
						
						} else { 
							echo '<div class="recurso-icon '  . $medioClass . '"></div>';
						} ?>
					<?php endif; ?>

				<?php endif; ?>					
				
			</div> <!-- recurso-media -->

			<div class="recurso-content">
				<div class="recurso-descripcion">
				<?php get_template_part( 'template-parts/recurso', 'link' ); ?>
					<?php get_template_part( 'template-parts/recurso', 'meta' ); ?>
				</div>
			</div> <!-- recurso-content -->
		</div> <!-- recurso-inner -->

	</div>

</article><!-- #post-## -->

<div class="recurso-secundario hentry">
	
	<section class="content-area">
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
	</section>

	
		
	<aside id="secondary" class="widget-area" role="complimentary">
		<div class="widget">
			<div class="widget-inner">
				<?php echo do_shortcode('[ratemypost]'); ?>
			</div>
		</div>
		
		<?php
			if ( is_active_sidebar( 'sidebar-3' )  )
				{
					dynamic_sidebar( 'sidebar-3' );
				}	
		?>

	</aside> <!-- secondary -->

</div>
