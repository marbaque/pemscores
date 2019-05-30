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

			<div class="recurso-media">
			
			<?php if ( has_post_thumbnail() ) : ?>
				
				<?php the_post_thumbnail('recurso-portada'); ?>
				
				<?php else : ?>
					<?php if( $fuente == 'ext' ): ?>
						<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="700" height="440"]'); ?>
					<?php elseif( $fuente == 'int' ): ?>
						<?php
						if( $file['type'] == 'image' ) {
							echo '<img src="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200px" height"auto">';
						} else {
							echo do_shortcode('[snapshot url="' . $file['url'] . '" alt="' . $file['filename'] . '" width="700" height="440"]');
						}?>
					<?php endif; ?>		
			<?php endif; ?>

				

					<?php get_template_part( 'template-parts/recurso', 'link' ); ?>

			</div> <!-- recurso-media -->

			<div class="recurso-content">
				<div class="recurso-descripcion">
					<?php get_template_part( 'template-parts/recurso', 'meta' ); ?>
				</div>
			</div> <!-- recurso-content -->
		</div> <!-- recurso-inner -->

	</div>

</article><!-- #post-## -->

<div class="recurso-secundario">
	<section class="comentarios">
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
		?>
	</section>

	<section class="relacionados">
		<h4><?= __( 'Recursos relacionados', 'pemscores' ); ?></h4>
		<ul>
		<?php
		$related = get_posts( array(
			'category__in' => wp_get_post_categories($post->ID),
			'numberposts' => 	5, 'post__not_in' => array($post->ID),
			'post_type'		=>	'recurso'
		) );

		if( $related ) foreach( $related as $post ) {
		setup_postdata($post); ?>

			<li>
			<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</li>

		<?php } ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	</section>
</div>
