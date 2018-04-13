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
	// Verificar se iremos manter isso
	add_action( 'admin_head', 'cf_menus_edit_style' );

	function cf_menus_edit_style() {
		$screen = get_current_screen();
		// cf_debug( $screen->id );
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
				li#add-custom-links {
					display: block !important;
				}
			</style>
		<?php elseif( $screen->id == 'users' ) : ?>
			<?php /* ?>
			<style>
				#new_role,
				#changeit,
				#ure_grant_roles {
					display: none;
				}
				<?php */ ?>
			</style>
		<?php elseif( $screen->id == 'woocommerce_page_wc-settings' ) : ?>
			<style>
				h2:nth-child(2) {
					/*display: none;*/
					
				}
			</style>
		<?php endif;
	}


}