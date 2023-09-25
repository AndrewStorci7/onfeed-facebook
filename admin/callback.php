<?php
/**
 * Handshake File with Oppimittinetworking.com Page Authentication
 * 
 * @author Andrea Storci, Oppimittinetworking.com
 * @since 2.2.0 
*/

require_once __DIR__ . '/../onfeed.php';

// First step: generation of keys
global $onfmain;

$enc_conn = $onfmain::encrypt_conn();

echo $enc_conn->getPublicKey();

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