<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

get_header(); ?>



<header class="page-header">
	<?php
		the_archive_title( '<h1 class="page-title">', '</h1>' );
		the_archive_description( '<div class="archive-description">', '</div>' );

		if ( get_post_type() =='recurso' ) {
			echo do_shortcode( '[searchandfilter fields="search,cobertura,tipo_recurso,tipo_medio,post_date" post_types="recurso" types=",daterange" search_placeholder="Buscar recursos..." types=",date" submit_label="Filtrar" class="recursos-searchandfilter" headings=",Cobertura,Contenido,Formato,Fecha"]' );

		}
	?>
</header><!-- .page-header -->

<?php
	if( function_exists('bcn_display') && !is_singular('lp_course') ) {
		echo '<div class="migajas">';
		bcn_display();
		echo '</div>';
	}
	?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				if ( get_post_type() =='recurso' ) {
	 				get_template_part( 'template-parts/content', 'recurso' );
	 			} else {
				get_template_part( 'template-parts/content', get_post_format() );
				}

			endwhile;

			the_posts_pagination( array(
				'prev_text' => pemscores_get_svg( array( 'icon' => 'arrow-long-left', 'fallback' => true ) ) . __( 'Recientes', 'pemscores' ),
				'next_text' => __( 'Anteriores', 'pemscores' ) . pemscores_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
				'before_page_number' => '<span class="screen-reader-text">' . __( 'Página ', 'pemscores' ) . '</span>',
			));

		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
