<?php

function cptui_register_my_cpts() {

	/**
	 * Post Type: Recursos.
	 */

	$labels = array(
		"name" => __( "Recursos", "pemscores" ),
		"singular_name" => __( "Recurso", "pemscores" ),
		"menu_name" => __( "Mis recursos", "pemscores" ),
		"all_items" => __( "Todos los recursos", "pemscores" ),
		"add_new" => __( "Añadir nuevo", "pemscores" ),
		"add_new_item" => __( "Añadir recurso nuevo", "pemscores" ),
		"edit_item" => __( "Editar recurso", "pemscores" ),
		"new_item" => __( "Recurso nuevo", "pemscores" ),
		"view_item" => __( "Ver recurso", "pemscores" ),
		"view_items" => __( "Ver recursos", "pemscores" ),
		"search_items" => __( "Buscar recurso", "pemscores" ),
		"not_found" => __( "No hay recursos", "pemscores" ),
		"not_found_in_trash" => __( "No se encontraron recursos en la papelera", "pemscores" ),
		"parent_item_colon" => __( "Recurso padre", "pemscores" ),
		"featured_image" => __( "Portada de recurso", "pemscores" ),
		"set_featured_image" => __( "Fijar portada del recurso", "pemscores" ),
		"remove_featured_image" => __( "Quitar la portada del recurso", "pemscores" ),
		"use_featured_image" => __( "Usar como portada del recurso", "pemscores" ),
		"archives" => __( "Listado de recursos", "pemscores" ),
		"insert_into_item" => __( "Insertar en la descripción del recurso", "pemscores" ),
		"uploaded_to_this_item" => __( "Subido a este recurso", "pemscores" ),
		"filter_items_list" => __( "Filtrar lista de recursos", "pemscores" ),
		"items_list_navigation" => __( "Navegación de lista de recursos", "pemscores" ),
		"items_list" => __( "Listado de recursos", "pemscores" ),
		"attributes" => __( "Atributos de recursos", "pemscores" ),
		"name_admin_bar" => __( "Recurso", "pemscores" ),
		"parent_item_colon" => __( "Recurso padre", "pemscores" ),
	);

	$args = array(
		"label" => __( "Recursos", "pemscores" ),
		"labels" => $labels,
		"description" => "Recursos educativos y de gestión del Instituto.",
		"public" => true,
		"publicly_queryable" => true,
		"show_ui" => true,
		"delete_with_user" => false,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"has_archive" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"exclude_from_search" => false,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"rewrite" => array( "slug" => "recursos", "with_front" => true ),
		"query_var" => true,
		"menu_position" => 4,
		"menu_icon" => "dashicons-paperclip",
		"supports" => array( "title", "editor", "excerpt" ),
		"taxonomies" => array( "post_tag" ),
	);

	register_post_type( "recurso", $args );
}

add_action( 'init', 'cptui_register_my_cpts' );



function cptui_register_my_taxes() {

	/**
	 * Taxonomy: Organizaciones.
	 */

	$labels = array(
		"name" => __( "Organizaciones", "pemscores" ),
		"singular_name" => __( "Organización", "pemscores" ),
		"menu_name" => __( "Organizaciones", "pemscores" ),
		"all_items" => __( "Todas", "pemscores" ),
		"edit_item" => __( "Editar organización", "pemscores" ),
		"view_item" => __( "Ver organización", "pemscores" ),
		"update_item" => __( "Actualizar nombre de organización", "pemscores" ),
		"add_new_item" => __( "Añadir una organización", "pemscores" ),
		"new_item_name" => __( "Nombre de la organización nueva", "pemscores" ),
		"parent_item" => __( "Organización superior", "pemscores" ),
		"parent_item_colon" => __( "Organización superior:", "pemscores" ),
		"search_items" => __( "Buscar organizaciones", "pemscores" ),
		"popular_items" => __( "Organizaciones más utilizadas", "pemscores" ),
		"separate_items_with_commas" => __( "Separar organizaciones con comas", "pemscores" ),
		"add_or_remove_items" => __( "Añadir o quitar organizaciones", "pemscores" ),
		"choose_from_most_used" => __( "Elija de las más utilizadas", "pemscores" ),
		"not_found" => __( "No se encontraron organizaciones", "pemscores" ),
		"no_terms" => __( "No hay organizaciones", "pemscores" ),
		"items_list_navigation" => __( "Navegación de lista de organizaciones", "pemscores" ),
		"items_list" => __( "Lista de organizaciones", "pemscores" ),
	);

	$args = array(
		"label" => __( "Organizaciones", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'organizacion_tag', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "organizacion_tag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "organizacion_tag", array( "recurso" ), $args );

	/**
	 * Taxonomy: Autores.
	 */

	$labels = array(
		"name" => __( "Autores", "pemscores" ),
		"singular_name" => __( "Autor", "pemscores" ),
		"menu_name" => __( "Autores", "pemscores" ),
		"all_items" => __( "Todos los autores", "pemscores" ),
		"edit_item" => __( "Editar autor", "pemscores" ),
		"view_item" => __( "Ver autor", "pemscores" ),
		"update_item" => __( "Actualizar el autor", "pemscores" ),
		"add_new_item" => __( "Añadir un autor", "pemscores" ),
		"new_item_name" => __( "Nombre del nuevo autor o autora", "pemscores" ),
		"parent_item" => __( "Autor vinculado", "pemscores" ),
		"parent_item_colon" => __( "Vinculado a autor:", "pemscores" ),
		"search_items" => __( "Buscar autores", "pemscores" ),
		"popular_items" => __( "Autores frecuentes", "pemscores" ),
		"separate_items_with_commas" => __( "Separar autores por comas", "pemscores" ),
		"add_or_remove_items" => __( "Añadir o quitar autores", "pemscores" ),
		"choose_from_most_used" => __( "Elija los más frecuentes", "pemscores" ),
		"not_found" => __( "No se encontraron autores", "pemscores" ),
		"no_terms" => __( "No hay autores", "pemscores" ),
		"items_list_navigation" => __( "Navegación de lista de autores", "pemscores" ),
		"items_list" => __( "Lista de autores y autoras", "pemscores" ),
	);

	$args = array(
		"label" => __( "Autores", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'autor_tag', 'with_front' => true,  'hierarchical' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => false,
		"rest_base" => "autor_tag",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "autor_tag", array( "recurso" ), $args );

	/**
	 * Taxonomy: Coberturas.
	 */

	$labels = array(
		"name" => __( "Coberturas", "pemscores" ),
		"singular_name" => __( "Cobertura", "pemscores" ),
		"menu_name" => __( "Cobertura", "pemscores" ),
		"all_items" => __( "Todas", "pemscores" ),
		"edit_item" => __( "Editar cobertura", "pemscores" ),
		"view_item" => __( "Ver cobertura", "pemscores" ),
		"update_item" => __( "Actualizar cobertura", "pemscores" ),
		"add_new_item" => __( "Añadir tipo de cobertura", "pemscores" ),
		"new_item_name" => __( "Cobertura nueva", "pemscores" ),
		"parent_item" => __( "Cobertura superior", "pemscores" ),
		"parent_item_colon" => __( "Vinculada a cobertura:", "pemscores" ),
		"search_items" => __( "Buscar coberturas", "pemscores" ),
		"popular_items" => __( "Tipos de cobertura más utilizados", "pemscores" ),
		"separate_items_with_commas" => __( "Separa cobertura con comas", "pemscores" ),
		"add_or_remove_items" => __( "Añadir o quitar tipo de cobertura", "pemscores" ),
		"choose_from_most_used" => __( "Elija las más frecuentes", "pemscores" ),
		"not_found" => __( "No se encontraron tipos de cobertura", "pemscores" ),
		"no_terms" => __( "No hay tipos de cobertura", "pemscores" ),
		"items_list_navigation" => __( "Navegación de listado de cobertura", "pemscores" ),
		"items_list" => __( "Listado de cobertura", "pemscores" ),
	);

	$args = array(
		"label" => __( "Coberturas", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => true,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'cobertura', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "cobertura",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => true,
		);
	register_taxonomy( "cobertura", array( "recurso" ), $args );

	/**
	 * Taxonomy: Tipos de recurso.
	 */

	$labels = array(
		"name" => __( "Tipos de recurso", "pemscores" ),
		"singular_name" => __( "Tipo de recurso", "pemscores" ),
		"menu_name" => __( "Tipos de recurso", "pemscores" ),
		"all_items" => __( "Todos", "pemscores" ),
		"edit_item" => __( "Editar tipo de recurso", "pemscores" ),
		"view_item" => __( "Ver tipo de recurso", "pemscores" ),
		"update_item" => __( "Actualizar atributo", "pemscores" ),
		"add_new_item" => __( "Añadir atributo", "pemscores" ),
		"new_item_name" => __( "Nombre del tipo de recurso", "pemscores" ),
		"parent_item" => __( "Atributo superior", "pemscores" ),
		"parent_item_colon" => __( "Vinculado a tipo:", "pemscores" ),
		"search_items" => __( "Buscar tipos", "pemscores" ),
		"popular_items" => __( "Tipos de recurso frecuentes", "pemscores" ),
		"separate_items_with_commas" => __( "Separar categorías con comas", "pemscores" ),
		"add_or_remove_items" => __( "Añadir o quitar categorías", "pemscores" ),
		"choose_from_most_used" => __( "Elija entre los más frecuentes", "pemscores" ),
		"not_found" => __( "No se encontraron tipos de recurso", "pemscores" ),
		"no_terms" => __( "No hay términos", "pemscores" ),
		"items_list_navigation" => __( "Navegación de tipos de recurso", "pemscores" ),
		"items_list" => __( "Lista de tipos de recurso", "pemscores" ),
	);

	$args = array(
		"label" => __( "Tipos de recurso", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'tipo_recurso', 'with_front' => true, ),
		"show_admin_column" => true,
		"show_in_rest" => true,
		"rest_base" => "tipo_recurso",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "tipo_recurso", array( "recurso" ), $args );

	/**
	 * Taxonomy: Tipos de medio.
	 */

	$labels = array(
		"name" => __( "Formato", "pemscores" ),
		"singular_name" => __( "Formato", "pemscores" ),
    "plural_name" => __( "Formatos", "pemscores" ),
		"menu_name" => __( "Formato", "pemscores" ),
		"all_items" => __( "Todos", "pemscores" ),
		"edit_item" => __( "Editar formato", "pemscores" ),
		"view_item" => __( "Ver formato", "pemscores" ),
		"update_item" => __( "Actualizar nombre de formato", "pemscores" ),
		"add_new_item" => __( "Añadir tipo de formato", "pemscores" ),
		"new_item_name" => __( "Nombre del formato nuevo", "pemscores" ),
		"parent_item" => __( "Formato superior", "pemscores" ),
		"parent_item_colon" => __( "Formato superior:", "pemscores" ),
		"search_items" => __( "Buscar formatos", "pemscores" ),
		"popular_items" => __( "Formatos frecuentes", "pemscores" ),
		"separate_items_with_commas" => __( "Separar formatos con comas", "pemscores" ),
		"add_or_remove_items" => __( "Añadir o quitar formatos", "pemscores" ),
		"choose_from_most_used" => __( "Elija entre los más frecuentes", "pemscores" ),
		"not_found" => __( "No se encontraron formatos", "pemscores" ),
		"no_terms" => __( "No hay formatos", "pemscores" ),
		"items_list_navigation" => __( "Navegación de lista de formatos", "pemscores" ),
		"items_list" => __( "Lista de formatos", "pemscores" ),
	);

	$args = array(
		"label" => __( "Tipos de medio", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'tipo_medio', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "tipo_medio",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "tipo_medio", array( "recurso" ), $args );

	/**
	 * Taxonomy: Tipos de interacción.
	 */

	$labels = array(
		"name" => __( "Tipos de interacción", "pemscores" ),
		"singular_name" => __( "Tipo de interacción", "pemscores" ),
		"all_items" => __( "Todas", "pemscores" ),
	);

	$args = array(
		"label" => __( "Tipos de interacción", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'interaccion', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "interaccion",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "interaccion", array( "recurso" ), $args );

	/**
	 * Taxonomy: Ejes Temáticos
	 */

	$labels = array(
		"name" => __( "Ejes temáticos", "pemscores" ),
		"singular_name" => __( "Eje temático", "pemscores" ),
		"all_items" => __( "Todos", "pemscores" ),
	);

	$args = array(
		"label" => __( "Ejes temáticos", "pemscores" ),
		"labels" => $labels,
		"public" => true,
		"publicly_queryable" => true,
		"hierarchical" => false,
		"show_ui" => true,
		"show_in_menu" => true,
		"show_in_nav_menus" => true,
		"query_var" => true,
		"rewrite" => array( 'slug' => 'temas', 'with_front' => true, ),
		"show_admin_column" => false,
		"show_in_rest" => true,
		"rest_base" => "interaccion",
		"rest_controller_class" => "WP_REST_Terms_Controller",
		"show_in_quick_edit" => false,
		);
	register_taxonomy( "temas", array( "recurso" ), $args );
}
add_action( 'init', 'cptui_register_my_taxes' );
