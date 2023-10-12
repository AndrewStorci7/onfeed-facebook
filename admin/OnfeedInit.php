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

use Oppimittinetworking\OnfeedFacebook\Exceptions\IdFeedNotFound;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFDeactivate;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFActivate;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFAdmin;
use Oppimittinetworking\OnfeedFacebook\OnFeedMain;

final class OnFeedInit {

    /**
     * OnFeedMain
     * 
     * @var OnFeedMain
     */
    public OnFeedMain $onfMain;

    public ONFHttpRequest $onfHttpRequest;

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

    /**
     * 
     */
    public function __construct( string $db_v = null, string $plugin_path = null, string $plugin_url = null, string $main_file = null, string $basename = null, string $builder_path = null, string $slug = null, string $db_name = null ) {

        $this->onfMain          = new OnFeedMain( $db_v, $plugin_path, $plugin_url, $main_file, $basename, $builder_path, $slug, $db_name );
        // $this->onfHttpRequest   = new ONFHttpRequest();
    }

    /**
     * 
     */
    public static function createRequest( string $name_feed, string $id_domain ) {
        $this->onfHttpRequest = new ONFHttpRequest( $name_feed, $id_domain, $this->onfMain );
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