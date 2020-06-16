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
	if (function_exists('bcn_display') && !is_singular('lp_course')) {
		echo '<div class="migajas">';
		bcn_display();
		echo '</div>';
	}
	?>
	<div class="recurso-wrap">

		<header class="recurso-header">
			<?php
			if (is_single()) :
				the_title('<h1 class="entry-title">', '</h1>');
			endif; ?>

		</header><!-- .entry-header -->

		<div class="recurso-inner">

			<?php
			$medioClass = "empty";

			if (has_term('documento', 'tipo_medio')) {
				$medioClass = "documento";
			}
			if (has_term('audio', 'tipo_medio')) {
				$medioClass = "audio";
			}
			if (has_term('sitio-web', 'tipo_medio')) {
				$medioClass = "sitio-web";
			}
			if (has_term('video', 'tipo_medio')) {
				$medioClass = "video";
			}
			?>

			<div class="recurso-media">

				<!-- si se subió una imagen al recurso -->
				<?php if (has_post_thumbnail()) : ?>

					<?php the_post_thumbnail('recurso-portada'); ?>

				<?php else : ?>

					<!-- si es una fuente externa, obtener la captura de pantalla -->
					<?php if ($fuente == 'ext' && $medioClass == "video") : ?>
						<?php
						// echo the function to render the video
						echo wp_oembed_get($url);
						?>

					<?php elseif ($fuente == 'ext' && $medioClass !== "video") : ?>
						<?php echo do_shortcode('[snapshot url="' . $url . '" alt="Captura de pantalla" width="700" height="400"]'); ?>

					<?php elseif ($fuente == 'int') : ?>
						<?php
						if ($file['type'] == 'image') {
							echo '<img src="' . $file['url'] . '" alt="' . $file['filename'] . '" width="200px" height"auto">';
						} else { ?>
						<?php echo '<div class="recurso-icon '  . $medioClass . '"></div>';
						} ?>
					<?php endif; ?>

				<?php endif; ?>

			</div> <!-- recurso-media -->

			<div class="recurso-content">
				<div class="recurso-descripcion">
					<?php get_template_part('template-parts/recurso', 'link'); ?>
					<?php get_template_part('template-parts/recurso', 'meta'); ?>
				</div>
			</div> <!-- recurso-content -->
		</div> <!-- recurso-inner -->

		<div class="descripcion">
			<h2><?php echo __('Descripción', 'pemscores'); ?></h2>
			<?php the_content(); ?>
		</div>

	</div> <!-- recurso-wrap -->

	<div class="recurso-secundario">


		<section class="content-area">


			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;
			?>
		</section>

		<aside id="secondary" class="widget-area" role="complimentary">

			<div class="recursos-relacionados widget">
				<div class="widget-inner">
					<h2 class="widget-title">Recursos similares</h2>
					<?php

					//get the taxonomy terms of custom post type
					$customTaxonomyTerms = wp_get_object_terms($post->ID, 'your_taxonomy', array('fields' => 'ids'));

					//query arguments
					$args = array(
						'post_type' => 'recurso',
						'post_status' => 'publish',
						'posts_per_page' => 5,
						'orderby' => 'rand',
						'post__not_in' => array($post->ID),
						'tax_query' => 'tipo_medio',
					);

					//the query
					$relatedPosts = new WP_Query($args);

					//loop through query
					if ($relatedPosts->have_posts()) {
						echo '<ul>';
						while ($relatedPosts->have_posts()) {
							$relatedPosts->the_post();
					?>
							<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php
						}
						echo '</ul>';
					} else {
						//no posts found
					}

					//restore original post data
					wp_reset_postdata();

					?>
				</div>


			</div>

		</aside> <!-- secondary -->

	</div>

</article><!-- #post-## -->