<?php
/**
* 
*/
class Calculadora_Financeira
{
	private $tela;
	private $class_wrapper = false;
	private $titulo_banner;
	function __construct()
	{
		add_action( 'wp_ajax_save_itens_calc', array( $this, 'save_itens_calc') );
		add_action( 'wp_ajax_nopriv_save_itens_calc', array( $this, 'save_itens_calc') );

	}

	public function set_titulo_banner( $titulo_banner )
	{
		$this->titulo_banner = $titulo_banner;
	}

	public function set_tela( $tela )
	{
		$this->tela = $tela;
	}

	public function set_class_wrapper( $class_wrapper )
	{
		$this->class_wrapper = $class_wrapper;
	}

	public function itens_calc()
	{
		?>

		<?php
			global $blog_id;
			$curr_blog_id = $blog_id;

			if( $blog_id != 1 ) :

			    switch_to_blog(1);
			    $args = array(
			    	'post_type' 	=> 'item-calculadora',
			    	'order'			=> 'ASC',
			    	'orderby'		=> 'menu_order',
			    	'meta_key'   => 'position_item_calc_tela',
		    		'meta_value' => $this->tela
			    );
			    $the_query = new WP_Query( $args );

			    if ( $the_query->have_posts() ) : ?>

			    	<?php $item_count = 1; ?>

			    	<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

			    		<?php
			    			$item_id = get_the_id();
			    			$metas = get_post_meta( $item_id, '', true );
			    			$color = get_post_meta( $item_id, 'option_item_calc_color', true );
			    			$icon = get_post_meta( $item_id, 'option_item_calc_icon', true );

			    			$text_option_1 = get_post_meta( $item_id, 'option_item_calc_text_option_1', true );
			    			$value_option_1 = get_post_meta( $item_id, 'option_item_calc_value_option_1', true );
			    			$edit_option_1 = get_post_meta( $item_id, 'option_item_calc_edit_option_1', true );
			    			
			    			$text_option_2 = get_post_meta( $item_id, 'option_item_calc_text_option_2', true );
			    			$value_option_2 = get_post_meta( $item_id, 'option_item_calc_value_option_2', true );
			    			$edit_option_2 = get_post_meta( $item_id, 'option_item_calc_edit_option_2', true );
			    			
			    			$text_option_3 = get_post_meta( $item_id, 'option_item_calc_text_option_3', true );
			    			$value_option_3 = get_post_meta( $item_id, 'option_item_calc_value_option_3', true );
			    			$edit_option_3 = get_post_meta( $item_id, 'option_item_calc_edit_option_3', true );

			    			$slug = get_post_field( 'post_name', $item_id );
			    			$option = $this->tela . '_' . $slug;
			    			$option = str_replace( '-', '_', $option );
			    			$saved_option = get_blog_option( $curr_blog_id, $option );

			    			
			    		?>

			    		<?php if( $this->class_wrapper ) : ?>
			    			<div class="<?php echo $this->class_wrapper; ?>">
			    		<?php endif; ?>

						<div class="cf-box" data-option="<?php echo $option; ?>">

							<div class="cf-header-box" style="background-color: <?php echo $color; ?>;">
								<h3 class="cf-header-box-title"><?php the_title(); ?></h3>
								<img src="<?php echo $icon; ?>" alt="<?php the_title(); ?>" class="cf-header-box-icon">
								<?php //cf_debug( $saved_option ); ?>
							</div>
							<!-- /.cf-header-box -->

							<div class="cf-box-content">
								
								<div class="cf-box-content-main">

									<ul class="cf-radio-list">

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input" data-input="value-item-<?php echo $item_count; ?>-option-1" data-index="1" <?php echo ( 1 == $saved_option[ 'data_index' ] ) ? 'checked="checked"' : ''; ?>>
												<span class="cf-radio-image"></span>
												<span class="cf-radio-title"><?php echo $text_option_1; ?></span>
											</label>
										</li>

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input" data-input="value-item-<?php echo $item_count; ?>-option-2" data-index="2" <?php echo ( 2 == $saved_option[ 'data_index' ] ) ? 'checked="checked"' : ''; ?>>
												<span class="cf-radio-image"></span>
												<span class="cf-radio-title"><?php echo $text_option_2; ?></span>
											</label>
										</li>

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input" data-input="value-item-<?php echo $item_count; ?>-option-3" data-index="3" <?php echo ( 3 == $saved_option[ 'data_index' ] ) ? 'checked="checked"' : ''; ?>>
												<span class="cf-radio-image"></span>
												<span class="cf-radio-title"><?php echo $text_option_3; ?></span>
											</label>
										</li>

									</ul>
									<!-- /.cf-radio-list -->
									
								</div>
								<!-- /.cf-box-content-main -->

								<div class="cf-box-content-sidebar">

									<ul class="cf-radio-list">

										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-1" value="<?php echo ( 1 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_1; ?>" data-index="1" <?php echo ( $edit_option_1 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input" data-default-value="<?php echo $value_option_1; ?>">
										</li>
										
										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-2" value="<?php echo ( 2 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_2; ?>" data-index="2" <?php echo ( $edit_option_2 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input" data-default-value="<?php echo $value_option_2; ?>">
										</li>

										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-3" value="<?php echo ( 3 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_3; ?>" data-index="3" <?php echo ( $edit_option_3 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input" data-default-value="<?php echo $value_option_3; ?>">
										</li>

									</ul>
									<!-- /.cf-radio-list -->

								</div>
								<!-- /.cf-box-content-sidebar -->

							</div>
							<!-- /.cf-box-content -->

						</div>
						<!-- /.cf-box -->

			    		<?php if( $this->class_wrapper ) : ?>
			    			</div>
			    			<!-- /.<?php echo $this->class_wrapper; ?> -->
			    		<?php endif; ?>

						<?php $item_count++; ?>

			    	<?php endwhile; ?>
				
				<?php wp_reset_postdata();

				endif;

				restore_current_blog();

			endif; ?>
		<?php
	}

	public function save_itens_calc()
	{
		global $blog_id;
		$options = $_POST[ 'options' ];
		$response = [];
		$response['blog_id'] = $blog_id;
		$saved_options = [];
		foreach ( $options as $option ) :
			$new_value = array(
				'data_index'		=> $option['data_index'],
				'val'				=> ( string )$option['val']
			);
			$update = update_blog_option( $blog_id, $option['option'], $new_value );
			$obj = [];
			$obj['update'] = $update;
			$obj['option'] = $option['option'];
			$obj['data_index'] = $option['data_index'];
			$obj['value'] = $option['val'];
			$saved_options[] = $obj;
		endforeach;
		$message = __( 'As informações foram salvas com sucesso.', 'cf' );
		$response['message'] = $message; // debug
		// $response['options'] = $saved_options; // debug
		wp_send_json_success( $response );
		wp_die();
	}

	public function get_itens_total()
	{
		global $blog_id;
		$curr_blog_id = $blog_id;
		$options = [];
		$total = 0;

		if( $blog_id != 1 ) :

		    switch_to_blog(1);
			$total = 0;
		    $args = array(
		    	'post_type' 	=> 'item-calculadora',
		    	'order'			=> 'ASC',
		    	'orderby'		=> 'menu_order',
		    	'meta_key'   => 'position_item_calc_tela',
	    		'meta_value' => $this->tela
		    );
		    $the_query = new WP_Query( $args );

		    if ( $the_query->have_posts() ) :

		    	$item_count = 1;

		    	while ( $the_query->have_posts() ) : $the_query->the_post();

		    		$slug = get_post_field( 'post_name', $item_id );
		    		$option = $this->tela . '_' . $slug;
		    		$option = str_replace( '-', '_', $option );
		    		$options[] = $option;
					$item_count++;

		    	endwhile;
			
			wp_reset_postdata();

			endif;

			restore_current_blog();

		endif;

		foreach ( $options as $option ) :
			$saved_option = get_blog_option( $blog_id, $option );
			$total += $saved_option[ 'val' ];
		endforeach;

		return $total;

	}

	public function render_calc()
	{
		?>

		<div class="cf-container">

			<div class="cf-loading">
				<div class="cssload-container">
					<div class="cssload-loading"><i></i><i></i></div>
				</div>
			</div>
			<!-- /.cf-loading -->

			<div class="cf-main">
				<div class="cf-col-12">
					<div class="cf-banner">
						<img src="<?php echo CF_URL . 'assets/images/icon-check-zoom.png' ?>" class="cf-img-responsive cf-center-block">
						<h2 class="cf-title"><?php echo $this->titulo_banner; ?></h2>
						<div class="cf-banner-texto">
							<p><?php _e( 'Nas colunas abaixo escolha entre uma das 3 opções para montar o cálculo de seu investimento.', 'cf' ); ?></p>
						</div>
						<!-- /.cf-banner-texto -->
					</div>
					<!-- /.cf-banner -->
				</div>
				<!-- /.cf-col-12 -->

				<div class="clearfix"></div>

				<div class="cf-itens-wrapper">
					<?php $this->itens_calc(); ?>
				</div>
				<!-- /.cf-itens-wrapper -->

			</div>
			<!-- /.cf-main -->

			<div class="cf-sidebar">
				<div class="cf-mini-box">
					<div class="cf-mini-box-header">
						<h3 class="cf-mini-box-header-title"><?php _e( 'TOTAL do Investimento', 'cf' ) ?></h3>
						<img src="<?php echo CF_URL . 'assets/images/icon-graph.png' ?>" class="cf-mini-box-header-icon">
					</div>
					<!-- /.cf-mini-box-header -->
					<div class="cf-mini-box-content">
						<?php
							$total = $this->get_itens_total();
						?>
						<div class="cf-total-value"><input type="text" value="<?php echo $total; ?>" class="cf-total-value-input" readonly="readonly"></div>
						<a href="#" class="button button-primary button-large cf-save-itens-calc"><?php _e( 'Salvar', 'cf' ); ?></a>
						<div class="cf-save-return-message"></div>

					</div>
					<!-- /.cf-mini-box-content -->
				</div>
				<!-- /.cf-mini-box -->
			</div>
			<!-- /.cf-sidebar -->

		</div>
		<!-- /.cf-container -->
		<?php
	}
}

$cf_calculadora = new Calculadora_Financeira();