<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package pemscores
 */

get_header(); ?>

	<?php 
		if ( function_exists( 'pemscores_breadcrumbs' ) ) {
			pemscores_breadcrumbs();
		}
	?>

<?php
if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title"><?php printf( esc_html__( 'Resultados de búsqueda para: %s', 'pemscores' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
	</header><!-- .page-header -->

<?php
else :

	get_template_part( 'template-parts/content', 'none' );
	return;

endif; ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			/**
			 * Run the loop for the search to output the results.
			 * If you want to overload this in a child theme then include a file
			 * called content-search.php and that will be used instead.
			 */
			get_template_part( 'template-parts/content' );

		endwhile;

		the_posts_pagination( array(
			'prev_text' => pemscores_get_svg( array( 'icon' => 'arrow-long-left', 'fallback' => true ) ) . __( 'Recientes', 'pemscores' ),
			'next_text' => __( 'Anteriores', 'pemscores' ) . pemscores_get_svg( array( 'icon' => 'arrow-long-right' , 'fallback' => true ) ),
			'before_page_number' => '<span class="screen-reader-text">' . __( 'Página ', 'pemscores' ) . '</span>',
		));

		?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_footer();
