<?php
global $cf_calculadora;
$cf_calculadora->set_tela( 'custo_inicial' );
$cf_calculadora->set_titulo_banner( __( 'Investimento Inicial para começar um E-commerce', 'cf' ) );
$cf_calculadora->set_class_wrapper( 'cf-col-6' );
$cf_calculadora->render_calc();
