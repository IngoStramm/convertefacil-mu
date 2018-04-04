<?php
require_once 'feedback/feedback-response.php';

add_action( 'init', 'cf_admin_dashboard_init' );

function cf_admin_dashboard_init() {

	$user_id = get_current_user_id();

	if( !is_super_admin( $user_id ) ) :

		// Dashboard: Customiza os Widgets
		add_action( 'wp_dashboard_setup', 'cf_dashboard_widgets' );

		function cf_dashboard_widgets() {
			global $wp_meta_boxes;

			// cf_debug( $wp_meta_boxes['dashboard']['normal'] );
			
			// Remove os Widgets
			// Agora
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
			// Postagem rápida
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
			// Novidades WP
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
			// Woocommerce Avaliações Recentes
			remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
			// remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );

			// Yoast SEO
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
			// Google Analytics
			// remove_meta_box( 'gadwp-widget', 'dashboard', 'normal' );

			// Atividades
			remove_meta_box( 'dashboard_activity', 'dashboard', 'normal' );
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity'] );
			// Yoast SEO
			unset( $wp_meta_boxes['dashboard']['normal']['core']['wpseo-dashboard-overview'] );

			// Adiciona novos Widgets
			// Coluna da esquerda
			wp_add_dashboard_widget( 'bem-vindo', __( 'Bem vindo!', 'cf' ),'cd_add_welcome_widget','dashboard','normal','high');
			wp_add_dashboard_widget( 'modulos', __( 'Loja Converte Fácil', 'cf' ),'cf_add_modules','dashboard','normal','high');
			// Coluna da direita
			wp_add_dashboard_widget( 'feedback', __( 'Feedback', 'cf' ),'cf_feedback','dashboard','side','high');
			add_meta_box( 'dashboard_activity', __( 'Activity' ), 'wp_dashboard_site_activity', 'dashboard', 'side', 'core' );
		}

		// Remove o painel de 'Bem Vindo ao Wordpress'
		remove_action('welcome_panel', 'wp_welcome_panel');

		// Exibe painel de bem-vindo do COnverteFácil
		function cd_add_welcome_widget(){
			?><a href="https://convertefacil.com.br" target="_blank"><img style="width: 100%; margin: auto;" src="<?php echo CF_URL; ?>/assets/images/banner-dashboard.jpg" alt="<?php echo __( 'Saiba tudo sobre a plataforma. Clique aqui!', 'cf' ); ?>"></a><?php 
		}

		// Exibe os Módulos
		function cf_add_modules() { 
			?><ul>
				<li><a href="#"><?php _e( 'Adicionar Módulos (Em breve)', 'cf' ); ?></a></li>
				<li><a href="#"><?php _e( 'Contratar Design (Em breve)', 'cf' ); ?></a></li>
				<li><a href="#"><?php _e( 'Contratar Redação de Textos (Em breve)', 'cf' ); ?></a></li>
				<li><?php _e( 'Telefone:', 'cf' ); ?> <a href="tel:+551127597931">(11) 2759-7931</a></li>
				<li><?php _e( 'Email:', 'cf' ); ?> <a href="mailto:contato@convertefacil.com.br"><?php _e( 'contato@convertefacil.com.br', 'cf' ); ?></a></li>
			</ul><?php 
		}

		// Inclui o frontend fo formulário de feedback
		function cf_feedback() {
			include 'feedback/feedback-form.php';
		}

		// Adiciona as últimas notícias do blog
		add_action( 'wp_dashboard_setup', 'cf_add_feed_widget' );

		function cf_add_feed_widget() {
		     wp_add_dashboard_widget( 'cf_feed_widget', __( 'Últimas notícias do ConverteFacil', 'cf' ), 'cf_feed_widget', 'dashboard', 'side', 'high' );
		}

		function cf_feed_widget() {
		     $rss = fetch_feed( 'https://lawyerist.com/feed/' );

		     if ( is_wp_error($rss) ) {
		          if ( is_admin() || current_user_can( 'manage_options' ) ) {
		               echo '<p>';
		               printf( __( '<strong>RSS Erro</strong>: %s', 'cf' ), $rss->get_error_message() );
		               echo '</p>';
		          }
		     return;
		}

		if ( !$rss->get_item_quantity() ) :
		     echo '<p>' . __( 'Nenhuma notícia para exibir.', 'cf' ) . '</p>';
		     $rss->__destruct();
		     unset($rss);
		     return;
		endif;

		echo "<ul>\n";

		if ( !isset($items) )
		     $items = 5;

		     foreach ( $rss->get_items( 0, $items ) as $item ) :

		          $publisher = '';
		          $site_link = '';
		          $link = '';
		          $content = '';
		          $date = '';
		          $link = esc_url( strip_tags( $item->get_link() ) );
		          $title = esc_html( $item->get_title() );
		          $content = $item->get_content();
		          $content = wp_html_excerpt( $content, 250 ) . ' ...';

		         echo "<li><a class='rsswidget' href='$link'>$title</a>\n<div class='rssSummary'>$content</div>\n";
			endforeach;

		echo "</ul>\n";
		$rss->__destruct();
		unset( $rss );
		}

		// Reordena os widgets nas colunas
		// Força e sobrepõe as opções do usuário
		add_action( 'admin_init', 'cf_set_dashboard_meta_order' );

		function cf_set_dashboard_meta_order() {
		  $id = get_current_user_id(); //we need to know who we're updating
		  $meta_value = array(
		    'normal'  => '', //first key/value pair from the above serialized array
		    'side'    => 'cf_feed_widget', //second key/value pair from the above serialized array
		    'column3' => 'woocommerce_dashboard_status', //last key/value pair from the above serialized array
		    'column4' => 'gadwp-widget', //third key/value pair from the above serialized array
		  );
		  update_user_meta( $id, 'meta-box-order_dashboard', $meta_value ); //update the user meta with the user's ID, the meta_key meta-box-order_dashboard, and the new meta_value
		}

	endif; // is_super_admin
}