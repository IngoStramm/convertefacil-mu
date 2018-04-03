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

		// Reordena os widgets nas colunas
		// Força e sobrepõe as opções do usuário
		add_action( 'admin_init', 'cf_set_dashboard_meta_order' );

		function cf_set_dashboard_meta_order() {
		  $id = get_current_user_id(); //we need to know who we're updating
		  $meta_value = array(
		    'normal'  => '', //first key/value pair from the above serialized array
		    'side'    => 'gadwp-widget', //second key/value pair from the above serialized array
		    'column3' => 'woocommerce_dashboard_status', //third key/value pair from the above serialized array
		    'column4' => '', //last key/value pair from the above serialized array
		  );
		  update_user_meta( $id, 'meta-box-order_dashboard', $meta_value ); //update the user meta with the user's ID, the meta_key meta-box-order_dashboard, and the new meta_value
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

		function cf_status_widget() {
			$plugins_url = plugins_url();
			$path = 'D:\Trabalho\projetos_php\prosites\wp-content\plugins\woocommerce\includes\admin\reports';
			cf_debug( $path );
			include_once( $path . '\class-wc-admin-report.php' );

			$reports = new WC_Admin_Report();

			echo '<ul class="wc_status_list">';

			if ( current_user_can( 'view_woocommerce_reports' ) && ( $report_data = cf_get_sales_report_data() ) ) {
				?>
				<li class="sales-this-month">
					<a href="<?php echo admin_url( 'admin.php?page=wc-reports&tab=orders&range=month' ); ?>">
						<?php echo $reports->sales_sparkline( '', max( 7, date( 'd', current_time( 'timestamp' ) ) ) ); ?>
						<?php
							/* translators: %s: net sales */
							printf(
								__( '%s net sales this month', 'woocommerce' ),
								'<strong>' . wc_price( $report_data->net_sales ) . '</strong>'
								);
						?>
					</a>
				</li>
				<?php
			}

			if ( current_user_can( 'view_woocommerce_reports' ) && ( $top_seller = cf_get_top_seller() ) && $top_seller->qty ) {
				?>
				<li class="best-seller-this-month">
					<a href="<?php echo admin_url( 'admin.php?page=wc-reports&tab=orders&report=sales_by_product&range=month&product_ids=' . $top_seller->product_id ); ?>">
						<?php echo $reports->sales_sparkline( $top_seller->product_id, max( 7, date( 'd', current_time( 'timestamp' ) ) ), 'count' ); ?>
						<?php
							/* translators: 1: top seller product title 2: top seller quantity */
							printf(
								__( '%1$s top seller this month (sold %2$d)', 'woocommerce' ),
								'<strong>' . get_the_title( $top_seller->product_id ) . '</strong>',
								$top_seller->qty
							);
						?>
					</a>
				</li>
				<?php
			}

			cf_status_widget_order_rows();
			cf_status_widget_stock_rows();

			do_action( 'woocommerce_after_dashboard_status_widget', $reports );
			echo '</ul>';
		}	

		function cf_get_sales_report_data() {
			include_once( dirname( __FILE__ ) . '/reports/class-wc-report-sales-by-date.php' );

			$sales_by_date                 = new WC_Report_Sales_By_Date();
			$sales_by_date->start_date     = strtotime( date( 'Y-m-01', current_time( 'timestamp' ) ) );
			$sales_by_date->end_date       = current_time( 'timestamp' );
			$sales_by_date->chart_groupby  = 'day';
			$sales_by_date->group_by_query = 'YEAR(posts.post_date), MONTH(posts.post_date), DAY(posts.post_date)';

			return $sales_by_date->get_report_data();
		}

		function cf_get_top_seller() {
			global $wpdb;

			$query            = array();
			$query['fields']  = "SELECT SUM( order_item_meta.meta_value ) as qty, order_item_meta_2.meta_value as product_id
				FROM {$wpdb->posts} as posts";
			$query['join']    = "INNER JOIN {$wpdb->prefix}woocommerce_order_items AS order_items ON posts.ID = order_id ";
			$query['join']   .= "INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_item_meta ON order_items.order_item_id = order_item_meta.order_item_id ";
			$query['join']   .= "INNER JOIN {$wpdb->prefix}woocommerce_order_itemmeta AS order_item_meta_2 ON order_items.order_item_id = order_item_meta_2.order_item_id ";
			$query['where']   = "WHERE posts.post_type IN ( '" . implode( "','", wc_get_order_types( 'order-count' ) ) . "' ) ";
			$query['where']  .= "AND posts.post_status IN ( 'wc-" . implode( "','wc-", apply_filters( 'woocommerce_reports_order_statuses', array( 'completed', 'processing', 'on-hold' ) ) ) . "' ) ";
			$query['where']  .= "AND order_item_meta.meta_key = '_qty' ";
			$query['where']  .= "AND order_item_meta_2.meta_key = '_product_id' ";
			$query['where']  .= "AND posts.post_date >= '" . date( 'Y-m-01', current_time( 'timestamp' ) ) . "' ";
			$query['where']  .= "AND posts.post_date <= '" . date( 'Y-m-d H:i:s', current_time( 'timestamp' ) ) . "' ";
			$query['groupby'] = "GROUP BY product_id";
			$query['orderby'] = "ORDER BY qty DESC";
			$query['limits']  = "LIMIT 1";

			return $wpdb->get_row( implode( ' ', apply_filters( 'woocommerce_dashboard_status_widget_top_seller_query', $query ) ) );
		}

		function cf_status_widget_order_rows() {
			if ( ! current_user_can( 'edit_shop_orders' ) ) {
				return;
			}
			$on_hold_count    = 0;
			$processing_count = 0;

			foreach ( wc_get_order_types( 'order-count' ) as $type ) {
				$counts           = (array) wp_count_posts( $type );
				$on_hold_count    += isset( $counts['wc-on-hold'] ) ? $counts['wc-on-hold'] : 0;
				$processing_count += isset( $counts['wc-processing'] ) ? $counts['wc-processing'] : 0;
			}
			?>
			<li class="processing-orders">
				<a href="<?php echo admin_url( 'edit.php?post_status=wc-processing&post_type=shop_order' ); ?>">
					<?php
						/* translators: %s: order count */
						printf(
							_n( '<strong>%s order</strong> awaiting processing', '<strong>%s orders</strong> awaiting processing', $processing_count, 'woocommerce' ),
							$processing_count
						);
					?>
				</a>
			</li>
			<li class="on-hold-orders">
				<a href="<?php echo admin_url( 'edit.php?post_status=wc-on-hold&post_type=shop_order' ); ?>">
					<?php
						/* translators: %s: order count */
						printf(
							_n( '<strong>%s order</strong> on-hold', '<strong>%s orders</strong> on-hold', $on_hold_count, 'woocommerce' ),
							$on_hold_count
						);
					?>
				</a>
			</li>
			<?php
		}

		function cf_status_widget_stock_rows() {
			global $wpdb;

			// Get products using a query - this is too advanced for get_posts :(
			$stock          = absint( max( get_option( 'woocommerce_notify_low_stock_amount' ), 1 ) );
			$nostock        = absint( max( get_option( 'woocommerce_notify_no_stock_amount' ), 0 ) );
			$transient_name = 'wc_low_stock_count';

			if ( false === ( $lowinstock_count = get_transient( $transient_name ) ) ) {
				$query_from = apply_filters( 'woocommerce_report_low_in_stock_query_from', "FROM {$wpdb->posts} as posts
					INNER JOIN {$wpdb->postmeta} AS postmeta ON posts.ID = postmeta.post_id
					INNER JOIN {$wpdb->postmeta} AS postmeta2 ON posts.ID = postmeta2.post_id
					WHERE 1=1
					AND posts.post_type IN ( 'product', 'product_variation' )
					AND posts.post_status = 'publish'
					AND postmeta2.meta_key = '_manage_stock' AND postmeta2.meta_value = 'yes'
					AND postmeta.meta_key = '_stock' AND CAST(postmeta.meta_value AS SIGNED) <= '{$stock}'
					AND postmeta.meta_key = '_stock' AND CAST(postmeta.meta_value AS SIGNED) > '{$nostock}'
				" );
				$lowinstock_count = absint( $wpdb->get_var( "SELECT COUNT( DISTINCT posts.ID ) {$query_from};" ) );
				set_transient( $transient_name, $lowinstock_count, DAY_IN_SECONDS * 30 );
			}

			$transient_name = 'wc_outofstock_count';

			if ( false === ( $outofstock_count = get_transient( $transient_name ) ) ) {
				$query_from = apply_filters( 'woocommerce_report_out_of_stock_query_from', "FROM {$wpdb->posts} as posts
					INNER JOIN {$wpdb->postmeta} AS postmeta ON posts.ID = postmeta.post_id
					INNER JOIN {$wpdb->postmeta} AS postmeta2 ON posts.ID = postmeta2.post_id
					WHERE 1=1
					AND posts.post_type IN ( 'product', 'product_variation' )
					AND posts.post_status = 'publish'
					AND postmeta2.meta_key = '_manage_stock' AND postmeta2.meta_value = 'yes'
					AND postmeta.meta_key = '_stock' AND CAST(postmeta.meta_value AS SIGNED) <= '{$nostock}'
				" );
				$outofstock_count = absint( $wpdb->get_var( "SELECT COUNT( DISTINCT posts.ID ) {$query_from};" ) );
				set_transient( $transient_name, $outofstock_count, DAY_IN_SECONDS * 30 );
			}
			?>
			<li class="low-in-stock">
				<a href="<?php echo admin_url( 'admin.php?page=wc-reports&tab=stock&report=low_in_stock' ); ?>">
					<?php
						/* translators: %s: order count */
						printf(
							_n( '<strong>%s product</strong> low in stock', '<strong>%s products</strong> low in stock', $lowinstock_count, 'woocommerce' ),
							$lowinstock_count
						);
					?>
				</a>
			</li>
			<li class="out-of-stock">
				<a href="<?php echo admin_url( 'admin.php?page=wc-reports&tab=stock&report=out_of_stock' ); ?>">
					<?php
						/* translators: %s: order count */
						printf(
							_n( '<strong>%s product</strong> out of stock', '<strong>%s products</strong> out of stock', $outofstock_count, 'woocommerce' ),
							$outofstock_count
						);
					?>
				</a>
			</li>
			<?php
		}

	endif; // is_super_admin
}