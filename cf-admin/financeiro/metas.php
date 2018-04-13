<?php
global $cf_calculadora;
$cf_calculadora->set_tela( 'metas' );
$cf_calculadora->set_titulo_banner( __( 'Financeiro | Metas', 'cf' ) );
$cf_calculadora->set_class_wrapper( 'cf-col-4' );
$cf_calculadora->render_metas();
