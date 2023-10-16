<?php
/**
 * RSA class Decrypt
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.1
 */

namespace Oppimittinetworking\OnfeedFacebook\RSA;

class ONFRSADecrypt {

    private array $openssl_cnf = array(
        "config"            => __DIR__ . '/openssl/openssl.cnf',
        "digest_alg"        => "sha512",
        "private_key_bits"  => 4096,
        "private_key_type"  => OPENSSL_KEYTYPE_RSA
    );

    /**
     * Function that decrypt data from the API
     * 
     * @param   string  Encrypted Data
     * @param   string  Private key
     * 
     * @return  string  Decrypted Data
     */
    public static function decrypt( string $data_to_decrypt, string $priv_key ) {

        $check = openssl_private_decrypt(
            base64_decode( $data_to_decrypt ),
            $res,
            $priv_key,
            OPENSSL_PKCS1_PADDING
        );

        if ( $check ) {
            return $res;
        } else {
            return openssl_error_string();
        }
    }
}
?>