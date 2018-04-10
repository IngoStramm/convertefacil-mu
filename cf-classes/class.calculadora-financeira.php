<?php
/**
* 
*/
class Calculadora_Financeira
{
	private $tela;
	private $class_wrapper = false;
	function __construct( $tela )
	{
		$this->tela = $tela;
	}

	public function set_class_wrapper( $class_wrapper )
	{
		$this->class_wrapper = $class_wrapper;
	}

	public function render_view()
	{
		?>

		<?php
			global $blog_id;

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

			    			// cf_debug( $metas );
			    		?>

			    		<?php if( $this->class_wrapper ) : ?>
			    			<div class="<?php echo $this->class_wrapper; ?>">
			    		<?php endif; ?>

						<div class="cf-box">

							<div class="cf-header-box" style="background-color: <?php echo $color; ?>;">
								<h3 class="cf-header-box-title"><?php the_title(); ?></h3>
								<img src="<?php echo $icon; ?>" alt="<?php the_title(); ?>" class="cf-header-box-icon">
							</div>
							<!-- /.cf-header-box -->

							<div class="cf-box-content">
								
								<div class="cf-box-content-main">

									<ul class="cf-radio-list">

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input">
												<span class="cf-radio-image"></span>
												<span class="cf-radio-title"><?php echo $text_option_1; ?></span>
											</label>
										</li>

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input">
												<span class="cf-radio-image"></span>
												<span class="cf-radio-title"><?php echo $text_option_2; ?></span>
											</label>
										</li>

										<li class="cf-radio-list-item">
											<label class="cf-radio-label">
												<input type="radio" name="radio-item-<?php echo $item_count; ?>" class="cf-radio-input">
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

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-1" value="<?php echo $value_option_1; ?>" <?php echo ( $edit_option_1 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input">
										</li>
										
										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-2" value="<?php echo $value_option_2; ?>" <?php echo ( $edit_option_2 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input">
										</li>

										<li class="cf-radio-list-item">

											<input type="text" name="value-item-<?php echo $item_count; ?>-option-3" value="<?php echo $value_option_3; ?>" <?php echo ( $edit_option_3 != 'on' ) ? 'readonly="readonly"' : ''; ?> class="cf-radio-list-item-input">
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
}
