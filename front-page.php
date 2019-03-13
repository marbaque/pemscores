<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

get_header(); ?>



<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<section class="fp-content">
			<?php
			while ( have_posts() ) : the_post();

				the_content();

			endwhile; // End of the loop.
			?>
		</section>

		<section class="search-section">
			<div class="home-search">
				<!-- <h3> -->
					<!-- <?php //echo __( 'Buscar recursos', 'pemscores'); ?> -->
				<!-- </h3> -->

				<form role="search" method="get" id="searchform" class="search-form searchandfilter" action="<?php echo get_site_url(); ?>">
					<div>
						<!-- <label for="s">Search for:</label> -->
						<input type="text" class="search-field" value="" name="s" id="s" placeholder="Buscar recursos, capacitación, ..." />
						<!-- <input type="hidden" value="1" name="sentence" /> -->
						<input type="hidden" value="recurso,lp_course" name="post_type" />
						<!-- <input type="hidden" value="product_cat" name="magazines,books" /> -->
						<input type="hidden" id="searchsubmit" value="Search" />

					</div>
				</form>

			</div>
		</section>

		<section class="paginas-destacadas">
			<div class="paginas-inner">

			<?php

			$pagina1 = get_field('pagina_1');

			if( $pagina1 ):

				// override $post
				$post = $pagina1;
				setup_postdata( $post );

				?>
				<div class="pagina">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="excerpt"><?php the_excerpt(); ?></div>
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
				</div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina2 = get_field('pagina_2');

			if( $pagina2 ):

				// override $post
				$post = $pagina2;
				setup_postdata( $post );

				?>
				<div class="pagina">
					<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				<div class="excerpt"><?php the_excerpt(); ?></div>
				<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
				</div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>

			<?php

			$pagina3 = get_field('pagina_3');

			if( $pagina3 ):

				// override $post
				$post = $pagina3;
				setup_postdata( $post );

				?>
			    <div class="pagina">
			    	<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
					<div class="excerpt"><?php the_excerpt(); ?></div>
					<a class="read-more" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php echo __('Leer más', 'pemscores') . pemscores_get_svg( array( 'icon' => 'arrow-right' , 'fallback' => true ) ); ?></a>
			    </div>

			<?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>

			<?php endif; ?>
			</div>
		</section><!-- .paginas-destacadas-->

		<section class="cursos-destacados">
			<?php

				$args = array(
				    'post_type' => 'lp-course'
				);

				// Custom query.
				$query = new WP_Query( $args );

				// Check that we have query results.
				if ( $query->have_posts() ) {

				    // Start looping over the query results.
				    while ( $query->have_posts() ) {

				        $query->the_post();

				        get_template_part( 'template-parts/content', get_post_format() );

				    }

				}

				// Restore original post data.
				wp_reset_postdata();

				?>
		</section><!-- .cursos-destacados -->

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
