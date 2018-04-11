<?php
global $cf_calculadora;
$cf_calculadora->set_tela( 'custo_fixo_mensal' );
$cf_calculadora->set_titulo_banner( __( 'Custos fixos mensais para manter um E-commerce', 'cf' ) );
$cf_calculadora->set_class_wrapper( 'cf-col-6' );
$cf_calculadora->render_calc();
