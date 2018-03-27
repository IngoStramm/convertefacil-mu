<?php
add_action( 'init', 'cf_admin_bar_init' );

function cf_admin_bar_init() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		// Remove itens do topbar
		add_action( 'admin_bar_menu', 'cf_remove_bar_menu_items', 999 );

		function cf_remove_bar_menu_items( $wp_admin_bar ) {
			// cf_debug( $wp_admin_bar );
			$wp_admin_bar->remove_node( 'wp-logo' );
			$wp_admin_bar->remove_node( 'site-name' );
			$wp_admin_bar->remove_node( 'search' );
			$wp_admin_bar->remove_node( 'wpseo-menu' );
			$wp_admin_bar->remove_node( 'new-blocks' );
			$wp_admin_bar->remove_node( 'new-featured_item' );
			$wp_admin_bar->remove_node( 'notes' );
			$wp_admin_bar->remove_node( 'my-sites' );
			$wp_admin_bar->remove_node( 'flatsome_panel' );
			$wp_admin_bar->remove_node( 'customize' );
			$wp_admin_bar->remove_node( 'edit' );
		}

		// Adiciona Menus Customizado à barra no topo
		add_action( 'admin_bar_menu', 'cf_add_bar_menu_itens' , 35);

		function cf_add_bar_menu_itens() {

			global $wp_admin_bar, $post;
			$post_id = $post->ID;
			$home_url = get_home_url();
			$admin_url = get_admin_url();
			// http://127.0.0.1/edsa-projetos_php/prosites/teste/wp-admin/edit.php?page=uxbuilder&post_id=18
			$edit_uxbuilder = get_admin_url().'edit.php?page=uxbuilder&post_id=' . $post_id;

			$wp_admin_bar->add_node( array(
				'id' => 'cf_panel',
				'title' => '<span class="cf-mini-logo"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'go_to_site',
				'parent' => 'cf_panel',
				'title' => __( 'Ver Site', 'cf' ),
				'href' => $home_url
			));

			$wp_admin_bar->add_node( array(
				'id' => 'go_to_admin',
				'parent' => 'cf_panel',
				'title' => __( 'Gerenciar Site', 'cf' ),
				'href' => $admin_url
			));

			if( $post_id ) :

				$wp_admin_bar->add_node( array(
				 'id' => 'cf_edit_ux_builder',
				 // 'parent' => 'cf_panel',
				 'title' => __( 'Editar', 'cf' ),
				 'href' =>  $edit_uxbuilder
				));

			endif;
		}

		add_action( 'admin_bar_menu', 'cf_edit_new_post' , 80);

		function cf_edit_new_post( $wp_admin_bar ) {
			$new_content_node = $wp_admin_bar->get_node( 'new-post' );
			$new_content_node->title = __( 'BlogPost', 'cf' );
			$wp_admin_bar->add_node( $new_content_node );
		}

	
	endif; // is_super_admin	
}