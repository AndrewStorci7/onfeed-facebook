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

if ( ! defined( 'ABSPATH' ) ) die; // Die if accessed directly

global $wpdb, $onfmain;

define( 'ONFEED_V', '2.2.7' ); // Version

if ( ! defined( 'ONFEED_DB_V' ) ) {
    define( 'ONFEED_DB_V', '2.2.7' );
}

if ( ! defined( 'ONFEED_PLUGIN_PATH' ) ) {
    define( 'ONFEED_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'ONFEED_PLUGIN_URL' ) ) {
    define( 'ONFEED_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'ONFEED_FILE' ) ) {
    define( 'ONFEED_FILE',  __FILE__ );
}

if ( ! defined( 'ONFEED_PLUGIN_BASENAME' ) ) {
    define( 'ONFEED_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'ONFEED_BUILDER_PATH' ) ) {
    define( 'ONFEED_BUILDER_PATH', ONFEED_PLUGIN_PATH . 'admin/builder/' );
}

if ( ! defined( 'ONFEED_SLUG' ) ) {
    define( 'ONFEED_SLUG', 'onfeed_plugin_menu' );
}

if ( ! defined( 'ONFEED_DB_TABLE' ) ) {
    define( 'ONFEED_DB_TABLE', $wpdb->prefix . 'onfeedfb_' );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
    require_once ONFEED_PLUGIN_PATH . '/vendor/autoload.php';
}

/**
 * Register activation hook
 */
register_activation_hook( "Oppimittinetworking\\OnfeedFacebook\\Admin\\ONFActivate", 'register_service' );

/**
 * Register deactivation hook
 */
register_deactivation_hook( "Oppimittinetworking\\OnfeedFacebook\\Admin\\ONFDeactivate", 'unregister_service' );

// if ( class_exists( 'Oppimittinetworking\\OnfeedFacebook\\OnFeedMain' ) )
//     $onfmain = new OnFeedMain();

if ( class_exists( 'Oppimittinetworking\\OnfeedInit' ) ) {
    Oppimittinetworking\OnFeedInit::register_services();
}
