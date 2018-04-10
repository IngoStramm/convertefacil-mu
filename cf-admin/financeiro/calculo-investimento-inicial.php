<?php
$calculadora = new Calculadora_Financeira( 'custo_inicial' );
$calculadora->set_class_wrapper( 'cf-col-6' );
?>

<div class="cf-container">

	<div class="cf-main">
		<div class="cf-col-12">
			<div class="cf-banner">
				<img src="<?php echo CF_URL . 'assets/images/icon-check-zoom.png' ?>" class="cf-img-responsive cf-center-block">
				<h2 class="cf-title"><?php _e( 'Investimento Inicial para começar um E-commerce', 'cf' ); ?></h2>
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
			<?php $calculadora->render_view(); ?>
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
				<div class="cf-total-value"><input type="text" value="22.500" class="cf-total-value-input" readonly="readonly"></div>
			</div>
			<!-- /.cf-mini-box-content -->
		</div>
		<!-- /.cf-mini-box -->
	</div>
	<!-- /.cf-sidebar -->

</div>
<!-- /.cf-container -->
