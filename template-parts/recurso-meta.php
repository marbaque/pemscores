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
    $content = get_the_content();
    echo mb_strimwidth($content, 0, 400, '...');
    ?>

<ul class="recurso_tags">
  <!-- metadatos: autoria -->
  <?php
      $personas = get_field( 'persona' );
      $organizaciones = get_field( 'organizacion' );
      $autoria = get_field( 'autoria' );
      $ejes = get_field( 'eje_tematico' );

      if( $autoria == 'Persona' ): ?>

          <li><i class="fa fa-address-card-o" aria-hidden="true"></i> <strong><?= __('Creado por:', 'pemscores'); ?></strong>
              <?php echo get_the_term_list( $post->ID, 'autor_tag', ' ', ', ', '' ); ?>
          </li>

      <?php elseif( $autoria == 'Organización' ): ?>

          <li><i class="fa fa-university" aria-hidden="true"></i> <strong><?= __('Creado por:', 'pemscores'); ?></strong>
              <?php echo get_the_term_list( $post->ID, 'organizacion_tag', ' ', ', ', '' ); ?>
          </li>

  <?php endif; ?>

  <!-- Ejes temáticos -->
    <?= get_the_term_list(
            $post->ID, 'temas', __('<li><i class="fa fa-tag" aria-hidden="true"></i> <strong>Ejes temáticos:</strong> ', 'pemscores'), ', ', '</li>' ); ?>

    <!-- coberturas -->
    <?= get_the_term_list(
            $post->ID, 'cobertura', __('<li><i class="fa fa-bullhorn" aria-hidden="true"></i> <strong>Cobertura:</strong> ', 'pemscores'), ', ', '</li>' ); ?>

    <!-- tipos de recurso -->
    <?= get_the_term_list(
        $post->ID, 'tipo_recurso', __('<li><i class="fa fa-file-text-o" aria-hidden="true"></i> <strong>Tipo de recurso:</strong> ', 'pemscores'), ', ', ' (' . get_the_term_list(
     $post->ID, 'tipo_medio', '', ', ', '' ) . ')</li>' ); ?>

    <!-- Formato -->


    <!-- Interacciones -->
    <?= get_the_term_list(
        $post->ID, 'interaccion', __('<li><i class="fa fa-exchange" aria-hidden="true"></i>
<strong>Modalidad:</strong> ', 'pemscores'), ', ', '</li>' ); ?>



<!-- Metadatos fecha 1 -->
<?php

    $fecha1 = get_field('fecha_crea');

    if ( $fecha1 ): ?>

        <li><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha de creación:</strong> <?php echo $fecha1; ?></li>

    <?php else: ?>
        <li><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha de creación:</strong> N/A</li>

<?php endif; ?>


<!-- Metadatos fecha 2 -->
<?php

    $fecha2 = get_field('fecha_mod');

    if ( $fecha2 ): ?>

    <li><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <strong>Fecha de modificación:</strong> <?php echo $fecha2; ?></li>

<?php endif; ?>


<!-- URL source -->
<?php
    $link = get_field( 'basado_en');

    if ( $link ): ?>
        <li><i class="fa fa-external-link" aria-hidden="true"></i> <strong>Basado en:</strong> <a class="button" href="<?php echo $link; ?>"><?php echo $link; ?></a></li>


<?php endif; ?>

<!-- Licencia -->
<?php
  $licencia = get_field( 'licencia_select' );
  $cc = get_field( 'cc_field' );

  if ( $licencia == 'copy' ): ?>
      <li>
        <i class="fa fa-copyright" aria-hidden="true"></i>
        <?= __( 'Derechos reservados', 'pemscores'); ?>
      </li>

    <?php elseif ( $licencia == 'cc' ): ?>

      <li class="cc">
        <i class="fa fa-creative-commons" aria-hidden="true"></i>
        <strong><?= __( 'Licencia Creative Commons: ', 'pemscores'); ?></strong>
      	<?php foreach( $cc as $c ): ?>
      		<span><?php echo $c; ?></span>
      	<?php endforeach; ?>
      </li>

<?php endif; ?>

</ul>
