<?php
/**
 * OnFeedInit Class
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
 */

namespace Oppimittinetworking;

if ( file_exists( dirname( __FILE__ ) . '/../vendor/autoload.php' ) ) {
    require_once __DIR__ . '/../vendor/autoload.php';
}

use Oppimittinetworking\OnfeedFacebook\OnFeedMain;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFAdmin;
use Oppimittinetworking\OnfeedFacebook\ONFActivate;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFDeactivate;

final class OnFeedInit {

    /**
     * OnFeedMain
     * 
     * @var OnFeedMain
     */
    public $onfmain;

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
            'ONFAdmin'      => ONFAdmin::class,
            'ONFActivate'   => ONFActivate::class
        );
    }

    public function __construct( string $db_v = null, string $plugin_path = null, string $plugin_url = null, string $main_file = null, string $basename = null, string $builder_path = null, string $slug = null, string $db_name = null ) {

        $this->onfmain = new OnFeedMain( $db_v, $plugin_path, $plugin_url, $main_file, $basename, $builder_path, $slug, $db_name );
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