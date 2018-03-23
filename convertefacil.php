<?php
/*
Plugin Name:  ConverteFácil
Plugin URI:   https://convertefacil.com.br
Description:  Plugin integrante da plataforma ConverteFácil. Não pode ser comercializado separadamente.
Version:      0.0.1
Author:       Ingo Stramm
Author URI:   https://convertefacil.com.br
Text Domain:  cf
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'CF_DIR', plugin_dir_path( __FILE__ ) );
define( 'CF_URL', plugin_dir_url( __FILE__ ) );

require_once 'required-plugins.php';
require_once 'core.php';
require_once 'registration.php';
require_once 'scripts.php';
require_once 'cf-admin/cf-admin.php';