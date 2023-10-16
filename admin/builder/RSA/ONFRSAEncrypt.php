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
        // "config"            => __DIR__ . '/openssl/openssl.cnf',
        "digest_alg"        => "sha256",
        "private_key_bits"  => 2048,
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
        // openssl_pkey_export( $this->keypair, $this->privatekey, null, $this->openssl_cnf );
        openssl_pkey_export( $this->keypair, $this->privatekey );
        $this->pbk              = openssl_pkey_get_details( $this->keypair );
        $this->publickey        = $this->pbk['key'];
        $this->current_domain   = $_SERVER[ 'SERVER_NAME' ];
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