<?php

add_action( 'init', 'cf_admin_wc_init' );

function cf_admin_wc_init() {

	$user_id = get_current_user_id();
	if( is_super_admin( $user_id ) )
		return;

	// Remove as opção das configurações do checkout
	add_filter( 'woocommerce_payment_gateways_settings', 'cf_remove_options_wc_settings' );

	function cf_remove_options_wc_settings( $settings ) {
		foreach( $settings as $i => $setting ) :
			// O array com os settings, ficam em
			// woocoommerce/includes/admin/settings/class-wc-settings-checkout.php
			// public function get_settings
			// linha 62
			switch ( $setting['id'] ) {
				case 'checkout_page_options':
				case 'woocommerce_cart_page_id':
				case 'woocommerce_checkout_page_id':
				case 'woocommerce_terms_page_id':
				case 'checkout_page_options':
				case 'account_endpoint_options':
				case 'woocommerce_checkout_pay_endpoint':
				case 'woocommerce_checkout_order_received_endpoint':
				case 'woocommerce_myaccount_add_payment_method_endpoint':
				case 'woocommerce_myaccount_delete_payment_method_endpoint':
				case 'woocommerce_myaccount_set_default_payment_method_endpoint':
				case 'checkout_endpoint_options':
					unset( $settings[$i] );
					break;
				
				default:
					break;
			}
		endforeach;
		return $settings;
	}

	// Esconde as seções na aba Integração do WC_Settings
	// WC_Settings_Integrations->get_sections
	// arquivo woocommerce\includes\admin\settings\class-wc-settings-integrations.php
	add_filter( 'woocommerce_get_sections_integration', 'cf_filtra_sections', 10, 1 );

	function cf_filtra_sections() {
		return;
	}	

	// woocommerce_settings_api_form_fields_bling
	add_filter( 'woocommerce_settings_api_form_fields_bling', 'cf_filtra_bling_settings', 10, 1 );
	function cf_filtra_bling_settings( $form_fields ) {
		// cf_debug( $form_fields );
		$bling_html = '<a href="http://bling.com.br/configuracoes.api.web.services.php" target="_BLANK">Bling</a></strong>';
		$new_field = array(
			'title'			=> __( 'Atenção!', 'cf' ),
			'type'			=> 'title',
			'description'	=> __( 'É necessário possuir uma conta ativa no <strong>' . $bling_html . '</strong> para que a integração funcione.' ),
			'default'		=> ''
		);
		$access_key = $form_fields[ 'access_key' ];
		unset( $form_fields[ 'testing' ] );
		unset( $form_fields[ 'debug' ] );
		// unset( $form_fields[ 'access_key' ] );
		$form_fields[ 'cf_bling_custom_text' ] = $new_field;
		// $form_fields[ 'access_key' ] = $access_key;
		return $form_fields;
	}

	add_filter( 'woocommerce_email_settings', 'cf_change_email_settings' );

	function cf_change_email_settings( $settings ) {
		// cf_debug( $settings[8] );
		// unset( $settings[8] );
		$settings[8]['title'] = __( 'Atenção!', 'cf' );
		$settings[8]['desc'] = __( 'O e-mail usado no campo <strong>"De"</strong> deve usar o mesmo domínio do site. Por ex: se o domínio do site for <code>"www.<strong>rards.com.br</strong></code>", o endereço de e-mail usado no campo <strong>"De"</strong> deverá ser <code>"alguma-coisa@<strong>rards.com.br</strong>"</code>. Não importa se esse endereço de e-mail não existe e nem o que vem antes do <strong>"@"</strong>. O importante é que o domínio usado após o <strong>"@"</strong> seja exatamente igual ao domínio do site.' );
		return $settings;
	}

}

// Fix para definir o WC na lista de plugins ativos no option 'active_plugins'
// por algum motivo, ao clonar ou criar um novo site, o WC vem ativado,
// mas não consta como ativo no option 'active_plugins'
add_filter( 'active_plugins', 'cf_fix_set_wc_as_active_plugin' );

function cf_fix_set_wc_as_active_plugin( $active_plugins ) {
	$wc_file = 'woocommerce/woocommerce.php';
	$wc_is_active = is_plugin_active( $wc_file );
	if( $wc_is_active )
		$active_plugins[] = $wc_file;
	update_option( 'active_plugins', $active_plugins );
	return $active_plugins;
}
