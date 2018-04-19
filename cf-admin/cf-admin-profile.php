<?php

add_action( 'init', 'cf_admin_profile_init' );

function cf_admin_profile_init() {

	$utils = new Cf_Utils;
	$user_id = get_current_user_id();
	
	// if( is_super_admin( $user_id ) )
	// 	return;

	if( $utils->is_not_super_admin_and_is_admin_and_is_not_your_own_profile() || $utils->is_not_super_admin_and_admin() ) :

		// removes the `profile.php` admin color scheme options
		remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );

		if ( ! function_exists( 'cf_remove_personal_options' ) ) {
		  /**
		   * Removes the leftover 'Visual Editor', 'Keyboard Shortcuts' and 'Toolbar' options.
		   */
		  function cf_remove_personal_options( $subject ) {
		    $subject = preg_replace( '#<h2>Opções pessoais</h2>.+?/table>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<tr class="user-profile-picture">.+?/tr>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<tr class="user-url-wrap">.+?/tr>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<tr class="user-googleplus-wrap">.+?/tr>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<tr class="user-facebook-wrap">.+?/tr>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<tr class="user-twitter-wrap">.+?/tr>#s', '', $subject, 1 );
		    $subject = preg_replace( '#<h2>Sobre você</h2>.+?/table>#s', '', $subject, 1 );
		    return $subject;
		  }

		  function cf_profile_subject_start() {
		    ob_start( 'cf_remove_personal_options' );
		  }

		  function cf_profile_subject_end() {
		    ob_end_flush();
		  }
		}
		add_action( 'admin_head-profile.php', 'cf_profile_subject_start' );
		add_action( 'admin_footer-profile.php', 'cf_profile_subject_end' );

	endif;

}