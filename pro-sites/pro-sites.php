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