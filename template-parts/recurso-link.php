<?php
/**
 * Template part for displaying custom fields.
 *
 * @link https://www.advancedcustomfields.com/resources/taxonomy/
 *
 * @package pemscores
 */

?>

<!-- archivo o url -->
<?php
    $fuente = get_field('fuente');
    $url = get_field('url_externo');
    $file = get_field('subir_arch');

    if( $fuente == 'ext' ): ?>

        <?php if( $url ): ?>
        <div class="recurso_tags recurso-link">
            <p><i class="fa fa-external-link" aria-hidden="true"></i> <strong><?php echo __('Enlace:', 'pemscores'); ?></strong>
                <a href="<?php echo $url; ?>" target="_blank" title="<?php echo __('Enlace a recurso', 'pemscores'); ?>"><?php echo $url; ?></a>
            </p>
        </div>
        <?php endif; ?>

    <?php elseif( $fuente == 'int' ): ?>

        <?php if( $file ): ?>
        <div class="recurso_tags recurso-link">
            <p><i class="fa fa-cloud-download" aria-hidden="true"></i> <strong><?php echo __('Archivo:', 'pemscores'); ?></strong> <a href="<?php echo $file['url']; ?>"><?php echo $file['filename']; ?> </a>
           </p>
        </div>
        <?php endif; ?>

<?php endif; ?>
