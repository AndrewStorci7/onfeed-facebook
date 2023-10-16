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

use DateTime;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;

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
     * 
     */
    private readonly string $type_data;

    /**
     * 
     */
    private readonly string $type_format;

    /**
     * Constructor
     * 
     * @param   string  $id_feed    Id Feed
     * @param   string  $data       Data Encrypted
     */
    public function __construct( string $id_feed, string $data = null, string $type_data = null, string $type_format = null ) {

        $this->data         = $data;
        $this->feed         = $id_feed;
        $this->type_data    = $type_data;
        $this->type_format  = $type_format;
    }

    /**
     * Create Cache
     * 
     * @return  bool    if cache would be saved returns true, otherwise false
     */
    public function create_cache() {

        if ( $this->data !== null && $this->data !== '' && $this->data !== 'undefined' &&
             $this->feed !== null && $this->feed !== '' && $this->feed !== 'undefined' ) {

            global $wpdb;

            $cdatetime          = new DateTime();
            $current_datetime   = $cdatetime->format( 'Y-m-d h:i:sa' ); 
            $edatetime          = new DateTime();
            $edatetime->modify( '+2 hours' );
            $expire_datetime    = $edatetime->format( 'Y-m-d h:i:sa' );

            try {
                
                $check = $wpdb->insert(
                    $wpdb->prefix . "onfeedfb_cache",
                    [
                        "id_feed"       => $this->feed,
                        "type_data"     => $this->type_data,
                        "type_format"   => $this->type_format,
                        "data_enc"      => $this->data,
                        "date_crt"      => $current_datetime,
                        "date_exp"      => $expire_datetime,
                    ]
                );

                return $check;
            } catch ( \Exception $e ) {
                return $e->getMessage();
            }
    
            // if ( $check ) {

            //     $id_cache = 0;
            //     $id_cache = $wpdb->get_results(
            //         "SELECT {$wpdb->prefix}onfeedfb_cache.id FROM {$wpdb->prefix}onfeedfb_cache ORDER BY {$wpdb->prefix}onfeedfb_cache.date_crt DESC LIMIT 1",
            //         ARRAY_A
            //     );
            //     // if ( ! isset( $_COOKIE["onfeed_cache_$id_cache"] ) ) {
            //     //     setcookie( "onfeed_cache_$id_cache", $id_cache, time() + 86400, '/', $_SERVER['SERVER_NAME'], true, true );
            //     // }
            //     if ( ! isset( $_COOKIE["onfeed_cache"] ) ) {
            //         setcookie( "onfeed_cache", $id_cache[0]['id'], time() + 86400, '/', $_SERVER['SERVER_NAME'], true, true );
            //     }
            // }
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
    public static function get_cache( string $id_feed, string $type_data = '' ) {

        if ( $id_feed !== null && $id_feed !== '' && $id_feed !== 'undefined' ) {
             
            global $wpdb;

            if ( $type_data !== '' ) {
                $type_data = "AND {$wpdb->prefix}onfeedfb_cache.type_data=\"$type_data\"";
            }

            $cache = $wpdb->get_results(
                "SELECT {$wpdb->prefix}onfeedfb_cache.data_enc 
                FROM {$wpdb->prefix}onfeedfb_cache 
                WHERE {$wpdb->prefix}onfeedfb_cache.id_feed=\"$id_feed\" $type_data
                ORDER BY {$wpdb->prefix}onfeedfb_cache.date_crt DESC LIMIT 1",
                ARRAY_A
            );

            if ( $cache === '' || $cache === null ) {
                return "Qualcosa è andato storto";
            }

            // $cache_to_array = [];
            // foreach ( $cache as $k => $v ) {
            //     if ( $v === 'data_enc' ) {
            //         $cache_to_array[$k] = ONFHttpRequest::decrypt_data( $v, $id_feed );
            //     }
            // }

            return json_encode( ONFHttpRequest::decrypt_data( $cache[0]['data_enc'], $id_feed ) );
        }
    }
}