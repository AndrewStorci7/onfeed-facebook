<?php
/**
 * Main Class for OnFeedFacebook Plugin
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFAdmin;

class OnFeedMain {

    /**
     * ONFHttpRequest
     * 
     * @var ONFHttpRequest
     */
    public $onf_http_request;

    /**
     * ONFHttpRequest
     * 
     * @var ONFAdmin
     */
    public $onf_admin;

    /**
     * Constructor:
     * It will call the functions that register admin and gloabal's scripts, 
     * add ... , 
     * and create the tables plugin needs inside the database. 
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
    */
    public function __construct() {
        // $this->onf_http_request = new ONFHttpRequest();
        // $this->onf_admin        = new ONFAdmin();
    }

    public function connect( $type = 1, $name_feed = null ) {

        switch ( $type ) {
            case 1: {
                // New Connection
                $this->onf_http_request->new_feed_connection();
                break;
            }
            case 2: {
                // Fetch data
                $this->onf_http_request->make_post_request( $name_feed );
                break;
            }
        }
    }
}
