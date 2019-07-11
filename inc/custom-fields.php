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