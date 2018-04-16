<?php
add_action( 'init', 'cf_admin_bar_init' );

function cf_admin_bar_init() {

	$user_id = get_current_user_id();
	
	if( !is_super_admin( $user_id ) ) :

		// Remove itens do topbar
		add_action( 'admin_bar_menu', 'cf_remove_bar_menu_items', 999 );

		function cf_remove_bar_menu_items( $wp_admin_bar ) {


			global $post;
			$current_theme = wp_get_theme();
			$is_free_theme = $current_theme->get_stylesheet() == 'flatsome-free';
			$post_id = $post->ID;
			$home_url = get_home_url();
			$admin_url = get_admin_url();
			$edit_uxbuilder = get_admin_url().'edit.php?page=uxbuilder&post_id=' . $post_id;
			$settings = get_site_option( 'psts_settings' );
			$checkout_url = $settings[ 'checkout_url' ];

			// Salva os itens
			$my_account = $wp_admin_bar->get_node( 'my-account' );
			$comments = $wp_admin_bar->get_node( 'comments' );
			$new_content = $wp_admin_bar->get_node( 'new-content' );
			$new_content_node = $wp_admin_bar->get_node( 'new-post' );
			$logout = $wp_admin_bar->get_node( 'logout' );

			// Edita os itens salvos
			$comments->parent = 'top-secondary';
			$comments->title = '<i class="fa fa-eye"></i>';
			$new_content->parent = 'top-secondary';
			$new_content->title = '<i class="fa fa-plus-circle" title="' . __( 'Adicionar novo', 'cf' ) . '"></i>';
			$my_account->title = '<i class="fa fa-user"></i>';
			$new_content_node->title = __( 'BlogPost', 'cf' );
			$logout->parent = 'user-actions';
			

			// Remove itens
			$wp_admin_bar->remove_node( 'wp-logo' );
			$wp_admin_bar->remove_node( 'my-account' );
			$wp_admin_bar->remove_node( 'user-info' );
			// $wp_admin_bar->remove_node( 'edit-profile' );
			$wp_admin_bar->remove_node( 'logout' );
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
			$wp_admin_bar->remove_node( 'new-content' );
			$wp_admin_bar->remove_node( 'comments' );
			$wp_admin_bar->remove_node( 'view' );

			// Adiciona os itens salvos
			$wp_admin_bar->add_node( $my_account );
			// $wp_admin_bar->add_node( $comments );
			$wp_admin_bar->add_node( array(
				'id' => 'go_to_site',
				'parent' => 'top-secondary',
				// 'title' => __( 'Ver Site', 'cf' ),
				'title' => '<i class="fa fa-eye" title="' . __( 'Ver Site', 'cf' ) . '"></i>',
				'href' => $home_url
			));
			$wp_admin_bar->add_node( array(
				'id' => 'go_to_site_submenu',
				'parent' => 'go_to_site',
				'title' => __( 'Ver Site', 'cf' ),
				'href' => $home_url
			));
			$wp_admin_bar->add_node( array(
				'id' => 'go_to_admin',
				'parent' => 'go_to_site',
				'title' => __( 'Gerenciar Site', 'cf' ),
				'href' => $admin_url
			));

			if( !$is_free_theme ) :

				$wp_admin_bar->add_node( $new_content );
				$wp_admin_bar->add_node( $new_content_node );

				// Novos itens
			endif;

			$wp_admin_bar->add_node( array(
				'id' => 'cf_panel',
				'title' => '<span class="cf-mini-logo"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'separator',
				'title' => '<span class="cf-separator"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'wc-mini-logo',
				'title' => '<span class="wc-mini-logo"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'wp-mini-logo',
				'title' => '<span class="wp-mini-logo"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'fl-mini-logo',
				'title' => '<span class="fl-mini-logo"></span>'
			));

			$wp_admin_bar->add_node( array(
				'id' => 'pro-sites-checkout',
				'title' => __( 'Seu plano', 'cf' ),
				'parent' => 'user-actions',
				'href' => $checkout_url,
			));

			$wp_admin_bar->add_node( $logout );

			if( $post_id && !$is_free_theme ) :

				$wp_admin_bar->add_node( array(
				 'id' => 'cf_edit_ux_builder',
				 // 'parent' => 'cf_panel',
				 'title' => __( '<i class="fa fa-pencil"></i>', 'cf' ),
				 'href' =>  $edit_uxbuilder,
				 'parent'		=> 'top-secondary'
				));

			endif;
			
		}
	
	endif; // is_super_admin	
}