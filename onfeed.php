<?php
/*
 * Plugin Name: ONFeed - Facebook Feeds 
 * Plugin URI: https://oppimittinetworking.com
 * Description: Display everything you want from your Facebook account to your WebSite
 * Version: 2.2.7
 * Author: Oppimittinetworking, Andrea Storci
 * Author URI: https://oppimittinetworking.com
 * License: GPLv2 or later
 * Text Domain: on-onfeed
 */

if( ! defined( 'ABSPATH' ) ) die; // Die if accessed directly

global $wpdb;
global $onfmain;

define( 'ONFEED_V', '2.2.7' ); // Version

// Db version.
if ( ! defined( 'ONFEED_DB_V' ) ) {
    define( 'ONFEED_DB_V', '2.4' );
}

// Plugin Folder Path.
if ( ! defined( 'ONFEED_PLUGIN_PATH' ) ) {
    // ONLY FOR TEST
    // define( 'ONFEED_PLUGIN_PATH', $test_host . 'wp-content/plugins/onfeed-facebook/' );
    define( 'ONFEED_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

// Plugin File.
if ( ! defined( 'ONFEED_FILE' ) ) {
    define( 'ONFEED_FILE',  __FILE__ );
}

if ( ! defined( 'ONFEED_PLUGIN_BASENAME' ) ) {
    define( 'ONFEED_PLUGIN_BASENAME', plugin_basename( 'ONFeed' ) );
}

if ( ! defined( 'ONFEED_BUILDER_PATH' ) ) {
    // ONLY FOR TEST
    // define( 'ONFEED_BUILDER_PATH', $test_host . 'wp-content/plugins/onfeed-facebook/admin/builder/' );
    define( 'ONFEED_BUILDER_PATH', ONFEED_PLUGIN_PATH . 'admin/builder/' );
}

/*if ( ! defined( 'BTS_BUILDER_URL' ) ) {
    define( 'BTS_BUILDER_URL', BTS_PLUGIN_URL . 'admin/builder/' );
}*/

if ( ! defined( 'ONFEED_SLUG' ) ) {
    define( 'ONFEED_SLUG', 'onfeed-plugin-menu' );
}

if ( ! defined( 'ONFEED_DB_TABLE' ) ) {
    define( 'ONFEED_DB_TABLE', $wpdb->prefix . 'onfeedfb_' );
}

require_once ONFEED_PLUGIN_PATH . '/vendor/autoload.php';
use Oppimittinetworking\OnfeedFacebook\OnFeedMain;
use Oppimittinetworking\OnfeedFacebook\Action\ONFActivate;
use Oppimittinetworking\OnfeedFacebook\Action\ONFDeactivate;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSAEncrypt;

if ( class_exists( 'OnFeedMain' ) )
    $onfmain = new OnFeedMain();

// activaion hook
register_activation_hook( __FILE__, array( $onfmain, '__construct' ) );

// deactivation hook
register_deactivation_hook( __FILE__, array( $onfmain, '__deactivate' ) );

// function onfeed_plugin_top_menu() {
//     add_menu_page( ONFEED_PLUGIN_BASENAME, ONFEED_PLUGIN_BASENAME, 'manage_options',  ONFEED_SLUG, 'onfeed_main_page' );
//     add_submenu_page( ONFEED_SLUG, 'prova1', 'prova1', 'manage_options', 'prova1', 'see_prova1' );
//     add_submenu_page( ONFEED_SLUG, 'prova2', 'prova2', 'manage_options', 'prova2', 'see_prova2' );
// }
// add_action( 'admin_menu', 'onfeed_plugin_top_menu' );

function onfeed_main_page() {
    include_once ONFEED_BUILDER_PATH . 'main-page.php';
    // include_once ONFEED_BUILDER_PATH . 'class/onfeed-classes.php';
}

// function see_prova1() {
//     echo 'Prova1';
// }

// function see_prova2() {
//     echo 'Prova2';
// }
 ?>