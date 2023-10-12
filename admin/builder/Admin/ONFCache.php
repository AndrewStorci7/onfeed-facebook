<?php
/**
 * Onfeed Cache Class
 * 
 * @package onfeed-facebook
 * @author  Andrea Storci
 * 
 * @since   2.2.7
 */

namespace Oppimittinetworking\OnfeedFacebook\Admin;

class ONFCache {

    private readonly string $feed;

    private readonly string $data;

    public function __construct( string $id_feed, string $data ) {

        $this->data = $data;
        $this->feed = $id_feed;

        if ( $this->data !== null && $this->data !== '' && $this->data !== 'undefined' &&
             $this->id_feed !== null && $this->id_feed !== '' && $this->id_feed !== 'undefined' ) {
            self::create_cache();
        }
    }

    public static function create_cache() {

        global $wpdb;

        $check = $wpdb->insert(
            $wpdb->prefix . "onfeedfb_cache",
            [
                "id_feed"   => $this->id_feed,
                "data_enc"  => $this->data_enc,
                "date_crt"  => date( 'Y-m-d h:i:sa' ),
                "date_exp"  => date( 'Y-m-d h:i:sa' ) + ( 60 * 20 ),
            ]
        );

        return $check;
    }
}