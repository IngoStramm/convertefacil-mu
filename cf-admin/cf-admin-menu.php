<?php

add_action( 'init', 'cf_admin_menu_init' );

function cf_admin_menu_init() {

	$user_id = get_current_user_id();
	if( !is_super_admin( $user_id ) ) :

		// Remove Menus do sidebar
		add_action( 'admin_menu', 'cf_remove_menus', 99, 0 );
		// add_action( 'admin_init', 'cf_remove_menus', 1 );

		function cf_remove_menus(){
	        global $submenu;
	        // cf_debug( $submenu );
	        // $edit_menu = $submenu['themes.php'][10];
	        // add_menu_page( __( 'Editar Menus' ), __( ' Menus '), 'edit_theme_options', 'nav-menus.php', null, null, 60 );
	        // remove_menu_page( 'index.php' );                  //Dashboard
	        // remove_menu_page( 'edit.php' );                   //Posts
	        remove_menu_page( 'edit.php?post_type=page' );       //Páginas
	        remove_menu_page( 'upload.php' );                    //Media
	        // remove_menu_page( 'edit.php?post_type=page' );    //Pages
	        remove_menu_page( 'edit-comments.php' );          //Comments
	        // remove_menu_page( 'themes.php' );                 //Appearance
	        // remove_menu_page( 'plugins.php' );                //Plugins
	        // remove_menu_page( 'users.php' );                  //Users
	        // remove_menu_page( 'tools.php' );                  //Tools
	        // remove_menu_page( 'admin.php?page=jetpack' );                 
	        // remove_menu_page( 'options-general.php' );        //Settings
	        // remove_menu_page( 'duplicator' ); 
	        // remove_menu_page( 'wpcf7' ); 
	        // remove_menu_page( 'edit.php?post_type=featured_item' ); 
	        // remove_menu_page( 'edit.php?post_type=blocks' ); 
	        remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?taxonomy=product_cat&post_type=product' ); // Posts - Categories
			remove_submenu_page( 'edit.php?post_type=product', 'edit-tags.php?product_tag&post_type=product' ); // Posts - Tags
			remove_submenu_page( 'edit-comments.php', 'edit-comments.php' ); // Posts - Tags

	        // Produtos
	        remove_menu_page( 'edit.php?post_type=product' ); 

	        // Submenu items
	        // remove_submenu_page( 'themes.php', 'customize.php' );   
	        // remove_submenu_page( 'themes.php', 'themes.php' );
	        // remove_submenu_page( 'themes.php', 'nav-menus.php' );   
	        remove_submenu_page( 'upload.php', 'upload.php' );   
	        remove_submenu_page( 'upload.php', 'upload_files' );   
	        remove_submenu_page( 'upload.php', 'media-new.php' );   

	        // Produtos
	        unset($submenu['edit.php?post_type=product'][5]); // Produtos     
	        unset($submenu['edit.php?post_type=product'][10]); // Add new // post-new.php?post_type=product
	        unset($submenu['edit.php?post_type=product'][15]); // Categorias // edit-tags.php?taxonomy=product_cat&post_type=product
	        unset($submenu['edit.php?post_type=product'][16]); // Tags // edit-tags.php?taxonomy=product_tag&post_type=product
	        unset($submenu['edit.php?post_type=product'][17]); // Atributos // edit.php?post_type=product&page=product_attributes

	        // Woocommerce
	        remove_menu_page( 'woocommerce' );                    							//WC
	        remove_submenu_page( 'woocommerce', 'edit.php?post_type=shop_order' );			// pedidos
	        remove_submenu_page( 'woocommerce', 'edit.php?post_type=shop_coupon' );			// coupons
	        remove_submenu_page( 'woocommerce', 'wc-reports' );								// relatórios // admin.php?page=wc-reports
	        	        
	        // Appearance Menu
	        // unset($submenu['themes.php'][5]); // Themes        
	        // unset($submenu['themes.php'][6]); // Customize link
	        // unset($submenu['themes.php'][7]); // Widgets
	        unset($submenu['themes.php'][10]); // Menus
	        unset($submenu['edit.php?post_type=page'][5]); // Páginas
	        unset($submenu['edit.php?post_type=page'][10]); // Adicionar nova
	        unset($submenu['upload.php'][5]); // Mídia
	        unset($submenu['upload.php'][10]); // Adicionar nova
	        // unset($submenu['themes.php'][15]); // Customize link
	        // unset($submenu['themes.php'][20]); // Background
	        // unset($submenu['edit.php?post_type=popup'][11]); // Background
	        // unset($submenu['edit.php?post_type=popup'][12]); // Background
	        // unset($submenu['edit.php?post_type=popup'][13]); // Background

	        // Media Library Folders
	        // unset($submenu['media-library-folders'][2]);
	        // unset($submenu['media-library-folders'][5]);
	        // unset($submenu['media-library-folders'][6]);

	    }

		
        // Adiciona novos elementos ao menu
		add_action( 'admin_menu', 'cf_add_menus' );
	    function cf_add_menus() {


	        // Planejamento
	        add_menu_page( __( 'Planejamento', 'cf' ), __( 'Planejamento', 'cf' ), 'edit_theme_options', 'cf-planejamento-o-que-voce-precisa-saber', 'cf_em_breve', null, 2 );
	        
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-planejamento-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Consultorias
	        	add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'Consultorias', 'cf' ), __( 'Consultorias', 'cf' ), 'edit_theme_options', 'cf-planejamento-consultorias', 'cf_em_breve' );
	        	// OKR
	        	add_submenu_page( 'cf-planejamento-o-que-voce-precisa-saber', __( 'OKR', 'cf' ), __( 'OKR', 'cf' ), 'edit_theme_options', 'cf-planejamento-okr', 'cf_em_breve' );

	        // Financeiro
	        add_menu_page( __( 'Financeiro', 'cf' ), __( 'Financeiro', 'cf' ), 'edit_theme_options', 'cf-financeiro-o-que-voce-precisa-saber', 'cf_em_breve', null, 3 );
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-financeiro-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-financeiro-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Calculo de Investimento Inicial
	        	add_submenu_page( 'cf-financeiro-o-que-voce-precisa-saber', __( 'Calculo de Investimento Inicial', 'cf' ), __( 'Calculo de Investimento Inicial', 'cf' ), 'edit_theme_options', 'cf-financeiro-calculo-de-investimento-inicial', 'cf_em_breve' );
	        	// Custos Fixos
	        	add_submenu_page( 'cf-financeiro-o-que-voce-precisa-saber', __( 'Custos Fixos', 'cf' ), __( 'Custos Fixos', 'cf' ), 'edit_theme_options', 'cf-financeiro-custos-fixos', 'cf_em_breve' );
	        	// Integração com ERP
	        	add_submenu_page( 'cf-financeiro-o-que-voce-precisa-saber', __( 'Integração com ERP', 'cf' ), __( 'Integração com ERP', 'cf' ), 'edit_theme_options', 'cf-financeiro-integracao-com-erp', 'cf_em_breve' );
	        
	        // Contabilidade e Jurídico
	        add_menu_page( __( 'Contabilidade e Jurídico', 'cf' ), __( 'Contabilidade e Jurídico', 'cf' ), 'edit_theme_options', 'cf-juridico-o-que-voce-precisa-saber', 'cf_em_breve', null, 4 );
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-juridico-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Termos de Uso
	        	add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Termos de Uso', 'cf' ), __( 'Termos de Uso', 'cf' ), 'edit_theme_options', 'cf-juridico-termos-de-uso', 'cf_em_breve' );
	        	// Trocas e Devoluções/Direito de Arrependimento
	        	add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Trocas e Devoluções/Direito de Arrependimento', 'cf' ), __( 'Trocas e Devoluções/Direito de Arrependimento', 'cf' ), 'edit_theme_options', 'cf-juridico-trocas-e-devolucoes-arrependimento', 'cf_em_breve' );
	        	// Integração
	        	add_submenu_page( 'cf-juridico-o-que-voce-precisa-saber', __( 'Integração', 'cf' ), __( 'Integração', 'cf' ), 'edit_theme_options', 'cf-juridico-integracao', 'cf_em_breve' );
	        
	        // Equipe
	        add_menu_page( __( 'Equipe', 'cf' ), __( 'Equipe', 'cf' ), 'edit_theme_options', 'cf-equipe-o-que-voce-precisa-saber', 'cf_em_breve', null, 5 );
	        
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-equipe-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Equipe de um e-commerce
	        	add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Equipe de um e-commerce', 'cf' ), __( 'Equipe de um e-commerce', 'cf' ), 'edit_theme_options', 'cf-equipe-de-um-ecommerce', 'cf_em_breve' );
	        	// Descrição de cargos e responsabilidades
	        	add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Descrição de cargos e responsabilidades', 'cf' ), __( 'Descrição de cargos e responsabilidades', 'cf' ), 'edit_theme_options', 'cf-descricao-de-cargos-e-responsabilidades', 'cf_em_breve' );
	        	// Encontre o profissional
	        	add_submenu_page( 'cf-equipe-o-que-voce-precisa-saber', __( 'Encontre o profissional', 'cf' ), __( 'Encontre o profissional', 'cf' ), 'edit_theme_options', 'cf-encontre-o-profissional', 'cf_em_breve' );

	        // Layout e Temas
	        add_menu_page( __( 'Layout e Temas', 'cf' ), __( 'Layout e Temas', 'cf' ), 'edit_theme_options', 'cf-12go', 'cf_em_breve', null, 6 );

	        	// 12go
	        	add_submenu_page( 'cf-12go', __( '12go', 'cf' ), __( '12go', 'cf' ), 'edit_theme_options', 'cf-12go', 'cf_em_breve' );
	        	// 12go
	        	add_submenu_page( 'cf-12go', __( 'UX Builder', 'cf' ), __( 'UX Builder', 'cf' ), 'edit_theme_options', 'cf-ux-builder', 'cf_em_breve' );
	        	// Menu
	        	add_submenu_page( 'cf-12go', __( 'Menu', 'cf' ), __( 'Menu', 'cf' ), 'edit_theme_options', 'nav-menus.php', null );
	        	// Banner
	        	add_submenu_page( 'cf-12go', __( 'Banner', 'cf' ), __( 'Banner', 'cf' ), 'edit_theme_options', 'cf-banner', 'cf_em_breve' );

	        // Conteúdos
	        add_menu_page( __( 'Conteúdos', 'cf' ), __( 'Conteúdos', 'cf' ), 'edit_theme_options', 'cf-conteudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 7 );

	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-conteudo-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Todos os Produtos
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Produtos', 'cf' ), __( 'Produtos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', null );
	        	// Adicionar novo Produto
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Adicionar novo produto', 'cf' ), __( 'Adicionar novo produto', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=product', null );
	        	// Categorias de Produto
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Categoria de produto', 'cf' ), __( 'Categoria de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_cat&post_type=product', null );
	        	// Tags de Produto
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Tag de produto', 'cf' ), __( 'Tag de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_tag&post_type=product', null );
	        	// Atributos de Produto
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Atributos de produto', 'cf' ), __( 'Atributos de produto', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product&page=product_attributes', null );
	        	// Todas as Páginas
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Páginas', 'cf' ), __( 'Páginas', 'cf' ), 'edit_theme_options', 'edit.php?post_type=page', null );
	        	// Adicionar página
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Adicionar nova Página', 'cf' ), __( 'Adicionar nova Página', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=page', null );
	        	// Todas as Mídia
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Mídia', 'cf' ), __( 'Mídia', 'cf' ), 'edit_theme_options', 'upload.php', null );
	        	// Adicionar nova mídia
	        	add_submenu_page( 'cf-conteudo-o-que-voce-precisa-saber', __( 'Adicionar nova mídia', 'cf' ), __( 'Adicionar nova mídia', 'cf' ), 'edit_theme_options', 'media-new.php', null );

	        // ERP (Integrações, Omnichannel)
	        add_menu_page( __( 'ERP (Integrações, Omnichannel)', 'cf' ), __( 'ERP (Integrações, Omnichannel)', 'cf' ), 'edit_theme_options', 'cf-erp-integracao-tudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 8 );

	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-erp-integracao-tudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-erp-integracao-tudo-o-que-voce-precisa-saber', 'cf_em_breve' );
		        	// Bling
		        	add_submenu_page( 'cf-erp-integracao-tudo-o-que-voce-precisa-saber', __( 'Bling', 'cf' ), __( 'Bling', 'cf' ), 'edit_theme_options', 'cf-erp-integracao-bling', 'cf_em_breve' );

	        // Segurança e Validação
	        add_menu_page( __( 'Segurança e Validação', 'cf' ), __( 'Segurança e Validação', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 9 );
	        	
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Selos e Segurança
	        	add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'Selos e Segurança', 'cf' ), __( 'Selos e Segurança', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-selos-e-seguranca', 'cf_em_breve' );
	        	// Validação
	        	add_submenu_page( 'cf-seguranca-e-validacao-tudo-o-que-voce-precisa-saber', __( 'Validação', 'cf' ), __( 'Validação', 'cf' ), 'edit_theme_options', 'cf-seguranca-e-validacao-validacao', 'cf_em_breve' );

	        // Marketing
	        add_menu_page( __( 'Marketing', 'cf' ), __( 'Marketing', 'cf' ), 'edit_theme_options', 'cf-marketing-tudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 9 );
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-marketing-tudo-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Configurações
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'Configurações', 'cf' ), __( 'Configurações', 'cf' ), 'edit_theme_options', 'cf-marketing-configuracoes', 'cf_em_breve' );
	        	// Atrair Clientes
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'Atrair Clientes', 'cf' ), __( 'Atrair Clientes', 'cf' ), 'edit_theme_options', 'cf-marketing-atrair-clientes', 'cf_em_breve' );
	        	// Converter em Vendas
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'Converter em Vendas', 'cf' ), __( 'Converter em Vendas', 'cf' ), 'edit_theme_options', 'cf-marketing-converter-em-vendas', 'cf_em_breve' );
	        	// Se relacionar com clientes
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'Se relacionar com clientes', 'cf' ), __( 'Se relacionar com clientes', 'cf' ), 'edit_theme_options', 'cf-marketing-se-relacionar-com-clientes', 'cf_em_breve' );
	        	// relatórios
	        	add_submenu_page( 'cf-marketing-tudo-o-que-voce-precisa-saber', __( 'relatórios', 'cf' ), __( 'relatórios', 'cf' ), 'edit_theme_options', 'cf-marketing-relatorios', 'cf_em_breve' );
	        
	        // Vendas e Pagamentos
	        add_menu_page( __( 'Vendas e Pagamentos', 'cf' ), __( 'Vendas e Pagamentos', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', 'cf_em_breve', null, 10 );
	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Parcelas
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Parcelas', 'cf' ), __( 'Parcelas', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-parcelas', 'cf_em_breve' );
	        	// Intermediadores
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Intermediadores', 'cf' ), __( 'Intermediadores', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-intermediadores', 'cf_em_breve' );
	        	// Facilitadores Subadquirentes
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Facilitadores Subadquirentes', 'cf' ), __( 'Facilitadores Subadquirentes', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-facilitadores-subadquirentes', 'cf_em_breve' );
	        	// Boleto Bancário
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Boleto Bancário', 'cf' ), __( 'Boleto Bancário', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-boleto-bancario', 'cf_em_breve' );
	        	// Antifraudes
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Antifraudes', 'cf' ), __( 'Antifraudes', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-antifraudes', 'cf_em_breve' );
	        	// Marketplaces
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Marketplaces', 'cf' ), __( 'Marketplaces', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-marketplaces', 'cf_em_breve' );
	        	// Cupons
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Cupons', 'cf' ), __( 'Cupons', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_coupon', null );
	        	// Relatórios
	        	add_submenu_page( 'cf-vendas-e-pagamentos-tudo-o-que-voce-precisa-saber', __( 'Relatórios', 'cf' ), __( 'Relatórios', 'cf' ), 'edit_theme_options', 'cf-vendas-e-pagamentos-relatorios', 'cf_em_breve' ); // admin.php?page=wc-reports      	

	        // Operações e Logística
	        add_menu_page( __( 'Operações e Logística', 'cf' ), __( 'Operações e Logística', 'cf' ), 'edit_theme_options', 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', 'cf_em_breve', null, 11 );

	        	// O que você precisa saber?
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'O que você precisa saber?', 'cf' ), __( 'O que você precisa saber?', 'cf' ), 'edit_theme_options', 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', 'cf_em_breve' );
	        	// Pedidos
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Pedidos', 'cf' ), __( 'Pedidos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=shop_order', null );
	        	// Todos os Produtos
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Produtos', 'cf' ), __( 'Produtos', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product', null );
	        	// Adicionar novo Produto
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Adicionar novo produto', 'cf' ), __( 'Adicionar novo produto', 'cf' ), 'edit_theme_options', 'post-new.php?post_type=product', null );
	        	// Categorias de Produto
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Categoria de produto', 'cf' ), __( 'Categoria de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_cat&post_type=product', null );
	        	// Tags de Produto
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Tag de produto', 'cf' ), __( 'Tag de produto', 'cf' ), 'edit_theme_options', 'edit-tags.php?taxonomy=product_tag&post_type=product', null );
	        	// Atributos de Produto
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Atributos de produto', 'cf' ), __( 'Atributos de produto', 'cf' ), 'edit_theme_options', 'edit.php?post_type=product&page=product_attributes', null );
	        	// Gestão de Transportes e Tabela de Fretes
	        	add_submenu_page( 'cf-operacoes-e-logistica-o-que-voce-precisa-saber', __( 'Gestão de Transportes e Tabela de Fretes', 'cf' ), __( 'Gestão de Transportes e Tabela de Fretes', 'cf' ), 'edit_theme_options', 'cf-operacoes-e-logistica-gestao-de-transportes-e-tabela-de-fretes', 'cf_em_breve' );	        	
	        // Atendimento ao Cliente
	        add_menu_page( __( 'Atendimento ao Cliente', 'cf' ), __( 'Atendimento ao Cliente', 'cf' ), 'edit_theme_options', 'edit-comments.php', null, null, 12 );
	        	// Comentários
	        	add_submenu_page( 'edit-comments.php', __( 'Comentários', 'cf' ), __( 'Comentários', 'cf' ), 'edit_theme_options', 'edit-comments.php', null );
	        	// Chat
	        	add_submenu_page( 'edit-comments.php', __( 'Chat', 'cf' ), __( 'Chat', 'cf' ), 'edit_theme_options', 'cf-atendimento-ao-cliente-chat', 'cf_em_breve' );	        	
	        	// E-mail
	        	add_submenu_page( 'edit-comments.php', __( 'E-mail', 'cf' ), __( 'E-mail', 'cf' ), 'edit_theme_options', 'cf-atendimento-ao-cliente-email', 'cf_em_breve' );	        	
	        	// Mensagem
	        	add_submenu_page( 'edit-comments.php', __( 'Mensagem', 'cf' ), __( 'Mensagem', 'cf' ), 'edit_theme_options', 'cf-atendimento-ao-cliente-mensagem', 'cf_em_breve' );	        	


		}

		function cf_em_breve() {
			echo '<h3>Em breve!</h3>';
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

function wooninja_remove_items() {
 $remove = array( 'wc-settings', 'wc-status', 'wc-addons', );
  foreach ( $remove as $submenu_slug ) {
    remove_submenu_page( 'woocommerce', $submenu_slug );
  }
}

add_action( 'admin_menu', 'wooninja_remove_items', 99, 0 );