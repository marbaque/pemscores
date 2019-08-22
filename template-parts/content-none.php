<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>
<section id="primary" class="content-area <?php if ( is_404() ) { echo 'error-404'; } else { echo 'no-results'; } ?> not-found">
	<main id="main" class="site-main" role="main">

		<div class="page-content search-box">
			<h1 class="page-title">
				<div class="icon-none">
					<img src="<?php echo get_template_directory_uri(); ?>/images/icons/search_result_icon.svg" alt="Search icon" aria-hidden="true">
				</div>
				<?php
				if ( is_404() ) { esc_html_e( 'Página no disponible', 'pemscores' );
				} else if ( is_search() ) {
					/* translators: %s = search query */
					printf( esc_html__( 'Nada encontrado para &ldquo;%s&rdquo;', 'pemscores'), get_search_query() );
				} else {
					esc_html_e( 'Nada encontrado', 'pemscores' );
				}
				?>
			</h1>
			
			<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

				<p><?php printf( wp_kses( __( '¿Quiere hacer su primera publicación? <a href="%1$s">Empieze aquí</a>.', 'pemscores' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

			<?php elseif ( is_search() ) : ?>

				<p><?php esc_html_e( 'Oooops, no se encontró nada con esos términos de búsqueda. Por favor, inténtelo de nuevo con otras palabras clave.', 'pemscores' ); ?></p>
				<?php get_search_form(); ?>

			<?php elseif ( is_404() ) : ?>

				<p><?php esc_html_e( '¿Se perdió? Para localizar lo que busca, revise los items siguientes o intente una nueva búsqueda:', 'pemscores' ); ?></p>
				<?php get_search_form(); ?>

			<?php else : ?>

				<p><?php esc_html_e( 'Parece que no encontramos lo que anda buscando. Inténtelo con una búsqueda.', 'pemscores' ); ?></p>
				<?php get_search_form(); ?>
			<?php endif; ?>
		</div><!-- .page-content -->

		<?php
		if ( is_404() || is_search() ) {
		?>
			<h2 class="page-title secondary-title"><?php esc_html_e( 'Otros recursos:', 'pemscores' ); ?></h2>
			<?php
			// Get the 6 latest posts
			$args = array(
				'posts_per_page' => 6,
				'post_type'	=> array('recurso', 'lp_course'),
			);
			$latest_posts_query = new WP_Query( $args );
			// The Loop
			if ( $latest_posts_query->have_posts() ) {
					while ( $latest_posts_query->have_posts() ) {
						$latest_posts_query->the_post();
						// Get the standard index page content
						if ( get_post_type() =='recurso' ) {
			 				get_template_part( 'template-parts/content', 'recurso' );
			 			} else {
			 				get_template_part( 'template-parts/content', get_post_format() );
			 			}
					}
			}
			/* Restore original Post Data */
			wp_reset_postdata();
		} // endif
		?>


	</main><!-- #main -->
</section><!-- #primary -->

<?php
get_sidebar( 'recursos' );
get_footer();
