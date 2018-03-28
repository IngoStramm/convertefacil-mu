<?php

add_action( 'cmb2_admin_init', 'cf_register_vendas_e_pagamento_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function cf_register_vendas_e_pagamento_options_metabox() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		/**
		 * Registers options page menu item and form.
		 */
		$cmb_options = new_cmb2_box( array(
			'id'           => 'cf_vendas_e_pagamento',
			'title'        => esc_html__( 'Vendas e Pagamento', 'cf' ),
			'object_types' => array( 'options-page' ),

			/*
			 * The following parameters are specific to the options-page box
			 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
			 */

			'option_key'      => 'cf_formas_pagamento', // The option key and admin menu page slug.
			'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
			// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
			// 'parent_slug'     => 'cf-logo', // Make options page a submenu item of the themes menu.
			'capability'      => 'manage_options', // Cap required to view options-page.
			'position'        => 10, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
			// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
			// 'message_cb'      => 'cf_options_vendas_e_pagamento_message_callback',
		) );

		/**
		 * Options fields ids only need
		 * to be unique within this box.
		 * Prefix is not needed.
		 */
		$cmb_options->add_field( array(
			'name'    => esc_html__( 'Logo', 'cf' ),
			'desc'    => esc_html__( 'Faça o upload da imagem', 'cf' ),
			'id'      => 'cf_site_logo',
			'type'    => 'file',
		) );

	endif;
}


function cf_options_vendas_e_pagamento_message_callback( $cmb, $args ) {
	$page = $_GET['page'];
	$updated = $_GET['settings-updated'];
	// cf_debug( $page );
	// cf_debug( $updated );
	if ( ! empty( $args['should_notify'] ) ) :
		
		if ( $args['is_updated'] ) :
		
			$cf_logo = get_option( 'cf_logo_options' );
			set_theme_mod( 'site_logo', $cf_logo['cf_site_logo'] );
			$args['message'] = sprintf( esc_html__( '%s &mdash; Atualizado!', 'cf' ), $cmb->prop( 'title' ) );
			// cf_debug( $cf_logo['cf_site_logo'] );
		
		endif;
		
		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );

	endif;

}