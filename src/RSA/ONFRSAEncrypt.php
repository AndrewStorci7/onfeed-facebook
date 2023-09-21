<?php
/**
 * Class For Create The Connection for RSA Algorhitm
 * 
 * @author Andrea Storci, Oppimittinetworking.com 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook\RSA;

// if ( ! defined( 'ABSPATH' ) ) exit;

class ONFRSAEncrypt {
    
    /**
     * OpenSSL Config
     * 
     * @var array
     */
    private $openssl_cnf = array();

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

        $this->openssl_cnf = [
            'config'            => plugins_url( '/openssl/openssl.cnf', __FILE__ ),
            'default_md'        => 'sha512',
            'private_key_bits'  => 1024,
            'private_key_type'  => OPENSSL_KEYTYPE_RSA
        ];

        $this->keypair      = openssl_pkey_new( $this->openssl_cnf );
        openssl_pkey_export( $this->keypair, $this->privatekey, null, $this->openssl_cnf );

        $this->publickey    = openssl_pkey_get_details( $this->keypair );
        $this->pbk          = $this->publickey[ 'key' ];
        

        // TODO:
        // Salvare su DB:
        // - Chiave Pubblica
        // - Chiave Privata
    }

    public function getPublicKey() {
        return $this->pbk;
    }
}
 ?>