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

    /**
     * 
     */
    private readonly string $feed;

    /**
     * 
     */
    private readonly string $data;

    /**
     * Constructor
     * 
     * @param   string  $id_feed    Id Feed
     * @param   string  $data       Data Encrypted
     */
    public function __construct( string $id_feed, string $data ) {

        $this->data = $data;
        $this->feed = $id_feed;
    }

    /**
     * Create Cache
     * 
     * @return  bool    if cache would be saved returns true, otherwise false
     */
    public function create_cache() {

        global $wpdb;

        if ( $this->data !== null && $this->data !== '' && $this->data !== 'undefined' &&
             $this->feed !== null && $this->feed !== '' && $this->feed !== 'undefined' ) {

            $check = $wpdb->insert(
                $wpdb->prefix . "onfeedfb_cache",
                [
                    "id_feed"   => self::$feed,
                    "data_enc"  => self::$data,
                    "date_crt"  => date( 'Y-m-d h:i:sa' ),
                    "date_exp"  => date( 'Y-m-d h:i:sa' ) + ( 60 * 20 ),
                ]
            );
    
            $id_cache = $wpdb->get_results(
                "SELECT {$wpdb->prefix}onfeedfb_cache.id_feed FROM {$wpdb->prefix}onfeedfb_cache ORDER BY {$wpdb->prefix}onfeedfb_cache.data_crt",
                ARRAY_A
            );
            
            return $id_cache;
        }
    }

    /**
     * Delet Cache
     * 
     * @return  bool    if cache would be eliminated returns true, otherwie false
     */
    public function delete_cache() {
        
    }

    /**
     * Get Cache
     * 
     * @return  string  Data Cache
     */
    public function get_cache( int $id_cache, string $id_feed ) {

    }
}