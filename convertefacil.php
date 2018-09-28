<?php
/*
Plugin Name:  ConverteFácil
Plugin URI:   https://convertefacil.com.br
Description:  Plugin integrante da plataforma ConverteFácil. Não pode ser comercializado separadamente.
Version:      1.0.4
Author:       Ingo Stramm
Author URI:   https://convertefacil.com.br
Text Domain:  cf
*/

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

define( 'CF_DIR', plugin_dir_path( __FILE__ ) );
define( 'CF_URL', plugin_dir_url( __FILE__ ) );

require_once 'required-plugins.php';
require_once 'core.php';
require_once 'cf-classes/cf-classes.php';
require_once 'cf-admin/cf-admin-post-type/cf-admin-post-type.php';
require_once 'registration.php';
require_once 'scripts.php';
require_once 'cf-admin/cf-admin.php';
require_once 'pro-sites/pro-sites.php';
require_once 'domain-mapping/domain-mapping.php';