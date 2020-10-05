<?php
/**
 * Custom fields
 *
 * fuente: https://gist.github.com/taniarascia/9edee074b04569c00343a6a1045235e7
 *
 */

function add_page_options_meta_box() {
  add_meta_box(
    'page_options_meta_box', // $id
    __( 'Opciones de página', 'pemscores' ), // $title
    'show_page_options_meta_box', // $callback
    'page', // $screen
    'normal', // $context
    'high' // $priority
  );
}
add_action( 'add_meta_boxes', 'add_page_options_meta_box' );

function show_page_options_meta_box() {
  global $post;
  $meta = get_post_meta( $post->ID, 'page_options', true ); ?>

  <input type="hidden" name="your_meta_box_nonce" value="<?php echo wp_create_nonce( basename(__FILE__) ); ?>">

    <!-- All fields will go here -->
    <h3><?= esc_html__('Título de página', 'pemscores'); ?></h3>
    <p>
    	<label for="page_options[checkbox]">
        <input type="checkbox" name="page_options[checkbox]" value="checkbox" 
        <?php if (is_array($meta) && isset($meta['checkbox'])) {	if ( $meta['checkbox'] === 'checkbox' ) echo 'checked'; } ?>>
        <?= esc_html__('Ocultar título de página', 'pemscores'); ?>
    	</label>
    </p>

    <hr>
    
    <h3><?= esc_html__('Subtítulo', 'pemscores'); ?></h3>
    <p>
      <label for="page_options[subtitle]">
        <?= esc_html__('Agregar un subtítulo a la página', 'pemscores'); ?>
      </label>
      <br>
      <input type="text" name="page_options[subtitle]" id="page_options[subtitle]" size="80" class="subheader" value="<?php if (is_array($meta) && isset($meta['subtitle'])) {	echo $meta['subtitle']; } ?>">
    </p>

    

  <?php }

function save_page_options_meta( $post_id ) {   
	// verify nonce
	if ( isset($_POST['your_meta_box_nonce']) 
			&& !wp_verify_nonce( $_POST['your_meta_box_nonce'], basename(__FILE__) ) ) {
			return $post_id; 
		}
	// check autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return $post_id;
	}
	// check permissions
	if (isset($_POST['page'])) { //Fix 2
        if ( 'page' === $_POST['page'] ) {
            if ( !current_user_can( 'edit_page', $post_id ) ) {
                return $post_id;
            } elseif ( !current_user_can( 'edit_post', $post_id ) ) {
                return $post_id;
            }  
        }
    }
	
	$old = get_post_meta( $post_id, 'page_options', true );
		if (isset($_POST['page_options'])) { //Fix 3
			$new = $_POST['page_options'];
			if ( $new && $new !== $old ) {
				update_post_meta( $post_id, 'page_options', $new );
			} elseif ( '' === $new && $old ) {
				delete_post_meta( $post_id, 'page_options', $old );
			}
		}
}
add_action( 'save_post', 'save_page_options_meta' );


// Campos de agenda y galería de sitios
if( function_exists('acf_add_local_field_group') ):

  acf_add_local_field_group(array(
    'key' => 'group_5f3fe8a11b612',
    'title' => 'Bloque: Agenda',
    'fields' => array(
      array(
        'key' => 'field_5f3feb3478da7',
        'label' => 'Título',
        'name' => 'titulo_agenda',
        'type' => 'text',
        'instructions' => 'Agregue un título a la agenda.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => 'Día 1: Visita de pares',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5f3feaec0d1d0',
        'label' => 'Fecha',
        'name' => 'fecha_agenda',
        'type' => 'date_picker',
        'instructions' => 'El día de la reunión.',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'display_format' => 'd/m/Y',
        'return_format' => 'l j de F, Y',
        'first_day' => 0,
      ),
      array(
        'key' => 'field_5f3fe99c0d1cd',
        'label' => 'Ítems de la agenda',
        'name' => 'items_agenda',
        'type' => 'repeater',
        'instructions' => 'Añada la información de los diferentes eventos de la visita.',
        'required' => 1,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_5f3fe9c80d1ce',
        'min' => 1,
        'max' => 12,
        'layout' => 'row',
        'button_label' => 'Añadir un evento',
        'sub_fields' => array(
          array(
            'key' => 'field_5f3fe9c80d1ce',
            'label' => 'Evento',
            'name' => 'item_evento',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '100',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5f3fe9f90d1cf',
            'label' => 'Inicio',
            'name' => 'hora1_evento',
            'type' => 'time_picker',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '30',
              'class' => '',
              'id' => '',
            ),
            'display_format' => 'g:i a',
            'return_format' => 'g:i a',
          ),
          array(
            'key' => 'field_5f3fec1be3388',
            'label' => 'Final',
            'name' => 'hora2_evento',
            'type' => 'time_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '20',
              'class' => '',
              'id' => '',
            ),
            'display_format' => 'g:i a',
            'return_format' => 'g:i a',
          ),
          array(
            'key' => 'field_5f3fecb9ec57e',
            'label' => 'Info',
            'name' => 'info_evento',
            'type' => 'textarea',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => 4,
            'new_lines' => 'br',
          ),
          array(
            'key' => 'field_5f3fed570bdd2',
            'label' => 'Enlace',
            'name' => 'pagina_evento',
            'type' => 'link',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'array',
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/agenda',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'seamless',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'modified' => 1598582993,
  ));
  
  acf_add_local_field_group(array(
    'key' => 'group_5f63846546888',
    'title' => 'Bloque: Galería de sitios',
    'fields' => array(
      array(
        'key' => 'field_5f6387e3734bf',
        'label' => 'Título de la galería de sitios',
        'name' => 'mu_titulo',
        'type' => 'text',
        'instructions' => 'Este título no es visible para el usuario final.',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'default_value' => '',
        'placeholder' => '',
        'prepend' => '',
        'append' => '',
        'maxlength' => '',
      ),
      array(
        'key' => 'field_5f638472804e4',
        'label' => 'Lista de sitios',
        'name' => 'mu_sitios',
        'type' => 'repeater',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => array(
          'width' => '',
          'class' => '',
          'id' => '',
        ),
        'collapsed' => 'field_5f63873c5622e',
        'min' => 1,
        'max' => 0,
        'layout' => 'block',
        'button_label' => '',
        'sub_fields' => array(
          array(
            'key' => 'field_5f6386b85622c',
            'label' => 'Portada',
            'name' => 'mu_portada',
            'type' => 'image',
            'instructions' => 'Si no se agrega una imagen de portada, una imagen predefinida se mostrará en su lugar.',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'id',
            'preview_size' => 'medium',
            'library' => 'all',
            'min_width' => 800,
            'min_height' => '',
            'min_size' => '',
            'max_width' => 3000,
            'max_height' => '',
            'max_size' => '',
            'mime_types' => '',
          ),
          array(
            'key' => 'field_5f6387165622d',
            'label' => 'Enlace',
            'name' => 'mu_enlace',
            'type' => 'link',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'return_format' => 'url',
          ),
          array(
            'key' => 'field_5f63873c5622e',
            'label' => 'Nombre del sitio',
            'name' => 'mu_nombre',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => 'Título del enlace',
            'placeholder' => '',
            'prepend' => '',
            'append' => '',
            'maxlength' => '',
          ),
          array(
            'key' => 'field_5f6387605622f',
            'label' => 'Información',
            'name' => 'mu_info',
            'type' => 'textarea',
            'instructions' => 'Breve descripción del sitio',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'default_value' => '',
            'placeholder' => '',
            'maxlength' => '',
            'rows' => 3,
            'new_lines' => 'wpautop',
          ),
          array(
            'key' => 'field_5f77de0218e3e',
            'label' => 'Fecha',
            'name' => 'mu_fecha',
            'type' => 'date_picker',
            'instructions' => '',
            'required' => 0,
            'conditional_logic' => 0,
            'wrapper' => array(
              'width' => '',
              'class' => '',
              'id' => '',
            ),
            'display_format' => 'd/m/Y',
            'return_format' => 'j \\d\\e F, Y',
            'first_day' => 0,
          ),
        ),
      ),
    ),
    'location' => array(
      array(
        array(
          'param' => 'block',
          'operator' => '==',
          'value' => 'acf/sitios',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
  ));
  
  endif;