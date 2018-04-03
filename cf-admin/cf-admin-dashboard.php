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

			// cf_debug( $wp_meta_boxes );
			
			// Remove os Widgets
			// Agora
			unset( $wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now'] );
			// Postagem rápida
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press'] );
			// Novidades WP
			unset( $wp_meta_boxes['dashboard']['side']['core']['dashboard_primary'] );
			// Woocommerce Avaliações Recentes
			remove_meta_box( 'woocommerce_dashboard_recent_reviews', 'dashboard', 'normal' );
			remove_meta_box( 'woocommerce_dashboard_status', 'dashboard', 'normal' );

			// Yoast SEO
			remove_meta_box( 'wpseo-dashboard-overview', 'dashboard', 'normal' );
			// Google Analytics
			remove_meta_box( 'gadwp-widget', 'dashboard', 'normal' );

			// Atividades
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
			// add_meta_box( 'gadwp-widget', 'dashboard', 'normal' );
			// add_meta_box( 'cf_dashboard_recent_reviews', __( 'WooCommerce recent reviews', 'woocommerce' ), 'cf_recent_reviews' ,'dashboard','side','core');
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

		// Função copiada do Woocommerce
		// @link: woocommerce/includes/admin/class-wc-admin-dasboard.php
		// linha 247
		// Não usado, mantido como referência
		function cf_recent_reviews() {
			global $wpdb;
			$comments = $wpdb->get_results( "
				SELECT posts.ID, posts.post_title, comments.comment_author, comments.comment_ID, SUBSTRING(comments.comment_content,1,100) AS comment_excerpt
				FROM $wpdb->comments comments
				LEFT JOIN $wpdb->posts posts ON (comments.comment_post_ID = posts.ID)
				WHERE comments.comment_approved = '1'
				AND comments.comment_type = ''
				AND posts.post_password = ''
				AND posts.post_type = 'product'
				ORDER BY comments.comment_date_gmt DESC
				LIMIT 5
			" );

			if ( $comments ) {
				echo '<ul>';
				foreach ( $comments as $comment ) {

					echo '<li>';

					echo get_avatar( $comment->comment_author, '32' );

					$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );

					/* translators: %s: rating */
					echo '<div class="star-rating"><span style="width:' . ( $rating * 20 ) . '%">' . sprintf( __( '%s out of 5', 'woocommerce' ), $rating ) . '</span></div>';

					/* translators: %s: review author */
					echo '<h4 class="meta"><a href="' . get_permalink( $comment->ID ) . '#comment-' . absint( $comment->comment_ID ) . '">' . esc_html( apply_filters( 'woocommerce_admin_dashboard_recent_reviews', $comment->post_title, $comment ) ) . '</a> ' . sprintf( __( 'reviewed by %s', 'woocommerce' ), esc_html( $comment->comment_author ) ) . '</h4>';
					echo '<blockquote>' . wp_kses_data( $comment->comment_excerpt ) . ' [...]</blockquote></li>';

				}
				echo '</ul>';
			} else {
				echo '<p>' . __( 'There are no product reviews yet.', 'woocommerce' ) . '</p>';
			}
		}


	endif; // is_super_admin
}