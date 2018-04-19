<?php

add_action( 'init', 'cf_admin_general_init' );

function cf_admin_general_init() {

	$user_id = get_current_user_id();
	if( is_super_admin( $user_id ) )
		return;

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
			#message.updated.notice {
				display: block !important;
			}
		</style><?php 
	}

	// 	Remove as referências ao Wordpress no footer
	add_filter( 'admin_footer_text', '__return_empty_string', 11 );
	add_filter( 'update_footer',     '__return_empty_string', 11 );

	
	// Remove as abas (tabs) das configurações do WC
	add_filter( 'woocommerce_settings_tabs_array', 'cf_remove_woocommerce_setting_tabs', 200, 1 );

	function cf_remove_woocommerce_setting_tabs( $array ) {
		$current_screen = get_current_screen();
		$current_tab = isset( $_GET['tab'] ) && !empty( $_GET['tab'] ) ? $_GET['tab'] : false;
		// abas permitidas
		$allowed_tabs = array(
			'shipping',
			'checkout',
			'integration',
			'mailchimp',
			'sendinblue',
			'email'
		);
	    // Declare the tabs we want to hide
	    $tabs_to_hide = array(
	        'general' 		=> 'General',
	        'products'		=> 'Products',
	        'shipping' 		=> 'Shipping',
	        'tax' 			=> 'Tax',
	        'checkout' 		=> 'Checkout',
	        'email' 		=> 'Emails',
	        'api' 			=> 'API',
	        'account' 		=> 'Accounts',
	        'integration' 	=> 'Integration',
	        'mailchimp'		=> 'MailChimp',
	        'sendinblue'	=> 'SendinBlue'
        );

        foreach( $allowed_tabs as $allowed_tab ) :
        	if( $current_tab == $allowed_tab )
        		unset( $tabs_to_hide[ $current_tab ] );
        endforeach;

        // Remove the tabs we want to hide from the array
        $array = array_diff_key( $array, $tabs_to_hide );

        // Loop through the tabs we want to remove and hook into their settings action
        foreach( $tabs_to_hide as $tabs => $tab_title ) :
            add_action( 'woocommerce_settings_' . $tabs , 'cf_redirect_from_tab_page');
        endforeach;

	    return $array;
	}

	// Redireciona se tentarem acessar as abas removidas
	function cf_redirect_from_tab_page() {
	    // Get the Admin URL and then redirect to it
	    $admin_url = get_admin_url();
	    wp_redirect( $admin_url );
	    exit;
	}


	// Destaca o parent menu correto dos submenus reorganizados
	add_action( 'parent_file', 'cf_submenu_show_fix' );

	function cf_submenu_show_fix( $parent_file ) {

	    global $plugin_page, $submenu_file;
	    $current_screen = get_current_screen();
	    $taxonomy = $current_screen->taxonomy;
	    // cf_debug( $current_screen->id );
	    // cf_debug( $taxonomy );
	    $current_tab = isset( $_GET['tab'] ) && !empty( $_GET['tab'] ) ? $_GET['tab'] : false;
	    // se for a tela de configuração do wc
	    if ( $current_screen->id == 'woocommerce_page_wc-settings' ) :
	    	switch ( $current_tab ) {
	    		case 'checkout':
			        $plugin_page = 'admin.php?page=wc-settings&tab=checkout';
			        $submenu_file = 'admin.php?page=wc-settings&tab=checkout';
	    			break;
	    		case 'shipping':
			        $plugin_page = 'edit.php?post_type=shop_order';
			        $submenu_file = 'admin.php?page=wc-settings&tab=shipping&zone_id=1';
	    			break;
	    		case 'email':
			        $plugin_page = 'edit-comments.php';
			        $submenu_file = 'admin.php?page=wc-settings&tab=email';
	    			break;
	    		case 'integration':
			        $plugin_page = 'admin.php?page=wc-settings&tab=integration&section=bling';
			        $submenu_file = 'admin.php?page=wc-settings&tab=integration&section=bling';
	    			break;
	    		case 'mailchimp':
			        $plugin_page = 'edit.php';
			        $submenu_file = 'admin.php?page=wc-settings&tab=mailchimp';
	    			break;
	    		case 'sendinblue':
			        $plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
			        $submenu_file = 'admin.php?page=wc-settings&tab=sendinblue';
	    			break;
	    		
	    		default:
			        // $plugin_page = 'cf-operacoes-e-logistica-o-que-voce-precisa-saber';
			        // $submenu_file = 'admin.php?page=wc-settings&tab=shipping';
	    			break;
	    	}
	    // user
	    elseif( $current_screen->id == 'user' ) :
	    	$plugin_page = 'users.php';
	        $submenu_file = 'users.php';
	    // Relatórios WC
	    elseif( $current_screen->id == 'woocommerce_page_wc-reports' ) :
	    	$plugin_page = 'admin.php?page=wc-reports';
	        $submenu_file = 'admin.php?page=wc-reports';
	    // Pedidos WC
	    elseif( $current_screen->id == 'shop_order' ) :
	    	$plugin_page = 'edit.php?post_type=shop_order';
	        $submenu_file = 'edit.php?post_type=shop_order';
	    // Parcelas
	    elseif( $current_screen->id == 'edit-parcela' ) :
	    	$plugin_page = 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber';
	    // Tags
	    elseif( $current_screen->id == 'edit-post_tag' && $taxonomy == 'post_tag' ) :
	    	$plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
	    // Categorias de post
	    elseif( $current_screen->id == 'edit-category' && $taxonomy == 'category' ) :
	    	$plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
	    // Post
	    elseif( $current_screen->id == 'edit-post' ) :
	    	$plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
	    // Add Produto
	    elseif( $current_screen->id == 'product' ) :
	    	$plugin_page = 'edit.php?post_type=product';
	        $submenu_file = 'edit.php?post_type=product';
	    // Categorias de Produto
	    elseif( $current_screen->id == 'edit-product_cat' && $taxonomy == 'product_cat' ) :
	    	// $plugin_page = 'edit.php?post_type=product';
	     //    $submenu_file = 'edit-tags.php?taxonomy=product_cat&post_type=product';
	    // Tags de Produto
	    elseif( $current_screen->id == 'edit-product_tag' && $taxonomy == 'product_tag' ) :
	    	// $plugin_page = 'edit.php?post_type=product';
	     //    $submenu_file = 'edit-tags.php?taxonomy=product_tag&post_type=product';
	    // Atributos de Produto
	    elseif( $current_screen->id == 'product_page_product_attributes' ) :
	    	// $plugin_page = 'edit.php?post_type=product';
	     //    $submenu_file = 'edit.php?post_type=product&page=product_attributes';
	    // Páginas
	    elseif( $current_screen->id == 'edit-page' ) :
	    	$plugin_page = 'cf-conteudo-o-que-voce-precisa-saber';
	    // Upload
	    elseif( $current_screen->id == 'upload' ) :
	    	$plugin_page = 'edit.php?post_type=product';
	        $submenu_file = 'upload.php';
	    // Popup
	    elseif( $current_screen->id == 'edit-inc_popup' ) :
	    	$plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
	    // Flamingo
	    elseif( $current_screen->id == 'flamingo_page_flamingo_inbound' ) :
	    	$plugin_page = 'edit.php';
	        $submenu_file = 'admin.php?page=flamingo_inbound';
	    // Flamingo
	    elseif( $current_screen->id == 'toplevel_page_flamingo' ) :
	    	$plugin_page = 'edit.php';
	        $submenu_file = 'admin.php?page=flamingo';
	    // E-goi
	    elseif( $current_screen->id == 'toplevel_page_egoi-mail-list-builder-contact-form-7-info' ) :
	    	$plugin_page = 'cf-marketing-tudo-o-que-voce-precisa-saber';
	        $submenu_file = 'admin.php?page=egoi-mail-list-builder-contact-form-7-info';
	    // Tawk
	    elseif( $current_screen->id == 'settings_page_tawkto_plugin' ) :
	    	$plugin_page = 'edit-comments.php';
	        $submenu_file = 'options-general.php?page=tawkto_plugin';
	    // Avaliação dos Clientes (trustvox)
	    elseif( $current_screen->id == 'settings_page_trustvox' ) :
	    	$plugin_page = 'edit-comments.php';
	        $submenu_file = 'options-general.php?page=trustvox';
	    // Yoast SEO
		// elseif( $current_screen->id == 'toplevel_page_wpseo_dashboard' ) :
		// 	$plugin_page = '';
		// 	$submenu_file = 'admin.php?page=wpseo_dashboard';
	    // RD Station
	    // elseif( $current_screen->id == 'edit-rdcf7_integrations' ) :
	    // 	$plugin_page = '';
	    //     $submenu_file = 'post_type=rdcf7_integrations';
	    // Domain Mapping
	    elseif( $current_screen->id == 'tools_page_domainmapping' ) :
	    	$plugin_page = 'cf_plugin_options';
	        $submenu_file = 'tools.php?page=domainmapping';
	    // RD Station CF7
	    elseif( $current_screen->id == 'edit-rdcf7_integrations' ) :
	    	$plugin_page = 'cf_plugin_options';
	        $submenu_file = 'edit.php?post_type=rdcf7_integrations';
	    // Google Analytics
	    elseif( $current_screen->id == 'toplevel_page_gadwp_settings' ) :
	    	$plugin_page = 'cf_plugin_options';
	        $submenu_file = 'admin.php?page=gadwp_settings';
	    // Forminator
	    elseif( $current_screen->id == 'toplevel_page_forminator' ) :
	    	$plugin_page = 'edit-comments.php';
	        $submenu_file = 'admin.php?page=forminator';
	    elseif( $current_screen->id == 'forminator_page_forminator-cform-wizard' ) :
	    	$plugin_page = 'edit-comments.php';
	        $submenu_file = 'admin.php?page=forminator-cform-wizard';
	    elseif( $current_screen->id == 'woo-feed_page_woo_feed_manage_feed' ) :
	    	$plugin_page = 'admin.php?page=wc-settings&tab=checkout';
	        $submenu_file = 'admin.php?page=woo_feed_manage_feed';
		endif;
	    return $parent_file;

	}

}