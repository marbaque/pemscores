<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package pemscores
 */

?>


<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

    <p class="etiqueta"><?php printf( wp_kses( __( '¿Quiere publicar el primer recurso? <a href="%1$s">Empieze aquí</a>.', 'pemscores' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

<?php elseif ( is_search() ) : ?>

    <p><?php esc_html_e( 'No se encontró nada con esos términos de búsqueda. Por favor, inténtelo de nuevo añadiendo otras palabras o seleccionando otra opción.', 'pemscores' ); ?></p>
    

<?php elseif ( is_404() ) : ?>

    <p><?php esc_html_e( '¿Se perdió? Para localizar lo que busca, revise los items siguientes o intente una nueva búsqueda:', 'pemscores' ); ?></p>
    

<?php else : ?>

    <p><?php esc_html_e( 'Parece que no encontramos lo que anda buscando. Inténtelo con una búsqueda.', 'pemscores' ); ?></p>
    
<?php 

endif;
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
