<?php

wp_enqueue_script( 'cf-jquery-mask', CF_URL . '/assets/js/jquery.mask.min.js', array( 'jquery' ), '1.14.15', true );
wp_enqueue_script( 'cf-script', CF_URL . '/assets/js/cf-script.min.js', array( 'jquery', 'cf-jquery-mask' ), '1.0.0', true );

if ( in_array( $_SERVER['REMOTE_ADDR'], array( '127.0.0.1', '::1' ) ) ) :
	wp_enqueue_script( 'cf-livereload', 'http://localhost:35729/livereload.js?snipver=1', array(), null, true );
endif;