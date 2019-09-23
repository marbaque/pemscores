<?php
/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package pemscores
 */

?>
<!-- descipción -->
<?php
    //$content = get_the_content();
    //echo mb_strimwidth($content, 0, 400, '...');
    ?>

<ul class="recurso_tags">
  <!-- metadatos: autoria -->
  <?php
      $personas = get_field( 'persona' );
      $organizaciones = get_field( 'organizacion' );
      $autoria = get_field( 'autoria' );
      $ejes = get_field( 'eje_tematico' );

      if( $autoria == 'Persona' ): ?>

          
        <?php echo get_the_term_list( $post->ID, 'autor_tag', 
        __('<li><span class="fa fa-address-card-o" aria-hidden="true"></span> <strong>Creado por</strong> ' , 'pemscores'), ', ', '</li>' ); ?>
          

      <?php elseif( $autoria == 'Organización' ): ?>

          
				<?php echo get_the_term_list( $post->ID, 'organizacion_tag', __('<li><span class="fa fa-university" aria-hidden="true"></span> <strong>Creado por </strong> ', 'pemscores'), ', ', '</li>' ); ?>
          

  <?php endif; ?>

  <!-- Ejes temáticos -->
    <?php echo get_the_term_list(
            $post->ID, 'temas', __('<li><span class="fa fa-tag" aria-hidden="true"></span> <strong>Ejes temáticos:</strong> ', 'pemscores'), ', ', '</li>' ); ?>

    <!-- coberturas -->
    <?php echo get_the_term_list(
            $post->ID, 'cobertura', __('<li><span class="fa fa-map-o" aria-hidden="true"></span> <strong>Cobertura:</strong> ', 'pemscores'), ', ', '</li>' ); ?>

    <!-- tipos de recurso -->
    <?php echo get_the_term_list(
        $post->ID, 'tipo_recurso', __('<li><span class="fa fa-file-text-o" aria-hidden="true"></span> <strong>Tipo de recurso:</strong> ', 'pemscores'), ', ', ' (' . get_the_term_list(
     $post->ID, 'tipo_medio', '', ', ', '' ) . ')</li>' ); ?>

    <!-- Formato -->


    <!-- Interacciones -->
    <?php echo get_the_term_list(
        $post->ID, 'interaccion', __('<li><span class="fa fa-exchange" aria-hidden="true"></span>
<strong>Modalidad:</strong> ', 'pemscores'), ', ', '</li>' ); ?>



<!-- Metadatos fecha 1 -->
<?php

    $fecha1 = get_field('fecha_crea');

    if ( $fecha1 ): ?>

        <li><span class="fa fa-calendar" aria-hidden="true"></span> <strong>Fecha de creación:</strong> <?php echo $fecha1; ?></li>

    <?php else: ?>
        <li><span class="fa fa-calendar" aria-hidden="true"></span> <strong>Fecha de creación:</strong> N/A</li>

<?php endif; ?>


<!-- Metadatos fecha 2 -->
<?php

    $fecha2 = get_field('fecha_mod');

    if ( $fecha2 ): ?>

    <li><span class="fa fa-calendar-plus-o" aria-hidden="true"></span> <strong>Fecha de modificación:</strong> <?php echo $fecha2; ?></li>

<?php endif; ?>


<!-- URL source -->
<?php
    $link = get_field( 'basado_en');

    if ( $link ): ?>
        <li><span class="fa fa-external-link" aria-hidden="true"></span> <strong>Basado en:</strong> <a class="button" href="<?php echo $link; ?>"><?php echo $link; ?></a></li>


<?php endif; ?>

<!-- Licencia -->
<?php
  $licencia = get_field( 'licencia_select' );
  $cc = get_field( 'cc_field' );

  if ( $licencia == 'copy' ): ?>
      <li>
        <span class="fa fa-copyright" aria-hidden="true"></span>
        <?php echo __( 'Derechos reservados', 'pemscores'); ?>
      </li>

    <?php elseif ( $licencia == 'cc' ): ?>

    <li class="cc-license">
        
        <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/4.0/"><img alt="<?php echo __('Licencia Creative Commons', 'pemscores'); ?>" style="border-width:0" src="https://i.creativecommons.org/l/by-nc-sa/4.0/88x31.png" /></a><br /><?php echo __('Esta obra está bajo una <a rel="license" href="https://creativecommons.org/licenses/by-nc-sa/4.0//deed.es">Licencia Creative Commons Atribución-NoComercial-CompartirIgual 4.0 Internacional</a>.', 'pemscores'); ?>
    </li>

    <?php elseif ( $licencia == 'none' ): ?>

    <li class="no-license">
        <i class="small">Licencia de uso desconocida</i>
    </li>

<?php endif; ?>

</ul>
