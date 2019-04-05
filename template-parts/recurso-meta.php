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

<div class="recurso_tags">
  <!-- metadatos: autoria -->
  <?php
      $personas = get_field( 'persona' );
      $organizaciones = get_field( 'organizacion' );
      $autoria = get_field( 'autoria' );
      $ejes = get_field( 'eje_tematico' );

      if( $autoria == 'Persona' ): ?>

          <p><i class="fa fa-address-card-o" aria-hidden="true"></i> <strong><?= __('Creado por:', 'pemscores'); ?></strong>
              <?php echo get_the_term_list( $post->ID, 'autor_tag', ' ', ', ', '' ); ?>
          </p>

      <?php elseif( $autoria == 'Organización' ): ?>

          <p><i class="fa fa-university" aria-hidden="true"></i> <strong><?= __('Creado por:', 'pemscores'); ?></strong>
              <?php echo get_the_term_list( $post->ID, 'organizacion_tag', ' ', ', ', '' ); ?>
          </p>

  <?php endif; ?>

  <!-- Ejes temáticos -->
    <?= get_the_term_list(
            $post->ID, 'temas', __('<p><i class="fa fa-tag" aria-hidden="true"></i> <strong>Ejes temáticos:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

    <!-- coberturas -->
    <?= get_the_term_list(
            $post->ID, 'cobertura', __('<p><i class="fa fa-bullhorn" aria-hidden="true"></i> <strong>Cobertura:</strong> ', 'pemscores'), ', ', '</p>' ); ?>

    <!-- tipos de recurso -->
    <?= get_the_term_list(
        $post->ID, 'tipo_recurso', __('<p><i class="fa fa-file-text-o" aria-hidden="true"></i> <strong>Tipo de recurso:</strong> ', 'pemscores'), ', ', ' (' . get_the_term_list(
     $post->ID, 'tipo_medio', '', ', ', '' ) . ')</p>' ); ?>

    <!-- Formato -->


    <!-- Interacciones -->
    <?= get_the_term_list(
        $post->ID, 'interaccion', __('<p><i class="fa fa-bullseye" aria-hidden="true"></i>
<strong>Interacción:</strong> ', 'pemscores'), ', ', '</p>' ); ?>



<!-- Metadatos fecha 1 -->
<?php

    $fecha1 = get_field('fecha_crea');

    if ( $fecha1 ): ?>

        <p><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha de creación:</strong> <?php echo $fecha1; ?></p>

    <?php else: ?>
        <p><i class="fa fa-calendar" aria-hidden="true"></i> <strong>Fecha de creación:</strong> N/A</p>

<?php endif; ?>


<!-- Metadatos fecha 2 -->
<?php

    $fecha2 = get_field('fecha_mod');

    if ( $fecha2 ): ?>

    <p><i class="fa fa-calendar-plus-o" aria-hidden="true"></i> <strong>Fecha de modificación:</strong> <?php echo $fecha2; ?></p>

<?php endif; ?>


<!-- URL source -->
<?php
    $link = get_field( 'basado_en');

    if ( $link ): ?>
        <p><strong>Basado en:</strong> <a class="button" href="<?php echo $link; ?>"><?php echo $link; ?></a></p>


<?php endif; ?>

<!-- Licencia -->
<?php
  $licencia = get_field( 'licencia_select' );
  $cc = get_field( 'cc_field' );

  if ( $licencia == 'copy' ): ?>
      <p>
        <i class="fa fa-copyright" aria-hidden="true"></i>
        <?= __( 'Derechos reservados', 'pemscores'); ?>
      </p>

    <?php elseif ( $licencia == 'cc' ): ?>

      <p>
        <i class="fa fa-creative-commons" aria-hidden="true"></i>
        <strong><?= __( 'Licencia Creative Commons: ', 'pemscores'); ?></strong>
      	<?php foreach( $cc as $c ): ?>
      		<span><?php echo $c; ?></span>
      	<?php endforeach; ?>
      </p>

<?php endif; ?>

</div>
