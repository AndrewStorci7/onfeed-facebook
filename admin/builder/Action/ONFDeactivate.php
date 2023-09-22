<?php
/**
 * OnFeedActivate class
 * Activation plugin class
 * 
 * @package onfeed-facebook
 * @author Andrea Storci
 * 
 * @since 2.2.7
 */

namespace Oppimittinetworking\OnfeedFacebook\Action;

class ONFDeactivate {

    /**
     * Activate:
     * It will create plugin's tables inside the database
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function deactivate() {

        // disable shortcut
    }

    public static function unregister_admin_scripts() {
        add_action( 'admin_dequeue_scripts', array( 'Oppimittinetworking\OnfeedFacebook\Action\ONFDeactivate', "dequeue_admin" ) );
    }

    public static function unregister_wp_scripts() {
        
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
    public static function dequeue_admin() {
        // Enqueue admin css files
        wp_dequeue_style( "onfeed_main_css" );
        wp_dequeue_style( "onfeed_shortcut_css" );
        wp_dequeue_style( "onfeed_feedspage_css" );

        // Enqueue admin js files
        wp_dequeue_script( "onfeed_main_js" );
        wp_dequeue_script( "onfeed_shortcut_js" );
        wp_dequeue_script( "onfeed_feedspage_js" );
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
    public static function dequeue_wp() {
        // TODO
    }


}