<?php
/*
Plugin Name: Store Connect
Plugin URL: 
Text Domain: store-connect
Domain Path: /languages/
Description: A simple connect two store
Version: 1.0
Author: Rafik Malek
Author URI: 
Contributors: Rafik Malek
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if( ! defined( 'SC_VERSION' ) ) {
	define( 'SC_VERSION', '4.2.2' ); // Version of plugin
}
if( ! defined( 'SC_DIR' ) ) {
	define( 'SC_DIR', dirname( __FILE__ ) ); // Plugin dir
}

if( !defined( 'SC_META_PREFIX' ) ) {
    define( 'SC_META_PREFIX', '_sc_' ); // Metabox Prefix
}


require_once( SC_DIR . '/includes/sc-functions.php' );
require_once( SC_DIR . '/includes/admin/sc-setting.php' );
require_once( SC_DIR . '/includes/sc-api-call.php' );


