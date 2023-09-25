<?php
/**
 * Main Class for OnFeedFacebook Plugin
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFActivate;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFDeactivate;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSAEncrypt;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;

class OnFeedMain {

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
        ONFActivate::activate();
        // ONFActivate::register_admin_scripts();
        // ONFActivate::register_wp_scripts();
    }

    public function __deactivate() {
        ONFDeactivate::deactivate();
        // ONFDeactivate::unregister_admin_scripts();
        // ONFDeactivate::unregister_wp_scripts();
    }

    public static function encrypt_conn() {
        return new ONFRSAEncrypt();
    }

    public function decrypt_data() {
        return new ONFRSADecrypt();
    }
}
