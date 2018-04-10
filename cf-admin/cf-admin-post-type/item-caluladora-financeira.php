<?php
$current_blog_id = get_current_blog_id();

if( $current_blog_id != 1 )
	return;

add_action( 'init', 'item_calculadora_financeira' );
/**
 * Register a book post type.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_post_type
 */
function item_calculadora_financeira() {
	$labels = array(
		'name'               => _x( 'Itens', 'post type general name', 'cf' ),
		'singular_name'      => _x( 'Item', 'post type singular name', 'cf' ),
		'menu_name'          => _x( 'Itens', 'admin menu', 'cf' ),
		'name_admin_bar'     => _x( 'Item', 'add new on admin bar', 'cf' ),
		'add_new'            => _x( 'Adicionar novo', 'item', 'cf' ),
		'add_new_item'       => __( 'Adicionar novo item', 'cf' ),
		'new_item'           => __( 'Novo item', 'cf' ),
		'edit_item'          => __( 'Editar item', 'cf' ),
		'view_item'          => __( 'Ver item', 'cf' ),
		'all_items'          => __( 'Todos os itens', 'cf' ),
		'search_items'       => __( 'Pesquisar itens', 'cf' ),
		'parent_item_colon'  => __( 'Itens pai:', 'cf' ),
		'not_found'          => __( 'Nenhum item encontrado.', 'cf' ),
		'not_found_in_trash' => __( 'Nenhum item encontrado na lixeira.', 'cf' )			
	);

	$args = array(
		'labels'             => $labels,
                'description'        => __( 'Descrição.', 'cf' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'item-calculadora' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'page-attributes', 'revisions' )
	);

	register_post_type( 'item-calculadora', $args );
}