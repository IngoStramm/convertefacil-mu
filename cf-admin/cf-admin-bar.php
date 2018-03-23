<?php
add_action( 'init', 'cf_admin_bar_init' );

function cf_admin_bar_init() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		// Remove itens do topbar
		add_action( 'admin_bar_menu', 'cf_remove_bar_menu_items', 999 );

		function cf_remove_bar_menu_items( $wp_admin_bar ) {
			$wp_admin_bar->remove_node( 'wp-logo' );
			$wp_admin_bar->remove_node( 'site-name' );
			$wp_admin_bar->remove_node( 'search' );
			$wp_admin_bar->remove_node( 'wpseo-menu' );
			$wp_admin_bar->remove_node( 'new-blocks' );
			$wp_admin_bar->remove_node( 'new-featured_item' );
			$wp_admin_bar->remove_node( 'notes' );
		}

		// Adiciona Menus Customizado à barra no topo
		add_action( 'admin_bar_menu', 'cf_admin_bar' , 35);

		function cf_admin_bar() {

			global $wp_admin_bar;
			$home_url = get_home_url();
			$admin_url = get_admin_url();

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

		}
	
	endif; // is_super_admin	
}