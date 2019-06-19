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
