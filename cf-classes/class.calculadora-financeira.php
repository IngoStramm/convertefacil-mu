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
		add_action( 'wp_ajax_save_itens_metas', array( $this, 'save_itens_metas') );
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
			    	'posts_per_page' => -1,
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

									<ul class="cf-radio-list normalize-ul" data-mirror="radio-list-<?php echo $item_count; ?>">

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

									<ul class="cf-radio-list radio-list-<?php echo $item_count; ?>">

										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-1" value="<?php echo ( 1 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_1; ?>" data-index="1" <?php echo ( $edit_option_1 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input number" data-default-value="<?php echo $value_option_1; ?>">
										</li>
										
										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-2" value="<?php echo ( 2 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_2; ?>" data-index="2" <?php echo ( $edit_option_2 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input number" data-default-value="<?php echo $value_option_2; ?>">
										</li>

										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-3" value="<?php echo ( 3 == $saved_option[ 'data_index' ] ) ? $saved_option[ 'val' ] : $value_option_3; ?>" data-index="3" <?php echo ( $edit_option_3 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input number" data-default-value="<?php echo $value_option_3; ?>">
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

	public function get_itens_total( $tela = false )
	{
		global $blog_id;
		$curr_blog_id = $blog_id;
		$options = [];
		$total = 0;

		if( $blog_id != 1 ) :

			$tela = $tela ? $tela : $this->tela;


		    switch_to_blog(1);
			$total = 0;
		    $args = array(
		    	'post_type' 	=> 'item-calculadora',
		    	'order'			=> 'ASC',
		    	'orderby'		=> 'menu_order',
		    	'meta_key'   => 'position_item_calc_tela',
	    		'meta_value' => $tela
		    );
		    $the_query = new WP_Query( $args );

		    if ( $the_query->have_posts() ) :

		    	$item_count = 1;

		    	while ( $the_query->have_posts() ) : $the_query->the_post();

		    		$slug = get_post_field( 'post_name', $item_id );
		    		$option = $tela . '_' . $slug;
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

	public function itens_metas()
	{
		global $blog_id;
		$itens_metas = array(
			'custos-variaveis'		=> __( 'Custos Variáveis', 'cf' ),
			'meta-desejada'			=> __( 'Meta de vendas DESEJADA', 'cf' ),
			'meta-minima'			=> __( 'Meta de vendas MÍNIMA', 'cf' )
		);
		?>

		<?php
			$total_custo_inicial = $this->get_itens_total( 'custo_inicial' );
			$total_custo_fixo_mensal = $this->get_itens_total( 'custo_fixo_mensal' );
		?>

		<input type="hidden" class="total-custo-inicial" name="total_custo_inicial" value="<?php echo $total_custo_inicial; ?>" />
		<input type="hidden" class="total-custo-fixo-mensal" name="total_custo_fixo_mensal" value="<?php echo $total_custo_fixo_mensal; ?>" />

		<?php foreach ($itens_metas as $slug => $title) : ?>

			<?php if( $this->class_wrapper ) : ?>
				<div class="<?php echo $this->class_wrapper; ?>">
			<?php endif; ?>

				<div class="cf-box cf-box-<?php echo $slug; ?> cf-header-box-metas">

					<div class="cf-header-box">
						<h3 class="cf-header-box-title"><?php echo $title ?></h3>
						<img src="<?php echo CF_URL ; ?>assets/images/icon-quest-circle.png" alt="<?php echo $title ?>" class="cf-header-box-icon cf-header-box-icon-bottom">
						<?php //cf_debug( $saved_option ); ?>
					</div>
					<!-- /.cf-header-box -->


					<div class="cf-box-content">

						<?php if( $slug == 'custos-variaveis' ) : ?>

							<div class="cf-box-content-main cf-meta-box-content-main">

								<ul class="cf-meta-list normalize-ul" data-mirror="normalize-ul-1">

									<li class="cf-meta-list-item">
										<span class="cf-meta-number"><?php _e( '1.', 'cf' ); ?></span>
										<span class="cf-meta-text">
											<?php _e( 'Qual seu custo médio de embalagem por venda?', 'cf' ); ?>
										</span>
									</li>

									<li class="cf-meta-list-item">
										<span class="cf-meta-number"><?php _e( '2.', 'cf' ); ?></span>
										<span class="cf-meta-text">
											<?php _e( 'Qual valor médio por venda?', 'cf' ); ?>
										</span>
									</li>

									<li class="cf-meta-list-item">
										<span class="cf-meta-number"><?php _e( '3.', 'cf' ); ?></span>
										<span class="cf-meta-text">
											<?php _e( 'Qual seu custo médio de embalagem por venda?', 'cf' ); ?>
										</span>
									</li>

									<li class="cf-meta-list-item">
										<span class="cf-meta-number"><?php _e( '4.', 'cf' ); ?></span>
										<span class="cf-meta-text">
											<?php _e( 'Qual a porcentagem dos intermediadores de vendas?', 'cf' ); ?>
											<span class="cf-meta-text-small"><?php _e( 'Market places, Empresas de pagamentos, etc.', 'cf' ); ?></span>
										</span>
									</li>

								</ul>
								<!-- /.cf-meta-list -->
								
							</div>
							<!-- /.cf-box-content-main -->


							<?php
								$valor_medio_por_venda = get_blog_option( $blog_id, 'valor_medio_por_venda' );
								$valor_medio_embalagem = get_blog_option( $blog_id, 'valor_medio_embalagem' );
								$pc_imposto_renda = get_blog_option( $blog_id, 'pc_imposto_renda' );
								$pc_intermediadores = get_blog_option( $blog_id, 'pc_intermediadores' );
								// cf_debug( $blog_id );
								// cf_debug( $valor_medio_por_venda );
							?>
						
							<div class="cf-box-content-sidebar cf-meta-box-content-sidebar">

								<ul class="cf-meta-list normalize-ul-1">

									<li class="cf-meta-list-item">

										<input type="text" name="valor-medio-por-venda" value="<?php echo $valor_medio_por_venda ? $valor_medio_por_venda : '0'; ?>" class="cf-meta-list-item-input cf-valor-medio-por-venda number" data-default-value="0">

									</li>
									
									<li class="cf-meta-list-item">

										<input type="text" name="valor-medio-embalagem" value="<?php echo $valor_medio_embalagem ? $valor_medio_embalagem : '0'; ?>" class="cf-meta-list-item-input cf-valor-medio-embalagem number" data-default-value="0">

									</li>

									<li class="cf-meta-list-item">

										<input type="text" name="porcentagem-imposto-renda" value="<?php echo $pc_imposto_renda ? $pc_imposto_renda : '0'; ?>" class="cf-meta-list-item-input cf-porcentagem-imposto-renda number" data-default-value="0">
										
									</li>

									<li class="cf-meta-list-item">

										<input type="text" name="porcentagem-intermediadores" value="<?php echo $pc_intermediadores ? $pc_intermediadores : '0'; ?>" class="cf-meta-list-item-input cf-porcentagem-intermediadores number" data-default-value="0">

									</li>

								</ul>
								<!-- /.cf-radio-list -->

							</div>
							<!-- /.cf-box-content-sidebar -->

						<?php elseif( $slug == 'meta-desejada') : ?>

							<div class="cf-box-content-main">

								<img src="<?php echo CF_URL; ?>assets/images/icon-graph-metas.png" alt="" class="cf-img-responsive cf-center-block m-t-20 m-b-40">

								<div class="cf-metas-p cf-text-center"><?php _e( 'Com base nos custos fixo e variáveis de seu negócio, mais seu desejo de Lucro, você precisa vender o valor de:', 'cf' ); ?></div>

								<div class="clearfix m-t-40"></div>

								<div class="cf-footer-box">
									
									<input type="text" name="meta-venda" value="0" class="cf-total-value-input cf-ipunt-full-w-i cf-input-no-bd-i cf-text-center-i cf-meta-venda" readonly="readonly">

								</div>
								<!-- /.cf-header-box -->

								<div class="clearfix m-t-40"></div>

								<div class="cf-itens-wrapper"><div class="cf-col-6">
										<div class="cf-metas-small"><?php _e( 'Seu índice de lucratividade é de:', 'cf' ); ?></div>
									</div>
									<!-- /.cf-col-6 -->
									
									<div class="cf-col-6">
										<input type="text" name="indice-lucratividade" value="0" class="cf-total-value-input cf-text-center-i cf-indice-lucratividade" readonly="readonly">
									</div>
									<!-- /.cf-col-6 --></div>
								<!-- /.cf-itens-wrapper -->

								<div class="clearfix m-t-40"></div>

							</div>
							<!-- /.cf-box-content-main -->

						<?php else : ?>

							<div class="cf-box-content-main">

								<img src="<?php echo CF_URL; ?>assets/images/icon-money.png" alt="" class="cf-img-responsive cf-center-block m-t-20 m-b-40">

								<div class="cf-metas-p cf-text-center"><?php _e( 'A partir desse faturamento seu negócio começa a dar lucro.', 'cf' ); ?></div>

								<div class="clearfix m-t-40"></div>

								<div class="cf-footer-box">
									
									<input type="text" name="meta-minima" value="0" class="cf-total-value-input cf-ipunt-full-w-i cf-input-no-bd-i cf-text-center-i cf-meta-minima" readonly="readonly">

								</div>
								<!-- /.cf-header-box -->

								<div class="clearfix m-t-40"></div>

								<div class="cf-metas-small"><?php _e( 'Com base nos valores preenchidos se o seu faturamento for menor do que esse valor, seu negócio poderá ter prejuízo', 'cf' ); ?></div>

								<div class="clearfix m-t-40"></div>

							</div>
							<!-- /.cf-box-content-main -->

						<?php endif; ?>

					</div>
					<!-- /.cf-box-content -->

					<?php if( $slug == 'custos-variaveis' ) : ?>

						<?php
							$lucro_desejado_mes = get_blog_option( $blog_id, 'lucro_desejado_mes' );
						?>

						<div class="cf-footer-box">
							
							<h4 class="cf-footer-box-title">
								<?php _e( 'Quanto deseja de lucro por mês em Reais', 'cf' ); ?>
							</h4>
							<div class="cf-footer-box-total">
								<input type="text" name="lucro-desejado-mes" value="<?php echo $lucro_desejado_mes ? $lucro_desejado_mes : '0'; ?>" class="cf-total-value-input cf-lucro-desejado-mes number">
							</div>

						</div>
						<!-- /.cf-header-box -->

						<a href="#" class="button button-primary button-large cf-save-metas cf-text-center"><strong><?php _e( 'CALCULAR', 'cf' ); ?></strong></a>
						<div class="cf-save-return-message"></div>

					<?php endif; ?>

				</div>
				<!-- /.cf-box -->

			<?php if( $this->class_wrapper ) : ?>
				</div>
			<?php endif; ?>

		<?php endforeach;
	}

	public function render_metas()
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
						<img src="<?php echo CF_URL . 'assets/images/icon-prancheta.png' ?>" alt="<?php echo $this->titulo_banner; ?>" class="cf-img-responsive cf-center-block">
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
					<?php $this->itens_metas(); ?>
				</div>
				<!-- /.cf-itens-wrapper -->

			</div>
			<!-- /.cf-main -->

		</div>
		<!-- /.cf-container -->
		<?php
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

	public function save_itens_metas()
	{
		global $blog_id;
		$options = $_POST[ 'options' ];
		$response = [];
		$response['blog_id'] = $blog_id;
		$saved_options = [];
		foreach ( $options as $option ) :
			$update = update_blog_option( $blog_id, $option['option'], ( string )$option['val'] );
			$obj = [];
			$obj['update'] = $update;
			$obj['option'] = $option['option'];
			$obj['value'] = $option['val'];
			$saved_options[] = $obj;
		endforeach;
		$message = __( 'As informações foram salvas com sucesso.', 'cf' );
		$response['message'] = $message; // debug
		// $response['options'] = $saved_options; // debug
		wp_send_json_success( $response );
		wp_die();
	}

}

$cf_calculadora = new Calculadora_Financeira();