<?php

wp_enqueue_script( 'cf-jquery-mask', CF_URL . '/assets/js/jquery.mask.min.js', array( 'jquery' ), '1.14.15', true );
wp_enqueue_script( 'cf-script', CF_URL . '/assets/js/cf-script.min.js', array( 'jquery', 'cf-jquery-mask' ), '1.0.0', true );
wp_enqueue_style( 'cf-plugin-frontend-style', CF_URL . 'assets/css/converte-facil-plugin-frontend-style.css', array(), false, 'all' );

if ( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ) :
	wp_enqueue_script( 'cf-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );
endif;

add_action( 'admin_enqueue_scripts', 'cf_backend_scripts' );

function cf_backend_scripts() {
	wp_enqueue_style( 'cf-plugin-backend-style', CF_URL . 'assets/css/converte-facil-plugin-backend-style.css', array(), false, 'all' );
}