<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pemscores
 */

get_header(); ?>

<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
		<h2 class="page-title"><?php printf( esc_html__( 'Resultados de búsqueda para: %s', 'pemscores' ), '<i>' . get_search_query() . '</i>' ); ?></h2>

			<?php if ( have_posts() ) : ?>
			
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					* Include the Post-Format-specific template for the content.
					* If you want to override this in a child theme, then include a file
					* called content-___.php (where ___ is the Post Format name) and that will be used instead.
					*/
					if ( get_post_type() =='recurso' ) {
						get_template_part( 'template-parts/content', 'none-recurso' );
					} else {
						get_template_part( 'template-parts/content', get_post_format() );
					}

				endwhile;

			else :

				get_template_part( 'template-parts/content', 'none-recurso' );
				return;
			
			endif;

			the_posts_pagination( array(
				'prev_text' => pemscores_get_svg( array( 'icon' => 'arrow-long-left', 'fallback' => true ) ) . __( 'Recientes', 'pemscores' ),
				'next_text' => __( 'Anteriores', 'pemscores' ) . pemscores_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Página ', 'pemscores' ) . '</span>',
			));

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<aside id="secondary" class="widget-area widgets-recursos" role="complimentary">

		<div class="widget">
			<?php
				// The standard search form
				$form = get_search_form( false );
				
				// Let's add a hidden input field
				$form = str_replace( '<input type="submit"', '<input type="hidden" name="post_type" value="recurso"><input type="submit"', $form );
				
				// Display our modified form
				echo $form;
				?>
		</div>

		<div class="widget">
			<div class="widget-inner">
				<h2 class="widget-title">Filtrar</h2>
				<?php echo do_shortcode('[searchandfilter fields="temas,cobertura,tipo_recurso,tipo_medio" types="radio,radio,radio,radio" headings="Ejes temáticos:,Cobertura:,Tipo de recurso:,Tipo de medio:" show_count="1,1,1,1" operators=”OR”   empty_search_url="/recursos/" search_placeholder="Palabras clave" submit_label="Filtrar"]'); 
				?>
			</div>
		</div>	
	</aside> <!-- secondary -->


<?php

get_footer();
