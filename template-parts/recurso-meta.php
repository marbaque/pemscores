<?php
/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package pemscores
 */

?>

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

        <p><strong><?php echo __('Organización:', 'pemscores'); ?></strong>
            <?php echo get_the_term_list( $post->ID, 'organizacion_tag', ' ', ', ', '' ); ?>
        </p>

<?php endif; ?>

<!-- descipción -->
<?php
    $content = get_the_content( sprintf(
        /* translators: %s: Name of current post. */
        wp_kses( __( 'Continuar leyendo %s <span class="meta-nav">&rarr;</span>', 'pemscores' ), array( 'span' => array( 'class' => array() ) ) ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ) );

    mb_strimwidth($content, 0, 400, '...');

    wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Páginas:', 'pemscores' ),
        'after'  => '</div>',
    ) );
    ?>

<div class="recurso_tags">
<!-- coberturas -->
<?php
 $cobertura = get_field('cobertura_field');

    if( $cobertura ): ?>
        <p><strong><?php echo __('Cobertura:', 'pemscores'); ?></strong>
        <?php echo get_the_term_list(
            $post->ID,
            'cobertura',
            ' ',
            ', ',
            ''
        ); ?>
    </p>

<?php endif; ?>


<!-- tipos de recurso -->
<?php
    $tipos_recurso = get_field('tipo_recurso_field');

    if( $tipos_recurso ): ?>

    <p><strong><?php echo __('Tipo de recurso:', 'pemscores'); ?></strong>

        <?php echo get_the_term_list(
            $post->ID,
            'tipo_recurso',
            ' ',
            ', ',
            ''
        ); ?>
    </p>

<?php endif; ?>


<!-- Formato -->
<?php

    $medio = get_field('medio_field');

    if( $medio ): ?>

    	<p><strong>Formato:</strong> <a href="<?php echo get_term_link( $medio ); ?>"><?php echo $medio->name; ?></a></p>

<?php endif; ?>

<!-- Interacciones -->
<?php
    $interaccion = get_field('interaccion_field');

    if( $interaccion ): ?>

    	<p><strong>Tipo de interacción:</strong> <a href="<?php echo get_term_link( $interaccion ); ?>"><?php echo $interaccion->name; ?></a></p>


<?php endif; ?>


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
