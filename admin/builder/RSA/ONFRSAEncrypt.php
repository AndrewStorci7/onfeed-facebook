<?php
/**
 * Class For Create The Connection for RSA Algorhitm
 * 
 * @author Andrea Storci, Oppimittinetworking.com 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook\RSA;
use phpseclib3\Crypt\RSA;

class ONFRSAEncrypt {
    
    /**
     * OpenSSL Config
     * 
     * @var array
     */
    private $openssl_cnf = array();

    private $url_handshake = 'https://oauthon.local/oauth/onfeed/handshake.php';
    // $url = 'https://oppimittinetworking.com/oauth/onfeed/handshake.php';

    private $current_domain;

    /**
     * OpenSSL Key Pair
     * 
     * @var int[]
     */
    private $keypair;

    /**
     * OpenSSL Public Key
     * 
     * @var string
     */
    private $publickey;

    /**
     * OpenSSL Public Key Export
     * 
     */
    private $pbk;

    /**
     * OpenSSL Private Keys
     * 
     * @var string
     */
    private $privatekey;
    
    /**
     * Constructor
     */
    public function __construct() {

        $this->privatekey       = RSA::createKey();
        $this->publickey        = $this->privatekey->getPublicKey();
        $this->current_domain   = $_SERVER[ 'SERVER_NAME' ];

        $data = [ 
            'pbk'       => $this->getPublicKey(), 
            'domain'    => $this->current_domain
        ];

        $options = [
            'http' => [
                'header'    => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'    => 'POST',
                'content'   => http_build_query( $data )
            ],
        ];
            
        $context    = stream_context_create( $options );
        $result     = file_get_contents( $this->url_handshake, false, $context );
        if ( $result === false )
            echo 'Error: Handshake with Oppimittinetworking.com Failed!';
        else var_dump( $result );

        // TODO:
        // Salvare su DB:
        // - Chiave Pubblica
        // - Chiave Privata
    }

    public function getPublicKey() {
        return $this->publickey;
    }
}
?>