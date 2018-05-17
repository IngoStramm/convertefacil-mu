<?php
/*
 * 
 * Filtros
 * 
 * 
 * prosites_render_checkout_page_period
 * prosites_render_checkout_page_level
 * prosites_inner_pricing_table_pre
 * prosites_inner_pricing_table_post
 * prosites_post_pricing_table_content
 * psts_checkout_after_free
 * prosites_pricing_labels
 * prosites_pricing_level_title
 * prosites_pricing_level_featured
 * prosites_pricing_summary_text
 * prosites_checkout_free_link
 * psts_before_checkout_grid
 * psts_checkout_grid_levelname
 * psts_checkout_grid_before_free
 * psts_checkout_grid_after_free
 * 
 * wpmudev_api_project_extra_data
 * psts_check_coupon
 * psts_redirect_signup_page_url
 * prosites_helper_html_settings_header_args
 * prosites_settings_tabs_render_callback
 * prosites_render_checkout_page
 * 
 * 
 * 
 * 
 * 
 */

// add_filter( 'prosites_render_checkout_page', 'test_filter', 10, 3 );

function test_filter( $att1, $att2, $att3 ) {
	cf_debug( $att1 );
	cf_debug( $att2 );
	cf_debug( $att3 );
	// cf_debug( $att4 );
	// cf_debug( $att5 );
	// cf_debug( $att6 );
	// cf_debug( $att7 );
	return $att1;
}

function cf_test_action() {
	cf_debug( 'cf_test_action' );
}

add_filter( 'prosites_render_checkout_page', 'cf_wrap_content', 10, 1 );

function cf_wrap_content( $content ) {
	$return = '<div class="pro-sites-checkout-page">';
	$return .= '<h2>' . __( 'Escolha um dos planos', 'cf' ) . '</h2>';
	$return .= $content;
	$return .= '</div>';
	return $return;
}

add_filter( 'prosites_render_checkout_page', 'cf_add_pro_sites_script', 10, 3 );

function cf_add_pro_sites_script ( $content, $blog_id, $domain ) {
	$script = <<<"EOT"
	<!-- ?> -->
	<script>
		jQuery( function( $ ){
			$(document).ready(function(){
				var wrapper = $( '#prosites-signup-form-checkout' );
				var setup_site_title = wrapper.find( 'h2:first' );
				setup_site_title.detach();
				var form_register = $( '#prosites-user-register' );
				var dados_pessoais = form_register.find( '#dados-pessoais ');
				dados_pessoais.detach().prependTo( form_register );
				setup_site_title.insertAfter( dados_pessoais );
			}); // $(document).ready
		});
	</script>
	<!-- <?php -->
EOT;
	return $content . $script;
}

// add_action( 'psts_page_after_main', 'cf_test_action' );

// add_action( 'prosites_before_checkout_page', 'cf_add_checkout_title' );

function cf_add_checkout_title() {
	?>
	<h2><?php _e( 'Escolha um dos planos', 'cf' ); ?></h2>
	<?php
}

// apply_filters( 'prosite_currency_symbol', $symbol, $currency );

// add_filter( 'prosite_currency_symbol', 'cf_troca_precos', 10, 2 );

function cf_troca_precos( $symbol, $currency ) {
	cf_debug( $symbol );
	cf_debug( $currency );
	return $symbol;
}

// Envia E-mail com link de ativação
//  Fix para o pro Sites que não está enviando o e-mail
add_filter( 'prosites_render_checkout_page', 'cf_checkout_complete_send_email', 10, 3 );

function cf_checkout_complete_send_email( $content, $blog_id, $domain ) {
	$get_domain = isset( $_GET[ 'domain' ] ) ? $_GET[ 'domain' ] : false;
	$get_action = isset( $_GET[ 'action' ] ) ? $_GET[ 'action' ] : false;
	$get_token = isset( $_GET[ 'token' ] ) ? $_GET[ 'token' ] : false;
	if( $get_domain && $get_action && $get_token ) :
		global $wpdb;
		$user = wp_get_current_user();
		$inactive_user = $wpdb->get_row( "SELECT * FROM $wpdb->signups WHERE active = 0 AND user_login = '$user->user_login'" );
		if( $inactive_user ) :
			$activation_url = network_site_url( 'wp-activate.php?key=' . $inactive_user->activation_key, 'https' );
			$to = $inactive_user->user_email;
			// cf_debug( $inactive_user->activation_key );
			// cf_debug( $inactive_user->domain );
			// cf_debug( $inactive_user->path );
			// cf_debug( $inactive_user->title );
			// cf_debug( $inactive_user->user_email );
			$subject = __( 'ConverteFácil - Ativação de Conta:' . ' ' . $inactive_user->title, 'cf' );
			$headers = array( 'Content-Type: text/html; charset=UTF-8' );
			$message = '<h3>' . __( 'Bem vindo ao ConverteFácil!', 'cf' ) . '</h3>';
			$message .= '<p>' . __( 'Clique no link abaixo para ativar a sua conta.', 'cf' ) . '</p>';
			$message .= '<h4><a href="' . $activation_url . '" target="_blank">' . __( 'Ativar conta!', 'cf' ) . '</a></h4>';
			$message .= '<p>' . __( '--Equipe  ConverteFácil', 'cf' ) . '</p>';
			$send_mail = wp_mail( $to, $subject, $message, $headers );
		endif;
	endif;
	return $content;
}

add_filter( 'prosites_render_checkout_page', 'cf_checkout_complete_change_site_url', 11, 3 );

function cf_checkout_complete_change_site_url( $content, $blog_id, $domain ) {
	// cf_debug( $blog_id );
	// cf_debug( $domain );
	if( empty( $blog_id )) :
		global $wpdb;
		$user = wp_get_current_user();
		$inactive_user = $wpdb->get_row( "SELECT * FROM $wpdb->signups WHERE active = 0 AND user_login = '$user->user_login'" );
		$active_user = $wpdb->get_row( "SELECT * FROM $wpdb->signups WHERE active = 1 AND user_login = '$user->user_login'" );
		// cf_debug( $user );
		// cf_debug( $wpdb->signups );
		// cf_debug( $active_user );
		if( $inactive_user ) :
			$network_url = network_site_url( '/wp-admin/' );
			$new_site_url = network_site_url( $inactive_user->path . 'wp-admin/', 'https' );
			// cf_debug( '<a href="' . $new_site_url . '">' . $new_site_url . '</a>' );
			$content = preg_replace( '#<a href="' . $network_url . '">' . $network_url . '</a>#s', '<a href="' . $new_site_url . '">' . $new_site_url . '</a>', $content, 1 );
		endif;
	endif;
	return $content;
}

// Fix para as screenshots corretas serem exibidas na tela de checkout
// quando a validação do form encontra algum erro
add_filter( 'nbt_signup_templates', 'cf_fix_templates', 11, 1 );

function cf_fix_templates( $templates ) {

	$fixed_templates = [];

	foreach ( $templates as $template ) :

		$new_template = $template;
		
		if( !empty( $template[ 'options' ] ) ) :

			foreach ( $template[ 'options' ] as $key => $value ) :
				$new_template[ $key ] = $value;
			endforeach;

		endif;

		$fixed_templates[] = $new_template;

	endforeach;

	return $fixed_templates;

}