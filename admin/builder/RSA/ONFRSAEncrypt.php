<?php
/**
 * Class For Create The Connection for RSA Algorhitm
 * 
 * @author Andrea Storci, Oppimittinetworking.com 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook\RSA;

// require_once __DIR__ . '/../../../vendor/phpseclib/phpseclib/phpseclib/Crypt/RSA.php';

class ONFRSAEncrypt {
    
    /**
     * OpenSSL Config
     * 
     * @var array
     */
    private $openssl_cnf = array(
        "config"            => __DIR__ . '/openssl/openssl.cnf',
        "digest_alg"        => "sha512",
        "private_key_bits"  => 4096,
        "private_key_type"  => OPENSSL_KEYTYPE_RSA
    );

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

        $this->keypair          = openssl_pkey_new( $this->openssl_cnf );
        openssl_pkey_export( $this->keypair, $this->privatekey, null, $this->openssl_cnf );
        $this->pbk              = openssl_pkey_get_details( $this->keypair );
        $this->publickey        = $this->pbk['key'];
        // $this->privatekey       = RSA::createKey();
        // $this->publickey        = $this->privatekey->getPublicKey();
        $this->current_domain   = $_SERVER[ 'SERVER_NAME' ];

        // $data = [ 
        //     'pbk'       => $this->getPublicKey(), 
        //     'domain'    => $this->current_domain
        // ];

        // $options = [
        //     'http' => [
        //         'header'    => "Content-type: application/x-www-form-urlencoded\r\n",
        //         'method'    => 'POST',
        //         'content'   => http_build_query( $data )
        //     ],
        // ];
            
        // $context    = stream_context_create( $options );
        // $result     = file_get_contents( $this->url_handshake, false, $context );
        // if ( $result === false )
        //     echo 'Error: Handshake with Oppimittinetworking.com Failed!';
        // else var_dump( $result );

        // TODO:
        // Salvare su DB:
        // - Chiave Pubblica
        // - Chiave Privata
    }

    public function getPbk() {
        return $this->publickey;
    }

    public function getDomain() {
        return $this->current_domain;
    }

    public function getPrivKey() {
        return $this->privatekey;
    }

}
?>