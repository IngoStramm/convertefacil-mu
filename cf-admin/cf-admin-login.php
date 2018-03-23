<?php

add_action( 'init', 'cf_admin_login_init' );

function cf_admin_login_init() {

	// Altera a URL do link do logo na tela de login do WP
	add_filter( 'login_headerurl', 'custom_loginlogo_url' );

	function custom_loginlogo_url( $url ) {
		return 'https://convertefacil.com.br';
	}

	// Altera a tag 'title' do link do logo na tela de login do WP
	add_filter( 'login_headertitle', 'custom_loginlogo_title' );

	function custom_loginlogo_title( $title ) {
		return __( 'ConverteFácil', 'cf' );
	}
	
}