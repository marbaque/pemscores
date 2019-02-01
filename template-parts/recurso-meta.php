<?php
/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package pemscores
 */

?>
<div class="recurso_tags">
<!-- metadatos: autoria -->
<?php
    $personas = get_field('persona');
    $organizaciones = get_field('organizacion');
    $autoria = get_field('autoria');

    if( $autoria == 'Persona' ): ?>

        <p><strong><?php echo __('Autor:', 'pemscores'); ?></strong>
            <?php echo get_the_term_list( $post->ID, 'autor_tag', ' ', ', ', '' ); ?>
        </p>

    <?php elseif( $autoria == 'Organización' ): ?>

        <p><strong><?php echo __('Hecho por:', 'pemscores'); ?></strong>
            <?php echo get_the_term_list( $post->ID, 'organizacion_tag', ' ', ', ', '' ); ?>
        </p>

<?php endif; ?>
</div>
<!-- descipción -->
<?php
    $content = get_the_content( sprintf(
        /* translators: %s: Name of current post. */
        wp_kses( __( 'Continuar leyendo %s <span class="meta-nav">&rarr;</span>', 'pemscores' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ) );

    echo mb_strimwidth($content, 0, 400, '...');
    ?>

<div class="recurso_tags">
<!-- coberturas -->
    <?php echo get_the_term_list(
            $post->ID, 'cobertura', __('<p><strong>Cobertura:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

<!-- tipos de recurso -->
    <?php echo get_the_term_list(
        $post->ID, 'tipo_recurso', __('<p><strong>Tipo de recurso:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

<!-- Formato -->
    <?php echo get_the_term_list(
        $post->ID, 'tipo_medio', __('<p><strong>Formato:</strong> ', 'pemscores'), ', ', '</p>' ); ?>



<!-- Interacciones -->
    <?php echo get_the_term_list(
        $post->ID, 'interaccion', __('<p><strong>Interacción:</strong> ', 'pemscores'), ', ', '</p>' ); ?>



<!-- Metadatos fecha 1 -->
<?php

    $fecha1 = get_field('fecha_crea');

    if ( $fecha1 ): ?>

        <p><strong>Fecha de creación:</strong> <?php echo $fecha1; ?></p>

    <?php else: ?>
        <p><strong>Fecha de creación:</strong> N/A</p>

<?php endif; ?>


<!-- Metadatos fecha 2 -->
<?php

    $fecha2 = get_field('fecha_mod');

    if ( $fecha2 ): ?>

    <p><strong>Fecha de modificación:</strong> <?php echo $fecha2; ?></p>

<?php endif; ?>


<!-- URL source -->
<?php
    $link = get_field( 'basado_en');

    if ( $link ): ?>
        <p><strong>Basado en:</strong> <a class="button" href="<?php echo $link; ?>"><?php echo $link; ?></a></p>


<?php endif; ?>

</div>
