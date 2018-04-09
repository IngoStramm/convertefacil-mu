<?php
add_action( 'cmb2_admin_init', 'cf_register_theme_options_metabox' );
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function cf_register_theme_options_metabox() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		/**
		 * Registers options page menu item and form.
		 */
		$cmb_options = new_cmb2_box( array(
			'id'           => 'cf_plugin_options_page',
			'title'        => esc_html__( 'Configurações', 'cf' ),
			'object_types' => array( 'options-page' ),

			/*
			 * The following parameters are specific to the options-page box
			 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
			 */

			'option_key'      => 'cf_plugin_options', // The option key and admin menu page slug.
			'icon_url'        => 'dashicons-analytics', // Menu icon. Only applicable if 'parent_slug' is left empty.
			// 'menu_title'      => esc_html__( 'Options', 'cf' ), // Falls back to 'title' (above).
			// 'parent_slug'     => 'themes.php', // Make options page a submenu item of the themes menu.
			'capability'      => 'manage_options', // Cap required to view options-page.
			'position'        => 999, // Menu position. Only applicable if 'parent_slug' is left empty.
			// 'admin_menu_hook' => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
			// 'display_cb'      => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
			// 'save_button'     => esc_html__( 'Save Theme Options', 'cf' ), // The text for the options-page save button. Defaults to 'Save'.
			// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
			// 'message_cb'      => 'cf_plugin_message_callback',
		) );

		/**
		 * Options fields ids only need
		 * to be unique within this box.
		 * Prefix is not needed.
		 */
		$cmb_options->add_field( array(
			'name'    => esc_html__( 'Tírulo do Site', 'cf' ),
			// 'desc'    => esc_html__( 'field description (optional)', 'cf' ),
			'id'      => 'blogname',
			'type'    => 'text',
			'default' => 'cf_get_blogname',
			// 'message_cb'      => 'cf_plugin_message_callback',
		) );

	endif;

}

function cf_get_blogname() {
	$blog_id = get_current_blog_id();
	$blogname = get_blog_details( $blog_id )->blogname;
	return $blogname;
}

function cf_plugin_message_callback( $cmb, $args ) {
	cf_debug( 'teste1' );
	if ( ! empty( $args['should_notify'] ) ) :
		
		if ( $args['is_updated'] ) :

			$blog_id = get_current_blog_id();		
			$cf_options = get_option( 'cf_plugin_options' );
			// cf_debug( $cf_options['blogname'] );
			set_theme_mod( 'blogname', $cf_options['blogname'] );
			update_blog_details( $blog_id, array( 'blogname' => $cf_options['blogname'] ) );
			update_option( 'blogname', $cf_options['blogname'] );
			update_blog_status( $blog_id, 'blogname', $cf_options['blogname'] );
			$args['message'] = sprintf( esc_html__( '%s &mdash; Atualizado: ' . $cf_options['blogname'], 'cf' ), $cmb->prop( 'title' ) );
		
		endif;
		
		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );

	endif;
}

// add_action( 'admin_init', 'cf_update_blogname' );

function cf_update_blogname() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		$blog_id = get_current_blog_id();		
		$cf_options = get_option( 'cf_plugin_options' );
		$new_blogname = $cf_options['blogname'];
		$old_blogname = get_option( 'blogname' );
	    if ( !empty( $new_blogname ) && $old_blogname  !== $new_blogname ) {
	    	// set_theme_mod( 'blogname', $new_blogname );
	    	// update_blog_details( $blog_id, array( 'blogname' => $new_blogname ) );
	    	update_option( 'blogname', $new_blogname );
	    	// update_blog_status( $blog_id, 'blogname', $new_blogname );
	    }
    endif;
}

// add_action( 'wp_head', 'cf_options_teste' );

// function cf_options_teste() {
// 	$cf_options = get_option( 'cf_plugin_options' );
// 	$blogname = get_option( 'blogname' );
// 	cf_debug( $cf_options['blogname'] );
// 	cf_debug( $blogname );
// }