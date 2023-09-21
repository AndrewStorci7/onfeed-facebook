<?php
/**
 * Handshake File with Oppimittinetworking.com Page Authentication
 * 
 * @author Andrea Storci, Oppimittinetworking.com
 * @since 2.2.0 
*/

require_once __DIR__ . '/../../src/RSA/ONFRSAEncrypt';

use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSAEncrypt;

$hs = isset( $_POST[ 'hs' ] ) ? $_POST[ 'hs' ] : false;
$pk = isset( $_POST[ 'pk' ] ) ? $_POST[ 'pk' ] : false;

if ( $hs && $pk ) {

    // ONLY FOR TEST
    $rsa = new ONFRSAEncrypt();
    echo $rsa->getPublicKey();

    $url = 'https://oauthon.local/oauth/onfeed/handshake.php';
    // $url = 'https://oppimittinetworking.com/oauth/onfeed/handshake.php';
    
    while ( $rsa->getPublicKey() == null || $rsa->getPublicKey() == '' ) {
        echo "No data";
    }
    
    /*
    $data = [ 'pbk' => $rsa->getPublicKey() ];
    
    $options = [
        'http' => [
            'header'    => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'    => 'POST',
            'content'   => http_build_query( $data )
        ],
    ];
    
    $context    = stream_context_create( $options );
    $result     = file_get_contents( $url, false, $context );
    if ( $result === false )
        echo 'Error: Handshake with Oppimittinetworking.com Failed!';
    else
        var_dump( $result );
    */
}









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
?>