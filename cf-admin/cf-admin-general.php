<?php

add_action( 'init', 'cf_admin_general_init' );

function cf_admin_general_init() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		// Remobe a Aba 'Ajuda'
		add_filter( 'contextual_help', 'cf_remove_help_tabs', 999, 3 );

		function cf_remove_help_tabs( $old_help, $screen_id, $screen ){
		    $screen->remove_help_tabs();
		    return $old_help;
		}

		// Remove a Aba 'Opões de Tela'
		add_filter( 'screen_options_show_screen', '__return_false' );    

		// Remove avisos e erros do WP
	    add_action( 'admin_head', 'cf_hide_update_msg_non_admins' );

		function cf_hide_update_msg_non_admins() { 
			?>
			<style>
				.updated,
				.error.notice,
				.error,
				#pageparentdiv {
					display: none !important;
				}
			</style><?php 
		}

		// 	Remove as referências ao Wordpress no footer
		add_filter( 'admin_footer_text', '__return_empty_string', 11 );
		add_filter( 'update_footer',     '__return_empty_string', 11 );

	endif; //is_super_admin

}