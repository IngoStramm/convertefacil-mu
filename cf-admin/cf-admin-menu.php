<?php

add_action( 'init', 'cf_admin_menu_init' );

function cf_admin_menu_init() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		// Remove Menus do sidebar
		add_action( 'admin_menu', 'cf_remove_menus', 110, 0 );

		function cf_remove_menus(){
	        global $menu, $submenu;
	        // cf_debug( $submenu );
	        // $edit_menu = $submenu['themes.php'][10];
	        // add_menu_page( __( 'Editar Menus' ), __( ' Menus '), 'edit_theme_options', 'nav-menus.php', null, null, 60 );
	        // remove_menu_page( 'index.php' );                  //Dashboard
	        // remove_menu_page( 'edit.php?post_type=page' );    //Pages
	        // remove_menu_page( 'plugins.php' );                //Plugins
	        // remove_menu_page( 'users.php' );                  //Users
	        remove_menu_page( 'admin.php?page=jetpack' );                 
	        // remove_menu_page( 'duplicator' ); 
	        // remove_menu_page( 'edit.php?post_type=featured_item' ); 
	        // remove_menu_page( 'edit.php?post_type=blocks' ); 

			// Painel
			remove_submenu_page( 'index.php', 'my-sites.php' );
	        
			//Media
	        remove_menu_page( 'upload.php' );
	        
	        //Comments
	        remove_menu_page( 'edit-comments.php' );
			remove_submenu_page( 'edit-comments.php', 'edit-comments.php' ); // Comentários

	        // Páginas
	        remove_menu_page( 'edit.php?post_type=page' );
	        remove_submenu_page( 'edit.php?post_type=page', 'edit.php?post_type=page' );
	        remove_submenu_page( 'edit.php?post_type=page', 'post-new.php?post_type=page' );
	        // unset($submenu['edit.php?post_type=page'][5]); // Páginas
	        // unset($submenu['edit.php?post_type=page'][10]); // Adicionar nova

	        //Tools
	        remove_menu_page( 'tools.php' );
	        
	        //Settings
	        remove_menu_page( 'options-general.php' );
	        remove_submenu_page( 'options-general.php', 'options-general.php' );

	        // Posts
	        remove_menu_page( 'edit.php' );                   //Posts
	        remove_submenu_page( 'edit.php', 'edit.php' ); 
	        remove_submenu_page( 'edit.php', 'post-new.php' ); 
	        remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=category' ); 
	        remove_submenu_page( 'edit.php', 'edit-tags.php?taxonomy=post_tag' ); 
	        // unset($submenu['edit.php'][5]); // Todos
	        // unset($submenu['edit.php'][10]); // Adicionar
	        // unset($submenu['edit.php'][15]); // Categorias
	        // unset($submenu['edit.php'][16]); // Tags

	        // Aparência
	        remove_menu_page( 'themes.php' );                 //Appearance
	        remove_submenu_page( 'themes.php', 'customize.php' );   
	        remove_submenu_page( 'themes.php', 'themes.php' );
	        remove_submenu_page( 'themes.php', 'nav-menus.php' );   
	        remove_submenu_page( 'upload.php', 'upload.php' );   
	        remove_submenu_page( 'upload.php', 'upload_files' );   
	        remove_submenu_page( 'upload.php', 'media-new.php' );   

	        // Produtos
	        // remove_menu_page( 'edit.php?post_type=product' ); 
	        // unset($submenu['edit.php?post_type=product'][5]); // Produtos     
	        // unset($submenu['edit.php?post_type=product'][10]); // Add new // post-new.php?post_type=product
	        // unset($submenu['edit.php?post_type=product'][15]); // Categorias // edit-tags.php?taxonomy=product_cat&post_type=product
	        // unset($submenu['edit.php?post_type=product'][16]); // Tags // edit-tags.php?taxonomy=product_tag&post_type=product
	        // unset($submenu['edit.php?post_type=product'][17]); // Atributos // edit.php?post_type=product&page=product_attributes
	        // remove_submenu_page( 'edit.php?post_type=product', 'edit.php?post_type=product' );
	        remove_submenu_page( 'edit.php?post_type=product', 'post-new.php?post_type=product' );
	        // remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_cat&post_type=product' );
	        // remove_submenu_page( 'edit.php?post_type=product', 'edit.php?post_type=product&page=product_attributes' );
	        // remove_submenu_page( 'edit.php?post_type=product', 'product_attributes' );

	        // Renomeia o menu 'Produtos'
	        $menu[27][0] = __( 'Conteúdo', 'cf' );
	        $submenu['edit.php?post_type=product'][5][0] = __( 'Produtos', 'cf' );
	        $submenu['edit.php?post_type=product'][15][0] = __( 'Categorias de Produto', 'cf' );
	        $submenu['edit.php?post_type=product'][16][0] = __( 'Tags de Produtos', 'cf' );
	        $submenu['edit.php?post_type=product'][17][0] = __( 'Atributos de Produtos', 'cf' );
	        
	        // Parcela
	        remove_menu_page( 'edit.php?post_type=parcela' );
	        remove_submenu_page( 'edit.php?post_type=parcela', 'edit.php?post_type=parcela' );
	        // unset( $menu['edit-parcela'] ); 

	        // Woocommerce
	        remove_menu_page( 'woocommerce' );               							//WC
	        remove_submenu_page( 'woocommerce', 'edit.php?post_type=shop_order' );		// pedidos
	        remove_submenu_page( 'woocommerce', 'edit.php?post_type=shop_coupon' );		// coupons
	        // remove_submenu_page( 'woocommerce', 'wc-reports' );							// relatórios // admin.php?page=wc-reports
	        // remove_submenu_page( 'woocommerce', 'wc-settings' );						// Configurações
	        remove_submenu_page( 'woocommerce', 'wc-status' );							// Status
	        remove_submenu_page( 'woocommerce', 'wc-addons' );							// Extensões
	        	        
	        // Appearance Menu
	        // unset($submenu['themes.php'][5]); // Themes        
	        // unset($submenu['themes.php'][6]); // Customize link
	        // unset($submenu['themes.php'][7]); // Widgets
	        // unset($submenu['themes.php'][10]); // Menus
	        // unset($submenu['upload.php'][5]); // Mídia
	        // unset($submenu['upload.php'][10]); // Adicionar nova
	        // unset($submenu['themes.php'][15]); // Customize link
	        // unset($submenu['themes.php'][20]); // Background
	        // unset($submenu['edit.php?post_type=popup'][11]); // Background
	        // unset($submenu['edit.php?post_type=popup'][12]); // Background
	        // unset($submenu['edit.php?post_type=popup'][13]); // Background

	        // Media Library Folders
	        // unset($submenu['media-library-folders'][2]);
	        // unset($submenu['media-library-folders'][5]);
	        // unset($submenu['media-library-folders'][6]);

	        // Contact Form 7
	        remove_menu_page( 'wpcf7' );
	        
	        // Yoast Plugin
	        remove_menu_page( 'yit_plugin_panel' );
	        
	        // Flatsome
	        remove_menu_page( 'flatsome-panel' ); // Flatsome
	        remove_menu_page( 'edit.php?post_type=blocks' ); // Blocks
	        remove_menu_page( 'edit.php?post_type=featured_item' ); // Portfólio
	        
	        // Pro Sites
	        remove_menu_page( 'psts-checkout' ); // Pro Upgrade
	        remove_menu_page( 'loco' ); // Pro Upgrade

	        // Popup (wpmudev)
	        remove_menu_page( 'edit.php?post_type=inc_popup' );
	        remove_submenu_page( 'edit.php?post_type=inc_popup', 'edit.php?post_type=inc_popup' );
	        remove_submenu_page( 'edit.php?post_type=inc_popup', 'post-new.php?post_type=inc_popup' );
	        remove_submenu_page( 'edit.php?post_type=inc_popup', 'edit.php?post_type=inc_popup&page=settings' );

	        // Flamingo
	        remove_menu_page( 'flamingo' );
	        remove_submenu_page( 'flamingo', 'flamingo' );							// admin.php?page=flamingo
	        remove_submenu_page( 'flamingo', 'flamingo_edit_inbound_messages' );	// admin.php?page=flamingo_inbound

	        // E-goi
	        remove_menu_page( 'egoi-mail-list-builder-contact-form-7-info' );

	        // tawk
	        // remove_submenu_page( 'options-general.php', 'tawkto_plugin' );
	        // remove_submenu_page( 'options-general.php', 'options-general.php?page=tawkto_plugin' );
	        // unset($submenu['options-general.php'][42]); // Tags

	        // Yoast SEO
	        remove_menu_page( 'wpseo_dashboard' );

	        // FB Comments
	        remove_menu_page( 'FB-comments' );

			// Seo Optimized Images
	        remove_menu_page( 'soi_setting' );

	        // W3 Total Cache
	        remove_menu_page( 'w3tc_dashboard' );

	        // Woo Feed
	        remove_menu_page( 'webappick-product-feed-for-woocommerce/admin/class-woo-feed-admin.php' );

	        // WP All Export
	        remove_menu_page( 'pmxe-admin-home' );

	        // WP All Import
	        remove_menu_page( 'pmxi-admin-home' );

	    }

		
        // Adiciona novos elementos ao menu
		add_action( 'admin_menu', 'cf_add_menus', 200, 0 );
	    function cf_add_menus() {


	        // 1. Planejamento
	        // add_menu_page( __( 'Planejamento', 'cf' ), __( 'Planejamento', 'cf' ), 'edit_theme_options', 'cf-planejamento-o-que-voce-precisa-saber', 'cf_em_breve', null, 2 );
	        
	        	// O que você precisa saber?
	        	// add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-planejamento-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Consultorias
	        	// add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'Consultorias', 'cf' ), __( 'Consultorias', 'cf' ), 'edit_theme_options', 'cf-planejamento-consultorias', 'cf_em_breve' );
	        	// OKR
	        	// add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'OKR', 'cf' ), __( 'OKR', 'cf' ), 'edit_theme_options', 'cf-planejamento-okr', 'cf_em_breve' );

	        // 2. Financeiro
	        add_menu_page( __( 'Financeiro', 'cf' ), __( 'Financeiro', 'cf' ), 'edit_theme_options', 'cf-financeiro-calculo-de-investimento-inicial', 'cf_em_breve', null, 3 );
	        	// O que você precisa saber?
	        	// add_submenu_page( 'cf-financeiro-calculo-de-investimento-inicial', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-financeiro-calculo-de-investimento-inicial', 'cf_em_breve' );
	        	// Calculo de Investimento Inicial
	        	add_submenu_page( 'cf-financeiro-calculo-de-investimento-inicial', __( 'Calculo de Investimento Inicial', 'cf' ), __( 'Calculo de Investimento Inicial', 'cf' ), 'edit_theme_options', 'cf-financeiro-calculo-de-investimento-inicial', 'cf_em_breve' );
	        	// Custos Fixos
	        	add_submenu_page( 'cf-financeiro-calculo-de-investimento-inicial', __( 'Custos Fixos', 'cf' ), __( 'Custos Fixos', 'cf' ), 'edit_theme_options', 'cf-financeiro-custos-fixos', 'cf_em_breve' );
	        
	        // 3. Contabilidade e Jurídico
	        // add_menu_page( __( 'Contabilidade e Jurídico', 'cf' ), __( 'Contabilidade e Jurídico', 'cf' ), 'edit_theme_options', 'cf-juridico-o-que-voce-precisa-saber', 'cf_em_breve', null, 4 );
	        	// O que você precisa saber?
	        	// add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-juridico-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Termos de Uso
	        	// add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Termos de Uso', 'cf' ), __( 'Termos de Uso', 'cf' ), 'edit_theme_options', 'cf-juridico-termos-de-uso', 'cf_em_breve' );
	        	// Trocas e Devoluções/Direito de Arrependimento
	        	// add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Trocas e Devoluções/Direito de Arrependimento', 'cf' ), __( 'Trocas e Devoluções/Direito de Arrependimento', 'cf' ), 'edit_theme_options', 'cf-juridico-trocas-e-devolucoes-arrependimento', 'cf_em_breve' );
	        	// Integração
	        	// add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Integração', 'cf' ), __( 'Integração', 'cf' ), 'edit_theme_options', 'cf-juridico-integracao', 'cf_em_breve' );
	        
	        // 4. Equipe
	        // add_menu_page( __( 'Equipe', 'cf' ), __( 'Equipe', 'cf' ), 'edit_theme_options', 'cf-equipe-o-que-voce-precisa-saber', 'cf_em_breve', null, 5 );
	        
	        	// O que você precisa saber?
	        	// add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-equipe-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Equipe de um e-commerce
	        	// add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Equipe de um e-commerce', 'cf' ), __( 'Equipe de um e-commerce', 'cf' ), 'edit_theme_options', 'cf-equipe-de-um-ecommerce', 'cf_em_breve' );
	        	// Descrição de cargos e responsabilidades
	        	// add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Descrição de cargos e responsabilidades', 'cf' ), __( 'Descrição de cargos e responsabilidades', 'cf' ), 'edit_theme_options', 'cf-descricao-de-cargos-e-responsabilidades', 'cf_em_breve' );
	        	// Encontre o profissional
	        	// add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Encontre o profissional', 'cf' ), __( 'Encontre o profissional', 'cf' ), 'edit_theme_options', 'cf-encontre-o-profissional', 'cf_em_breve' );

	        // 5. Design e Layouts
	        // add_menu_page( __( 'Design e Layouts', 'cf' ), __( 'Design e Layouts', 'cf' ), 'edit_theme_options', 'cf-logo', null, null, 6 );

	        	// Logo
	        	add_submenu_page( 'cf_logo_options', __( 'Logo', 'cf' ), __( 'Logo', 'cf' ), 'edit_theme_options', 'cf-logo', 'cf_logo' );
	        	// Temas
	        	// add_submenu_page( 'cf-logo', __( 'Temas', 'cf' ), __( 'Temas', 'cf' ), 'edit_theme_options', 'cf-temas', 'cf_em_breve' );
	        	// Menu
	        	add_submenu_page( 'cf_logo_options', __( 'Menu', 'cf' ), __( 'Menu', 'cf' ), 'edit_theme_options', 'nav-menus.php', null );
	        	// 12go
	        	// add_submenu_page( 'cf_logo_options', __( '12go', 'cf' ), __( '12go', 'cf' ), 'edit_theme_options', 'cf-12go', 'cf_em_breve' );
	        	// // UX Builder
	        	// add_submenu_page( 'cf_logo_options', __( 'UX Builder', 'cf' ), __( 'UX Builder', 'cf' ), 'edit_theme_options', 'cf-ux-builder', 'cf_em_breve' );
	        	// UX Builder Todas as Páginas
	        	add_submenu_page( 'cf_logo_options', __( 'Páginas', 'cf' ), __( 'UX Builder (Páginas)', 'cf' ), 'edit_theme_options', 'edit.php?post_type=page', null );
	        	// Adicionar página
	        	// add_submenu_page( 'cf-logo', __( 'Adicionar nova Página', 'cf' ), __( 'Adicionar nova Página', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=page', null );

	        // 6. Conteúdos
	        // add_menu_page( __( 'Conteúdos', 'cf' ), __( 'Conteúdos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', null, null, 7 );

	        	// O que você precisa saber?
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', 'cf_em_breve' );
	        	// Todos os Produtos
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'Produtos', 'cf' ), __( 'Produtos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', null );
	        	// Adicionar novo Produto
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'Adicionar novo produto', 'cf' ), __( 'Adicionar novo produto', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=product', null );
	        	// Categorias de Produto
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'Categoria de produto', 'cf' ), __( 'Categoria de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_cat&post_type=product', null );
	        	// Tags de Produto
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'Tag de produto', 'cf' ), __( 'Tag de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_tag&post_type=product', null );
	        	// Atributos de Produto
	        	// add_submenu_page( 'edit.php?post_type=product', __( 'Atributos de produto', 'cf' ), __( 'Atributos de produto', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product&page=product_attributes', null );
	        	// Todas as Páginas
	        	add_submenu_page( 'edit.php?post_type=product', __( 'Páginas', 'cf' ), __( 'Páginas', 'cf' ), 'edit_theme_options', 'edit.php?post_type=page', null );
	        	// Adicionar página
	        	// add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Adicionar nova Página', 'cf' ), __( 'Adicionar nova Página', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=page', null );
	        	// Todas as Mídia
	        	add_submenu_page( 'edit.php?post_type=product', __( 'Mídia', 'cf' ), __( 'Mídia', 'cf' ), 'edit_theme_options', 'upload.php', null );
	        	// Adicionar nova mídia
	        	// add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Adicionar nova mídia', 'cf' ), __( 'Adicionar nova mídia', 'cf' ), 'edit_theme_options', 'media-new.php', null );

	        // 7. ERP (Omnichannel)
	        add_menu_page( __( 'ERP (Omnichannel)', 'cf' ), __( 'ERP (Omnichannel)', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=integration', null, null, 8 );

	        	// O que você precisa saber?
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=integration', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=integration', 'cf_em_breve' );
	        	// Bling
	        	add_submenu_page( 'admin.php?page=wc-settings&tab=integration', __( 'Bling', 'cf' ), __( 'Bling', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=integration', null );

	        // 8. Segurança e Validação
	        // add_menu_page( __( 'Segurança e Validação', 'cf' ), __( 'Segurança e Validação', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 9 );
	        	
	        	// O que você precisa saber?
	        	// add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Certificado SSL
	        	// add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'Certificado SSL', 'cf' ), __( 'Certificado SSL', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-certificado-ssl', 'cf_em_breve' );
	        	// Selos e Segurança
	        	// add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'Selos e Segurança', 'cf' ), __( 'Selos e Segurança', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-selos-e-seguranca', 'cf_em_breve' );
	        	// Validação
	        	// add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'Validação', 'cf' ), __( 'Validação', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-validacao', 'cf_em_breve' );

	        // 9. Marketing
	        add_menu_page( __( 'Marketing', 'cf' ), __( 'Marketing', 'cf' ), 'edit_theme_options', 'edit.php', null, null, 9 );
	        	// O que você precisa saber?
	        	// add_submenu_page( 'edit.php', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'edit.php', 'cf_em_breve' );
	        	// BlogPosts
	        	add_submenu_page( 'edit.php', __( 'BlogPosts', 'cf' ), __( 'BlogPosts', 'cf' ), 'edit_theme_options', 'edit.php', null );
	        	// Categorias
	        	add_submenu_page( 'edit.php', __( 'Categorias', 'cf' ), __( 'Categorias', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=category', null );
	        	// Tags
	        	add_submenu_page( 'edit.php', __( 'Tags', 'cf' ), __( 'Tags', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=post_tag', null );
	        	// // Social
	        	// add_submenu_page( 'edit.php', __( 'Social', 'cf' ), __( 'Social', 'cf' ), 'edit_theme_options', 'cf-marketing-social', 'cf_em_breve' );
	        	// Popup
	        	add_submenu_page( 'edit.php', __( 'Popup', 'cf' ), __( 'Popup', 'cf' ), 'edit_theme_options', 'edit.php?post_type=inc_popup', null );
	        	// MailChimp
	        	add_submenu_page( 'edit.php', __( 'MailChimp', 'cf' ), __( 'MailChimp', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=mailchimp', null );
	        	// E-goi
	        	// add_submenu_page( 'edit.php', __( 'E-goi', 'cf' ), __( 'E-goi', 'cf' ), 'edit_theme_options', 'admin.php?page=egoi-mail-list-builder-contact-form-7-info', null );
	        	// SendinBlue
	        	// add_submenu_page( 'edit.php', __( 'SendinBlue', 'cf' ), __( 'SendinBlue', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=sendinblue', null );
	        	// Base de Contatos
	        	add_submenu_page( 'edit.php', __( 'Envios de Contatos', 'cf' ), __( 'Envios de Contatos', 'cf' ), 'edit_theme_options', 'admin.php?page=flamingo_inbound', null );
	        	// Envios de Contatos
	        	add_submenu_page( 'edit.php', __( 'Base de Contatos', 'cf' ), __( 'Base de Contatos', 'cf' ), 'edit_theme_options', 'admin.php?page=flamingo', null );
	        	// relatórios
	        	// add_submenu_page( 'cf-marketing-atrair', __( 'relatórios', 'cf' ), __( 'relatórios', 'cf' ), 'edit_theme_options', 'cf-marketing-relatorios', 'cf_em_breve' );
	        
	        // 10. Vendas e Pagamentos
	        add_menu_page( __( 'Vendas e Pagamentos', 'cf' ), __( 'Vendas e Pagamentos', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=checkout', null, null, 10 );
	        	// O que você precisa saber?
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=checkout', 'cf_em_breve' );
	        	// Formas de Pagamento
	        	add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Formas de Pagamento', 'cf' ), __( 'Formas de Pagamento', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=checkout', null );
	        	// Antifraudes
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Antifraudes', 'cf' ), __( 'Antifraudes', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-antifraudes', 'cf_em_breve' );
	        	// Parcelas
	        	add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Parcelas', 'cf' ), __( 'Parcelas', 'cf' ), 'edit_theme_options', 'edit.php?post_type=parcela', null );
	        	// Intermediadores
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Intermediadores', 'cf' ), __( 'Intermediadores', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-intermediadores', 'cf_em_breve' );
	        	// Facilitadores Subadquirentes
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Facilitadores Subadquirentes', 'cf' ), __( 'Facilitadores Subadquirentes', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-facilitadores-subadquirentes', 'cf_em_breve' );
	        	// Cupons
	        	add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Cupons', 'cf' ), __( 'Cupons', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_coupon', null );
	        	// Marketplaces
	        	// add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Marketplaces', 'cf' ), __( 'Marketplaces', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-marketplaces', 'cf_em_breve' );
	        	// Relatórios
	        	add_submenu_page( 'admin.php?page=wc-settings&tab=checkout', __( 'Relatórios', 'cf' ), __( 'Relatórios', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-reports', null ); // admin.php?page=wc-reports      	

	        // 11. Operações e Logística
	        add_menu_page( __( 'Operações e Logística', 'cf' ), __( 'Operações e Logística', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_order', null, null, 11 );

	        	// O que você precisa saber?
	        	// add_submenu_page( 'edit.php?post_type=shop_order', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_order', 'cf_em_breve' );
	        	// Pedidos
	        	add_submenu_page( 'edit.php?post_type=shop_order', __( 'Pedidos', 'cf' ), __( 'Pedidos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_order', null );
	        	// Todos os Produtos
	        	add_submenu_page( 'edit.php?post_type=shop_order', __( 'Produtos', 'cf' ), __( 'Produtos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', null );
	        	// Adicionar novo Produto
	        	// add_submenu_page( 'edit.php?post_type=shop_order', __( 'Adicionar novo produto', 'cf' ), __( 'Adicionar novo produto', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=product', null );
	        	// Categorias de Produto
	        	// add_submenu_page( 'edit.php?post_type=shop_order', __( 'Categoria de produto', 'cf' ), __( 'Categoria de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_cat&post_type=product', null );
	        	// Tags de Produto
	        	// add_submenu_page( 'edit.php?post_type=shop_order', __( 'Tag de produto', 'cf' ), __( 'Tag de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_tag&post_type=product', null );
	        	// Atributos de Produto
	        	// add_submenu_page( 'edit.php?post_type=shop_order', __( 'Atributos de produto', 'cf' ), __( 'Atributos de produto', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product&page=product_attributes', null );
	        	// Gestão de Transportes e Tabela de Fretes
	        	add_submenu_page( 'edit.php?post_type=shop_order', __( 'Gestão de Transportes e Tabela de Fretes', 'cf' ), __( 'Gestão de Transportes e Tabela de Fretes', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=shipping', null );	        	
	        // 12. Atendimento ao Cliente
	        add_menu_page( __( 'Atendimento ao Cliente', 'cf' ), __( 'Atendimento ao Cliente', 'cf' ), 'edit_theme_options', 'edit-comments.php', null, null, 12 );
	        	// O que você precisa saber?
	        	// add_submenu_page( 'edit-comments.php', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'edit-comments.php', 'cf_em_breve' );
	        	// Comentários
	        	add_submenu_page( 'edit-comments.php', __( 'Comentários', 'cf' ), __( 'Comentários', 'cf' ), 'edit_theme_options', 'edit-comments.php', null );
	        	// Tawk
	        	add_submenu_page( 'edit-comments.php', __( 'Tawk', 'cf' ), __( 'Tawk', 'cf' ), 'edit_theme_options', 'options-general.php?page=tawkto_plugin', null );
	        	// Chat
	        	// add_submenu_page( 'edit-comments.php', __( 'Chat', 'cf' ), __( 'Chat', 'cf' ), 'edit_theme_options', 'cf-atendimento-ao-cliente-chat', 'cf_em_breve' );	        	
	        	// Avaliação dos Clientes
	        	add_submenu_page( 'edit-comments.php', __( 'Avaliação dos Clientes', 'cf' ), __( 'Avaliação dos Clientes', 'cf' ), 'edit_theme_options', 'options-general.php?page=trustvox', null );	        	
	        	// E-mail
	        	add_submenu_page( 'edit-comments.php', __( 'E-mail Transacionais', 'cf' ), __( 'E-mail Transacionais', 'cf' ), 'edit_theme_options', 'admin.php?page=wc-settings&tab=email', null );	        	
	        	// Mensagem
	        	// add_submenu_page( 'edit-comments.php', __( 'Mensagem', 'cf' ), __( 'Mensagem', 'cf' ), 'edit_theme_options', 'cf-atendimento-ao-cliente-mensagem', 'cf_em_breve' );	        	


		}

		function cf_em_breve() {
			echo '<h3>Em breve!</h3>';
		}

		// Substitui o nome dos menus e submenus
		add_action( 'admin_menu', 'cf_troca_nomes', 150 );

		function cf_troca_nomes() {
			global $submenu;
			// cf_debug( $submenu );
			$submenu['cf_logo_options'][0][0] = __( 'Logo', 'cf' );
			$submenu['cf_formas_pagamento'][0][0] = __( 'Formas de Pagamento', 'cf' );
		}

		// Reordena o Admin Menu
		add_filter( 'custom_menu_order', 'cf_custom_menu_order', 10, 1 );
		add_filter( 'menu_order', 'cf_custom_menu_order', 10, 1 );

		function cf_custom_menu_order( $menu_ord ) {
			// cf_debug( $menu_ord );
		    if ( !$menu_ord ) return true;
		    // array(17) {
		    // [0]=>
		    // string(9) "index.php"
		    // [1]=>
		    // string(45) "cf-financeiro-calculo-de-investimento-inicial"
		    // [2]=>
		    // string(10) "separator1"
		    // [3]=>
		    // string(15) "cf_logo_options"
		    // [4]=>
		    // string(42) "admin.php?page=wc-settings&tab=integration"
		    // [5]=>
		    // string(42) "cf-marketing-tudo-o-que-voce-precisa-saber"
		    // [6]=>
		    // string(52) "cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber"
		    // [7]=>
		    // string(49) "cf-operacoes-e-logistica-o-que-voce-precisa-saber"
		    // [8]=>
		    // string(50) "cf-atendimento-ao-cliente-o-que-voce-precisa-saber"
		    // [9]=>
		    // string(26) "edit.php?post_type=product"
		    // [10]=>
		    // string(37) "edit.php?post_type=rdcf7_integrations"
		    // [11]=>
		    // string(10) "separator2"
		    // [12]=>
		    // string(9) "users.php"
		    // [13]=>
		    // string(14) "separator-last"
		    // [14]=>
		    // string(21) "separator-woocommerce"
		    // [15]=>
		    // string(10) "cf_options"		    // }
		    // cf_debug( $menu_ord );
		    $new_menu_order = array( 0, 1, 2, 3, 9, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15 );
		    $new_menu = [];
		    foreach( $new_menu_order as $i ) :
		    	$new_menu[ $i ] = $menu_ord[ $i ];
		    endforeach;
		    return $new_menu;
		}

	endif; // is_super_admin	
}

/*
Removes submenu items from WooCommerce menu for 'Shop Managers'
available submenu slugs are:
wc-addons - the Add-ons submenu
wc-status - the System Status submenu
wc-reports - the Reports submenu
edit.php?post_type=shop_order - the Orders submenu
edit.php?post_type=shop_coupon - the Coupons submenu

Shop Managers lack the capability of 'update_core', so remove based on that capability
 */

function cf_remove_items() {
 $remove = array( 'wc-settings', 'wc-status', 'wc-addons', );
  foreach ( $remove as $submenu_slug ) {
    remove_submenu_page( 'woocommerce', $submenu_slug );
  }
}

// add_action( 'admin_menu', 'cf_remove_items', 99, 0 );