<?php
/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package pemscores
 */

// coberturas
 $cobertura = get_field('cobertura_field');

    if( $cobertura ): ?>

        <p>Cobertura:
    	<?php foreach( $cobertura as $term ): ?>

    		<span class="termino"><a href="<?php echo get_term_link( $term ); ?>"><?php echo $term->name; ?></a></span>

    	<?php endforeach; ?>
        </p>

<?php endif; ?>

<!-- tipos de recurso -->
<?php
    $tipos_recurso = get_field('tipo_recurso_field');

    if( $tipos_recurso ): ?>


    <p>Cobertura:
    <?php foreach( $tipos_recurso as $tipo ): ?>

        <span class="termino"><a href="<?php echo get_term_link( $tipo ); ?>"><?php echo $tipo->name; ?></a></span>

    <?php endforeach; ?>
    </p>


<?php endif; ?>

<!-- Formato -->
<?php

$medio = get_field('medio_field');

    if( $medio ): ?>

    	<p>Formato: <a href="<?php echo get_term_link( $medio ); ?>"><?php echo $medio->name; ?></a></p>

<?php endif; ?>

<!-- Interacciones -->
<?php
    $interaccion = get_field('interaccion_field');

    if( $interaccion ): ?>

    	<p>Tipo de interacción: <a href="<?php echo get_term_link( $interaccion ); ?>"><?php echo $interaccion->name; ?></a></p>


<?php endif; ?>
