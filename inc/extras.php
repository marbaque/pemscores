<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package pemscores
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function pemscores_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
		$classes[] = 'archive-view';
	}

	// Add a class telling us if the sidebar is in use.
	if ( is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-sidebar';
	} else {
		$classes[] = 'no-sidebar';
	}

	// Add a class telling us if the page sidebar is in use.
	if ( is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'has-page-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'pemscores_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function pemscores_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', bloginfo( 'pingback_url' ), '">';
	}
}
add_action( 'wp_head', 'pemscores_pingback_header' );


//Edit the Dashboard Footer
function change_admin_footer(){
	 echo '<p id="footer-note">Desarrollado por <span><a href="http://multimedia.uned.ac.cr/" target="_blank">Multimedia UNED</a></span>.</p>';
	}
add_filter('admin_footer_text', 'change_admin_footer');

// Editor styles
/**
 * Enqueue block editor style
 */
function legit_block_editor_styles() {
	wp_enqueue_style( 'legit-editor-styles', get_theme_file_uri( '/inc/editor-styles.css' ), false, '1.0', 'all' );
}
add_action( 'enqueue_block_editor_assets', 'legit_block_editor_styles' );

/* 
** Migajas personalizadas 
*/
function pemscores_breadcrumbs() {
  
  $delimiter = '<span class="separator">></span>';
  $name = 'Inicio'; //text for the 'Home' link
  $currentBefore = '<li><span class="current-item">';
  $currentAfter = '</span></li>';
  
  if ( !is_home() && !is_front_page() || is_paged() ) {
  
    echo '<ul id="breadcrumbs">';
  
    global $post;
    $home = get_bloginfo('url');
    echo '<li><a href="' . $home . '">' . $name . '</a></li>' . $delimiter;
  
    if ( is_category() ) {
      global $wp_query;
      $cat_obj = $wp_query->get_queried_object();
      $thisCat = $cat_obj->term_id;
      $thisCat = get_category($thisCat);
      $parentCat = get_category($thisCat->parent);
      if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter));
      echo $currentBefore . 'Archivado en categoría &#39;';
      single_cat_title();
      echo '&#39;' . $currentAfter;
  
    } elseif ( is_day() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter;
      echo '<li><a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a></li>' . $delimiter . ' ';
      echo $currentBefore . get_the_time('d') . $currentAfter;
  
    } elseif ( is_month() ) {
      echo '<li><a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a></li>' . $delimiter;
      echo $currentBefore . get_the_time('F') . $currentAfter;
  
    } elseif ( is_year() ) {
      echo $currentBefore . get_the_time('Y') . $currentAfter;
  
    } elseif ( is_single() && !is_attachment() ) {
			$cat = get_the_category(); $cat = $cat[0];
			echo '<li>';
      echo get_category_parents($cat, TRUE, ' ' . '</li>' . $delimiter);
      echo $currentBefore;
      the_title();
      echo $currentAfter;
  
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
      echo '<li><a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a></li>' . $delimiter;
      echo $currentBefore;
      the_title();
      echo $currentAfter;
  
    } elseif ( is_page() && !$post->post_parent ) {
      echo $currentBefore;
      the_title();
      echo $currentAfter;
  
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = '<li><a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a></li>';
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      foreach ($breadcrumbs as $crumb) echo $crumb . ' ' . $delimiter;
      echo $currentBefore;
      the_title();
      echo $currentAfter;
  
    } elseif ( is_search() ) {
      echo $currentBefore . 'Resultados para &#39;' . get_search_query() . '&#39;' . $currentAfter;
  
    } elseif ( is_tag() ) {
      echo $currentBefore . 'Entradas etiquetadas como &#39;';
      single_tag_title();
      echo '&#39;' . $currentAfter;
  
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $currentBefore . 'Entradas publicadas por ' . $userdata->display_name . $currentAfter;
  
    } elseif ( is_404() ) {
      echo $currentBefore . 'Error 404' . $currentAfter;
    }
  
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Página') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  
    echo '</ul>';
  
  }
}
