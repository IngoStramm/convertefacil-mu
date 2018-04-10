<?php
add_action( 'cmb2_admin_init', 'cf_item_calculadora_cmb2' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function cf_item_calculadora_cmb2() {

	$prefix = 'position_item_calc_';

	$cmb_sidebar = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Exibição', 'cf' ),
		'object_types'  => array( 'item-calculadora' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		'context'    => 'side',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb_sidebar->add_field( array(
		'name'             => esc_html__( 'Em qual tela este item será exibido?', 'cf' ),
		'id'               => $prefix . 'tela',
		'type'             => 'radio_inline',
		'options'          => array(
			'custo_inicial' => esc_html__( 'Custo Inicial', 'cf' ),
			'custo_fixo_mensal'   => esc_html__( 'Custo Fixo Mensal', 'cf' ),
		),
		'attributes'  => array(
	 		'required'    => 'required',
	 	),		
	) );

	$prefix = 'option_item_calc_';

	$cmb = new_cmb2_box( array(
		'id'            => $prefix . 'metabox',
		'title'         => esc_html__( 'Configuração', 'cf' ),
		'object_types'  => array( 'item-calculadora' ), // Post type
		// 'show_on_cb' => 'yourprefix_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'yourprefix_add_some_classes', // Add classes through a callback.
	) );

	$cmb->add_field( array(
		'name'    => esc_html__( 'Cor', 'cmb2' ),
		'desc'    => esc_html__( 'Cor usada no título do item', 'cmb2' ),
		'id'      => $prefix . 'color',
		'type'    => 'colorpicker',
		'default' => '#97b556',
		// 'options' => array(
		// 	'alpha' => true, // Make this a rgba color picker.
		// ),
		'attributes' => array(
			'data-colorpicker' => json_encode( array(
				'palettes' => array( '#74afce', '#7b84c6', '#bae3c3', '#e8d762', '#8557b1', '#e89b62', '#e6537f', '#7bc0c6', '#a5d1d2', '#a9a9a9' ),
			) ),
		),
	) );

	$cmb->add_field( array(
		'name' => esc_html__( 'Ícone exibido ao lado do título', 'cf' ),
		'desc' => esc_html__( 'Faça o upload de uma imagem ou digite uma URL.', 'cf' ),
		'id'   => $prefix . 'icon',
		'type' => 'file',
		'attributes' => array(
			'placeholder' => 'http://',
			'required'    => 'required',
		)
	) );

	for( $i = 1; $i <= 3; $i++ ) :

		$cmb->add_field( array(
			'name' => esc_html__( $i . 'ª Opção', 'cf' ),
			'id'   => $prefix . 'title_option_' . $i,
			'type' => 'title',
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Título da Opção #', 'cf' ) . $i,
			'id'   => $prefix . 'text_option_' . $i,
			'type' => 'text',
			'attributes'  => array(
		 		'required'    => 'required',
		 	),		
		) );


		$cmb->add_field( array(
			'name' => esc_html__( 'Valor pré-definido', 'cmb2' ),
			'id'   => $prefix . 'value_option_' . $i,
			'type' => 'text',
			'before_field' => 'R$', // override '$' symbol if needed
			'attributes' => array(
				'type' => 'number',
				'pattern' => '\d*',
				'required'    => 'required',
			),
			'sanitization_cb' => 'absint',
	        'escape_cb'       => 'absint',
		) );

		$cmb->add_field( array(
			'name' => esc_html__( 'Permitir que o usuário altere o valor pré-definido', 'cmb2' ),
			'id'   => $prefix . 'edit_option_' . $i,
			'type' => 'checkbox',
		) );

	endfor;

}