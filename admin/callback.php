<?php
/**
 * Handshake File with Oppimittinetworking.com Page Authentication
 * 
 * @author  Andrea Storci   Oppimittinetworking.com
 * 
 * @since   2.2.7
*/

require_once __DIR__ . '/builder/Exceptions/IdFeedNotFound.php';
require_once __DIR__ . '/builder/RSA/ONFRSADecrypt.php';
require_once __DIR__ . '/builder/Admin/ONFCache.php';
require_once __DIR__ . '/builder/ONFHttpRequest.php';
require_once __DIR__ . '/../../../../wp-load.php';

use Oppimittinetworking\OnfeedFacebook\Exceptions\IdFeedNotFound;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFCache;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;

try {

    // Data for new connection to send at API handler
    $id_domain          = isset( $_POST['id_domain'] ) ? $_POST['id_domain'] : null;
    $name_feed          = isset( $_POST['feed_name'] ) ? $_POST['feed_name'] : null;

    // Data Encrypted from the API
    $data_enc           = isset( $_POST['onfeed_data'] ) ? $_POST['onfeed_data'] : null;
    $onfeed_id_feed     = isset( $_POST['onfeed_id_feed'] ) ? $_POST['onfeed_id_feed'] : null;
    $onfeed_type_data   = isset( $_POST['onfeed_type_data'] ) ? $_POST['onfeed_type_data'] : null;
    $onfeed_type_format = isset( $_POST['onfeed_type_format'] ) ? $_POST['onfeed_type_format'] : null;

    if ( $id_domain !== null && $id_domain !== '' && $id_domain !== 'undefined' && 
         $name_feed !== null && $name_feed !== '' && $name_feed !== 'undefined' ) {

        try {
            $http_request   = new ONFHttpRequest( $name_feed, $id_domain );
            $resp           = get_object_vars( json_decode( $http_request->new_feed_connection() ) );
        } catch ( \Exception $e ) {
            json_encode( array(
                'code'  => 500,
                'msg'   => $e->getMessage()
            ) );
        }
        // $http_request   = new ONFHttpRequest( 'prova', 'prova' );
        // $resp           = $http_request->new_feed_connection();
        // print_r( $resp );
        // $resp           = get_object_vars( json_decode( $http_request->new_feed_connection() ) );

        if ( $resp['type_resp'] === -1 ) {
            
            $message = (string) $resp['message'];

            switch ( $message ) {
                case "already_exc": {
                    echo json_encode( array(
                        'code'  => 300,
                        'msg'   => "already_exc"
                    ) );
                    break;
                }
                case "no_data": {
                    echo json_encode ( array(
                        'code'  => 404,
                        'msg'   => "no_data"
                    ) );
                    break;
                }
                default: {
                    echo json_encode( array(
                        'code'  => 500,
                        'msg'   => "internal_err"
                    ) );
                    break;
                }
            }
        } else if ( $resp['type_resp'] === 1 ) {
            echo json_encode( array(
                'code'  => 200,
                'msg'   => ""
            ) );
        } else {
            echo json_encode( array(
                'code'  => 500,
                'msg'   => "internal_err"
            ) );
        }
    } else if ( $data_enc !== null && $data_enc !== '' && $data_enc !== 'undefined' && 
                $onfeed_id_feed !== null && $onfeed_id_feed !== '' && $onfeed_id_feed !== 'undefined' &&
                $onfeed_type_data !== null && $onfeed_type_data !== '' && $onfeed_type_data !== 'undefined' &&
                $onfeed_type_format !== null && $onfeed_type_format !== '' && $onfeed_type_format !== 'undefined' ) {
        
        $cache = new ONFCache( $onfeed_id_feed, $data_enc, $onfeed_type_data, $onfeed_type_format );
        $prova = $cache->create_cache();
        echo $prova;
        // $response = ONFHttpRequest::decrypt_data( $data_enc, $onfeed_id_feed );

        // echo $response;
    } else {
        echo 'No data';
    }
} catch ( IdFeedNotFound $e ) {
    echo $e->get_message();
}