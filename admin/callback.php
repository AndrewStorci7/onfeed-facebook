<?php
/**
 * Handshake File with Oppimittinetworking.com Page Authentication
 * 
 * @author  Andrea Storci   Oppimittinetworking.com
 * 
 * @since   2.2.7
*/

// if ( ! defined( 'ABSPATH' ) ) exit;

require_once __DIR__ . '/builder/ONFHttpRequest.php';
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;

try {
    $id_feed        = isset( $_POST['id_feed'] ) ? $_POST['id_feed'] : null;
    $name_feed      = isset( $_POST['feed_name'] ) ? $_POST['feed_name'] : null;
    $http_request   = new ONFHttpRequest( $name_feed, $id_feed );
    $resp           = $http_request->new_feed_connection();

    echo $resp;
} catch ( Oppimittinetworking\OnfeedFacebook\Exceptions\IdFeedNotFound $e ) {
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