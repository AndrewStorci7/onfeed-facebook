<?php
/**
 * OnfeedAdmin class
 * Activation plugin class
 * 
 * @package onfeed-facebook
 * @author  Andrea Storci
 * 
 * @since   2.2.7
 */

namespace Oppimittinetworking\OnfeedFacebook\Admin;

class ONFAdmin {

    /**
     * Register Admin Scripts:
     * It call a delegated internal function: enqueue_admin()
     * and add it to the admin_enqueue_scripts()
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function register_admin_scripts() {
        add_action( 'admin_enqueue_scripts', array( 'Oppimittinetworking\OnfeedFacebook\Action\ONFActivate', "enqueue_admin" ) );

        add_action( 'admin_menu', array( "Oppimittinetworking\OnfeedFacebook\Action\ONFActivate", 'add_admin_pages' ) );
    }

    public static function add_admin_pages() {
        add_menu_page( 'OnFeed Facebook', 'OnFeed Facebook', 'manage_options', 'onfeed_admin_menu', array( 'Oppimittinetworking\OnfeedFacebook\Action\ONFActivate', 'admin_index' ), 'dashicons-facebook-alt', 110 );
    }

    public static function admin_index() {
        require_once plugin_dir_path( __FILE__ ) . '../../main-page.php';
    }

    /**
     * Register Wordpress Scripts:
     * It call a delegated internal function: enqueue_wp()
     * and add it to the wp_enqueue_scripts()
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function register_wp_scripts() {
        // TODO
    }

    /**
     * Enqueue Admin:
     * It will add all the admin's scripts plugin needs
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function enqueue_admin() {
        // Enqueue admin css files
        // Bootstrap@5.3.0
        wp_register_style( "bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" );
        wp_enqueue_style( "bootstrap" );

        // FontAwesome@6.4.0
        wp_register_style( "font_awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" );
        wp_enqueue_style( "font_awesome" );

        wp_enqueue_style( "onfeed_main_css", plugins_url( "../../../assets/css/main.css", __FILE__ ) );
        wp_enqueue_style( "onfeed_shortcut_css", plugins_url( "../../../assets/css/shortcut.css", __FILE__ ) );
        wp_enqueue_style( "onfeed_feedspage_css", plugins_url( "../../../assets/css/feedspage.css", __FILE__ ) );
        
        // Enqueue admin js files
        // jQuery@3.6.3
        wp_enqueue_script( "jquery_3_7_1-min", plugins_url( "../../../assets/js/jquery-3.7.1.min.js", __FILE__ ), null, '3.7.1', array( 'strategy' => 'async' ) );

        wp_enqueue_script( "onfeed_function_js", plugins_url( "../../../assets/js/function.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_handshake_js", plugins_url( "../../../assets/js/handshake.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_shortcut_js", plugins_url( "../../../assets/js/shortcut.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_feedspage_js", plugins_url( "../../../assets/js/feedspage.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
    }

    /**
     * Enqueue Wordpress:
     * It will add all the global's scripts plugin needs
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function enqueue_wp() {
        // TODO
    }
}