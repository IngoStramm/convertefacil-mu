<?php

add_action( 'init', 'cf_admin_style_init' );

function cf_admin_style_init() {

	// Customiza tela de Login do WP
	// add_action( 'login_enqueue_scripts', 'wptutsplus_login_logo' );

	function wptutsplus_login_logo() { ?>
	    <style type="text/css">
	    	body.login {
	            position: relative;
	    		background-color: #333 !important;
	            /*background-image: url( <?php echo CF_URL; ?>/assets/images/bg.jpg ) !important;*/
	            background-image: none !important;
	    		background-repeat: no-repeat !important;
	    		background-position: center top !important;
				-webkit-background-size: cover !important;
				background-size: cover !important;
	    		display: block;
	    	}
	        body.login #login h1 a {
	            background-image: url( <?php echo CF_URL; ?>/assets/images/logo.png ) !important;
				width: 100% !important;
				-webkit-background-size: contain !important;
				background-size: contain !important;
	        }
	        body.login #backtoblog a, 
	        body.login #nav a, 
	        body.login h1 a	{
	        	color: #fff;
	        }
	        .wp-core-ui .button-primary {
	            text-transform: uppercase;
	            text-shadow: none;
	            border: none;
	        	background: #fff;
	            color: #fff;
	        }
	        .wp-core-ui .button-primary.active, 
	        .wp-core-ui .button-primary.active:focus, 
	        .wp-core-ui .button-primary.active:hover, 
	        .wp-core-ui .button-primary:active,
	        .wp-core-ui .button-primary.focus, 
	        .wp-core-ui .button-primary.hover, 
	        .wp-core-ui .button-primary:focus, 
	        .wp-core-ui .button-primary:hover {
	            border: none;
	        	background: #fff;
	            color: #fff;
	        }
	    </style> <?php 
	}

	// Adiciona o estilo do ConverteFácil no admin e no admibar
	// add_action( 'wp_head', 'cf_admin_style' );
	// add_action( 'admin_head', 'cf_admin_style' );

	function cf_admin_style() {
		?>
		<style>
			#wpadminbar {
				background-color: #00a99d;
			}
			#adminmenu, 
			#adminmenu .wp-submenu, 
			#adminmenuback, 
			#adminmenuwrap {
				background-color: #027c73;
			}
			#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, 
			#adminmenu .wp-menu-arrow, 
			#adminmenu .wp-menu-arrow div, 
			#adminmenu li.current a.menu-top, 
			#adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, 
			.folded #adminmenu li.current.menu-top, 
			.folded #adminmenu li.wp-has-current-submenu {
				background-color: #1c443f;
			}
			#adminmenu .wp-has-current-submenu .wp-submenu, 
			#adminmenu .wp-has-current-submenu .wp-submenu.sub-open, 
			#adminmenu .wp-has-current-submenu.opensub .wp-submenu, 
			#adminmenu a.wp-has-current-submenu:focus+.wp-submenu, 
			.no-js li.wp-has-current-submenu:hover .wp-submenu {
				background-color: #11312d;
			}
			#adminmenu li.menu-top:hover, 
			#adminmenu li.opensub>a.menu-top, 
			#adminmenu li>a.menu-top:focus,
			#adminmenu .opensub .wp-submenu li:hover,
			#adminmenu li.menu-top:hover, 
			#adminmenu li.opensub>a.menu-top, 
			#adminmenu li>a.menu-top:focus {
				background-color: #193a36;
				color: #00a99d;
			}
			#adminmenu li a:focus div.wp-menu-image:before, 
			#adminmenu li.opensub div.wp-menu-image:before, 
			#adminmenu li:hover div.wp-menu-image:before,
			#adminmenu .wp-submenu a:focus, 
			#adminmenu .wp-submenu a:hover, 
			#adminmenu a:hover, 
			#adminmenu li.menu-top>a:focus {
				color: #00a99d;
			}
			.wrap .add-new-h2:hover, 
			.wrap .page-title-action:hover,
			.wp-core-ui .button-primary {
				background-color: #027c73;
				border-color: #005a54;
			}
			.wp-core-ui .button-primary.focus, 
			.wp-core-ui .button-primary.hover, 
			.wp-core-ui .button-primary:focus, 
			.wp-core-ui .button-primary:hover {
				background: #1c443f;
			    border-color: #1c443f;
			}
			.cf-mini-logo {
				display: block;
				height: 32px !important;
				width: 100px !important;
				background: transparent url(<?php echo CF_URL; ?>/assets/images/mini-logo-admin-bar.png ) center no-repeat;
				-webkit-background-size: contain;
				background-size: contain;
			}
			#wpadminbar #wp-admin-bar-my-account.with-avatar #wp-admin-bar-user-actions > li {
				margin-left: 16px;
			}
			#wpadminbar #wp-admin-bar-my-account.with-avatar > .ab-empty-item img, 
			#wpadminbar #wp-admin-bar-my-account.with-avatar > a img,
			#wp-admin-bar-user-info .avatar {
				display: none;
			}
		</style>
		<?php
	}

	// Estilo do painel de Bem Vindo do ConverteFácil
	// add_action( 'admin_head', 'cf_bem_vindo_style' );

	function cf_bem_vindo_style() {
		?>
		<style>
			#dashboard-widgets #bem-vindo.postbox .inside {
				margin: 0;
				padding: 0;
				line-height: 0;
			}
		</style>
		<?php
	}

	// Esconde algumas opções nas telas de menu e usuários
	add_action( 'admin_head', 'cf_menus_edit_style' );

	function cf_menus_edit_style() {
		$user_id = get_current_user_id();

		if( is_super_admin( $user_id ) )
			return;

		$screen = get_current_screen();
		// cf_debug( $screen->id );
		$form_screens_ids = array( 
			'toplevel_page_forminator',
			'toplevel_page_forminator-network',
			'forminator_page_forminator-cform',
			'forminator_page_forminator-cform-network',
			'forminator_page_forminator-poll',
			'forminator_page_forminator-poll-network',
			'forminator_page_forminator-quiz',
			'forminator_page_forminator-quiz-network',
			'forminator_page_forminator-settings',
			'forminator_page_forminator-settings-network',
			'forminator_page_forminator-cform-wizard',
			'forminator_page_forminator-cform-wizard-network',
			'forminator_page_forminator-cform-view',
			'forminator_page_forminator-cform-view-network',
			'forminator_page_forminator-poll-wizard',
			'forminator_page_forminator-poll-wizard-network',
			'forminator_page_forminator-poll-view',
			'forminator_page_forminator-poll-view-network',
			'forminator_page_forminator-nowrong-wizard',
			'forminator_page_forminator-nowrong-wizard-network',
			'forminator_page_forminator-knowledge-wizard',
			'forminator_page_forminator-knowledge-wizard-network',
			'forminator_page_forminator-quiz-view',
			'forminator_page_forminator-quiz-view-network'
		);
		if( $screen->id == 'nav-menus' ) : ?>
			<style>
				a.page-title-action.hide-if-no-customize,
				h2.nav-tab-wrapper.wp-clearfix,
				.manage-menus,
				span.add-new-menu-action,
				.menu-settings,
				li#add-category,
				li#woocommerce_endpoints_nav_link,
				span.delete-action,
				.major-publishing-actions label.menu-name-label,
				.major-publishing-actions input#menu-name {
					display: none !important;
				}
				li#add-post-type-page,
				li#add-post-type-post,
				li#add-custom-links,
				li#add-product_cat {
					display: block !important;
				}
			</style>
		<?php elseif( $screen->id == 'users' ) : ?>
			<style>
			<?php /* ?>
				#new_role,
				#changeit,
				#ure_grant_roles {
					display: none;
				}
			</style>
			<?php */ ?>
		<?php elseif( $screen->id == 'user' ) : ?>
			<style>
				#add-existing-user,
				#add-existing-user + p,
				#adduser {
					display: none;
				}
			</style>
		<?php elseif( $screen->id == 'woocommerce_page_wc-settings' ) : ?>
			<?php $current_tab = isset( $_GET['tab'] ) && !empty( $_GET['tab'] ) ? $_GET['tab'] : false; ?>
			<?php if( $current_tab == 'shipping') : ?>
				<style>
					.woocommerce_page_wc-settings .subsubsub,
					.woocommerce_page_wc-settings h2,
					.woocommerce_page_wc-settings .subsubsub li:nth-child(2),
					.woocommerce_page_wc-settings .subsubsub li:nth-child(3),
					.woocommerce_page_wc-settings .form-table.wc-shipping-zone-settings .titledesc,
					.woocommerce_page_wc-settings .form-table.wc-shipping-zone-settings .forminp,
					.woocommerce_page_wc-settings .form-table.wc-shipping-zone-settings .button.wc-shipping-zone-add-method
					{
							display: none;
					}
				</style>
			<?php elseif( $current_tab == 'checkout') : ?>
				<style>
					.woocommerce_page_wc-settings #mainform .subsubsub,
					.woocommerce_page_wc-settings #mainform h2:nth-child(1),
					.woocommerce_page_wc-settings #mainform h2:nth-child(2),
					.woocommerce_page_wc-settings #mainform h2:nth-child(3),
					.woocommerce_page_wc-settings #mainform h2:nth-child(4),
					.woocommerce_page_wc-settings #mainform h2:nth-child(5),
					.woocommerce_page_wc-settings #mainform h2:nth-child(6),
					.woocommerce_page_wc-settings #mainform h2:nth-child(7),
					.woocommerce_page_wc-settings #mainform h2:nth-child(8),
					.woocommerce_page_wc-settings #mainform h2:nth-child(1) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(2) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(3) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(4) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(5) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(6) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(7) + .form-table,
					.woocommerce_page_wc-settings #mainform h2:nth-child(8) + .form-table
					
					{
							display: none;
					}
				</style>
			<?php endif; ?>
		<?php elseif( $screen->id == 'settings_page_tawkto_plugin' ) : ?>
			<style>
				.tawksettingsbody .tawktabs .tawktablinks:nth-child(2),
				.tawksettingsbody .tawktabs .tawktablinks:nth-child(3) {
					display: none;
				}
			</style>
		<?php elseif( $screen->id == 'settings_page_trustvox' ) : ?>
			<style>
				.settings_page_trustvox .nav-tab-wrapper .nav-tab:nth-child(2),
				.settings_page_trustvox .nav-tab-wrapper .nav-tab:nth-child(3),
				.settings_page_trustvox .nav-tab-wrapper .nav-tab:nth-child(4),
				.settings_page_trustvox .nav-tab-wrapper .nav-tab:nth-child(5),
				.settings_page_trustvox .form-table tr:nth-child(3)
				{
					display: none;
				}
			</style>
		<?php elseif( $screen->id == 'woo-feed_page_woo_feed_manage_feed' ) : // woo-feed_page_woo_feed_manage_feed ?>
			<style>
				.woo-feed_page_woo_feed_manage_feed #wpbody-content .wrap table.widefat.fixed:nth-child(3),
				.woo-feed_page_woo_feed_manage_feed #wpbody-content .wrap table.widefat.fixed:nth-child(4)
				{
					display: none;
				}
			</style>
		<?php elseif( in_array( $screen->id, $form_screens_ids )  ) : ?>
			<style>
				.wpmudev-ui #wpmudev-header .wpmudev-header--sub .wpmudev-button.wpmudev-button-sm.wpmudev-button-ghost
				{
					display: none;
				}
			</style>
		<?php elseif( $screen->id == 'profile' ) : ?>
			<style>
/*				.woo-feed_page_woo_feed_manage_feed #wpbody-content .wrap table.widefat.fixed:nth-child(3),
				.woo-feed_page_woo_feed_manage_feed #wpbody-content .wrap table.widefat.fixed:nth-child(4)
				{
					display: none;
				}
*/			</style>
		<?php endif;
	}


}