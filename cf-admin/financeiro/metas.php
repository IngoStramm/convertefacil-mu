<?php
global $cf_calculadora;
$cf_calculadora->set_tela( 'metas' );
$cf_calculadora->set_titulo_banner( __( 'Converte | Metas', 'cf' ) );
$cf_calculadora->set_subtitulo_banner( __( 'Preencha as 5 ultimas perguntas e descubra a estimativa de faturamento necessário para seu E-commerce.', 'cf' ) );
$cf_calculadora->set_class_wrapper( 'cf-col-4' );
$cf_calculadora->render_metas();
