<?php

add_action( 'cmb2_admin_init', 'cf_register_design_e_layout_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function cf_register_design_e_layout_options_metabox() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		/**
		 * Registers options page menu item and form.
		 */
		$cmb_options = new_cmb2_box( array(
			'id'           => 'cf_design_e-layouts',
			'title'        => esc_html__( 'Design', 'cf' ),
			'object_types' => array( 'options-page' ),

			/*
			 * The following parameters are specific to the options-page box
			 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
			 */

			'option_key'      => 'cf_logo_options', // The option key and admin menu page slug.
			'icon_url'        => 'dashicons-location-alt', // Menu icon. Only applicable if 'parent_slug' is left empty.
			// 'menu_title'      => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
			// 'parent_slug'     => 'cf-logo', // Make options page a submenu item of the themes menu.
			'capability'      => 'manage_options', // Cap required to view options-page.
			'position'        => 8, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
			// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
			'message_cb'      => 'cf_options_page_message_callback',
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

		$cmb_options->add_field( array(
			'name'    => esc_html__( 'Favicon', 'cf' ),
			'desc'    => esc_html__( 'Faça o upload da imagem', 'cf' ),
			'id'      => 'cf_site_icon',
			'type'    => 'file',
			// 'before_row'		=> 'cf_debug_site_icon'
		) );

	endif;
}


function cf_options_page_message_callback( $cmb, $args ) {
	$page = $_GET['page'];
	$updated = $_GET['settings-updated'];
	// cf_debug( $page );
	// cf_debug( $updated );
	if ( ! empty( $args['should_notify'] ) ) :
		
		if ( $args['is_updated'] ) :
		
			$cf_options = get_option( 'cf_logo_options' );
			$cf_icon = $cf_options['cf_site_icon'];
			$cf_icon_id = $cf_options['cf_site_icon_id'];
			$cf_logo = $cf_options['cf_site_logo'];
			$site_icon = get_option( 'site_icon' );
			set_theme_mod( 'site_logo', $cf_options['cf_site_logo'] );
			// set_theme_mod( 'site_icon', $cf_icon_id );
			$updated = update_option( 'site_icon', $cf_icon_id );
			$args['message'] = sprintf( esc_html__( '%s &mdash; Atualizado!', 'cf' ), $cmb->prop( 'title' ) );
			// cf_debug( $cf_options['cf_site_logo'] );
		
		endif;
		
		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );

	endif;

}

function cf_debug_site_icon( $field_args, $field ) {
	$site_icon = get_option( 'site_icon' );
	$cf_options = get_option( 'cf_logo_options' );
	$cf_icon = $cf_options['cf_site_icon'];
	$cf_icon_id = $cf_options['cf_site_icon_id'];
	cf_debug( $site_icon );
	cf_debug( $cf_icon_id );
}