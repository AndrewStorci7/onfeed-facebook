<?php
/**
 * 
 * 
*/

namespace Oppimittinetworking;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFAdmin;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFActivate;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFDeactivate;

final class OnFeedInit {

    /**
     * Store all the classe services
     * @var array|class
     */
    private $services = array(
        \OnfeedFacebook\Admin\ONFAdmin::class
    );

    /**
     * Store all the classes inside an array
     * @return  array   Full list of classes 
     */
    public static function get_services() {
        return array(
            ONFAdmin::class,
            ONFActivate::class
        );
    }

    /**
     * Loop through the classes, initialize them,
     * and call the register() method if i exist
     * @return
     */
    public static function register_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            if ( method_exists( $service, 'register_service' ) ) {
                $service::register_service();
                // $service->register_wp_scripts();
            }
        }
    }

    /**
     * Initialize the class
     * @param   class $class    Class from the services array 
     * @return  class instance  New instance of the class
     */
    private static function instantiate( $class ) {
        $service = new $class();
        return $service;
    }
}

// // activation hook
// register_activation_hook( __FILE__, array( $onfmain, '__construct' ) );

// // deactivation hook
// register_deactivation_hook( __FILE__, array( $onfmain, '__deactivate' ) );