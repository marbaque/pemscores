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

	<div class="recurso-wrap">

		<div class="recurso-media">

			<?php if( $fuente == 'ext' ): ?>
				<?php echo do_shortcode('[snapshot url="' . $url .'" alt="WordPress.org" width="600" height="440"]'); ?>
			<?php elseif( $fuente == 'int' ): ?>
				<?php echo do_shortcode('[snapshot url="' . $file['url'] . '" alt="' . $file['filename'] . '" width="600" height="440"]'); ?>
			<?php endif; ?>

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
