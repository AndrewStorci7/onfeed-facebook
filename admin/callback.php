<?php
/**
 * Handshake File with Oppimittinetworking.com Page Authentication
 * 
 * @author  Andrea Storci   Oppimittinetworking.com
 * 
 * @since   2.2.7
*/

namespace Oppimittinetworking;

require_once __DIR__ . '/builder/Exceptions/IdFeedNotFound.php';
require_once __DIR__ . '/builder/RSA/ONFRSADecrypt.php';
require_once __DIR__ . '/builder/ONFHttpRequest.php';

use Oppimittinetworking\OnfeedFacebook\Exceptions\IdFeedNotFound;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;

try {

    // Data for new connection to send at API handler
    $id_domain      = isset( $_POST['id_domain'] ) ? $_POST['id_domain'] : null;
    $name_feed      = isset( $_POST['feed_name'] ) ? $_POST['feed_name'] : null;

    // Data Encrypted from the API
    $data_enc       = isset( $_POST['onfeed_data'] ) ? $_POST['onfeed_data'] : null;
     
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
                    // TODO
                    echo json_encode( array(
                        'code'  => 300,
                        'msg'   => "already_exc"
                    ) );
                    break;
                }
                case "no_data": {
                    // TODO
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
    } else if ( $data_enc !== null && $data_enc !== '' && $data_enc !== 'undefined' ) {

        echo $data_enc;
    } else {
        echo 'No data';
    }
} catch ( IdFeedNotFound $e ) {
    echo $e->get_message();
}

// if ( isset( $_POST['onfeed_btn_sub'] ) ) {
//     echo "ciao";
//     require_once __DIR__ . '/../onfeed.php';

//     // First step: generation of keys
//     global $onfmain;

//     $enc_conn = $onfmain::encrypt_conn();

//     echo $enc_conn->getPublicKey();
// }
// echo 'no';

// Second step: get the domain/URI to associate with the public key

// Third step: send the public key to the OAuth API and save it


/*
$h = get_headers( "https://oppimittinetworking.com/oauth/onfeed/index.php", true );


data_from_fb = isset( $_POST['content'] ) ? $_POST['content'] : '';

if ( $data_from_fb !== null || $data_from_fb !== '' ) {
    setcookie( 'data_fb', $data_from_fb, time() + 86400 * 30, '/', false, true );
    echo 1;
} else {
    echo 0;
}

if ( $h !== null || $h !== '' ) {
    print_r( $h );
} else {
    echo 0;
}
*/