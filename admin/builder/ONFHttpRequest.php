<?php
/**
 * ONFHttpRequest 
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook;

// require_once __DIR__ . '/Exceptions/IdFeedNotFound.php';
// require_once __DIR__ . '/RSA/ONFRSAEncrypt.php';
// require_once __DIR__ . '/ONFActivate.php';

use Oppimittinetworking\OnfeedFacebook\Exceptions\IdFeedNotFound;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSADecrypt;
use Oppimittinetworking\OnfeedFacebook\RSA\ONFRSAEncrypt;
use Oppimittinetworking\OnfeedFacebook\ONFActivate;

class ONFHttpRequest {

    /**
     * Request URL
     * 
     * @var string    By default: https://oppimittinetworking.com/oauth/onfeed/handshake.php
     */
    private $url = 'https://oauthon.local/oauth/onfeed/';
    // private $url = 'https://oppimittinetworking.com/oauth/onfeed/handshake.php';

    private readonly string $private_key;

    /**
     * Public Key to send
     * 
     * @var string
     */
    public $pbk = '';

    /**
     * Name of the feed to send
     * 
     * @var string
     */
    public $feed_name = '';

    /**
     * Domain name to send
     * 
     * @var string
     */
    private $domain_name = '';

    /**
     * Domain name to send
     * 
     * @var string
     */
    public $id_domain = '';

    /**
     * Response data
     * 
     * @var string|json
     */
    private $data = '';

    /**
     * Create and Save Public Key and Private key
     * 
     * @param   string
     * @param   string
     */
    public function __construct( string $feed_name = '', string $id_domain = '' ) {

        global $wpdb;

        if ( $feed_name === null || $feed_name === 'undefined' || $feed_name === '' ||
             $id_domain === null || $id_domain === 'undefined' || $id_domain === '' ) {
            
            return;
        }    

        $this->feed_name    = $feed_name;
        $new_rsa            = new ONFRSAEncrypt();
        $this->pbk          = $new_rsa->getPbk();
        $this->private_key  = $new_rsa->getPrivKey();
        $this->domain_name  = $new_rsa->getDomain();
        $this->id_domain    = $id_domain;

        $data_to_insert     = [
            "id"        => $this->id_domain,
            "name_feed" => $this->feed_name,
            "data_crt"  => date( 'Y-m-d H:i:sa' ),
            "last_upd"  => date( 'Y-m-d H:i:sa' ),
            "pub_key"   => $this->pbk,
            "priv_key"  => $this->private_key
        ];

        $check = $wpdb->insert( 
            $wpdb->prefix . 'onfeedfb_feeds',
            $data_to_insert
        );

        if ( ! $check ) {
            throw new \Exception( "Error on register feed" );
        } 
    }

    /**
     * Make Post Request
     * 
     */
    public function make_post_request( $name_feed = null ) {

        global $wpdb;

        if ( $name_feed === null || $name_feed === 'undefined' || $name_feed === '' ) {
            throw new IdFeedNotFound('Id of the feed not found');
        }

        $this->feed_name = $name_feed;
        $urlparts = wp_parse_url( home_url() );
        $this->domain_name = $urlparts['host'];

        $table = ONFEED_DB_TABLE . "feeds";

        $this->pbk = $wpdb->get_results(
            "SELECT $table.pub_key FROM $table WHERE $table.name_feed = {$this->feed_name}"
        );

        if ( $this->pbk === null || $this->pbk === 'undefined' || $this->pbk === '' ) {
            $new_rsa = new ONFRSAEncrypt();
            $this->pbk = $new_rsa->getPbk();
        }

        $body = array(
            'pbk'       => $this->pbk,
            'domain'    => $this->domain_name,
            'feed_name' => $this->feed_name
        );

        $args = array(

        );

        $response = wp_remote_post( 'https://oauthon.local/oauth/onfeed/', $args );
    }

    /**
     * New Feed Connection Handle
     * 
     */
    public function new_feed_connection() {

        require_once __DIR__ . '/../../../../../wp-load.php';

        $boundary = "-----" . substr( strval( mt_rand() / mt_getrandmax() ), 2 );

        $data = array(
            'type_req'      => 1,
            'pbk'           => $this->pbk,
            'domain'        => $this->domain_name,
            'feed_name'     => $this->feed_name,
            'id_domain'     => $this->id_domain
        );

        $body = '';
        foreach ( $data as $key => $val ) {
            $body .= "--$boundary\r\n";
            $body .= "Content-Disposition: form-data; name=\"$key\"\r\n\r\n";
            $body .= "$val\r\n";
        }

        $args = array(
            'method'            => 'POST',
            'headers'           => array(
                'content-type'  => "multipart/form-data; charset=utf-8; boundary=$boundary"
            ),
            'body'              => $body,
            // 'data_format'       => 'body',
            'reject_unsafe_url' => false,
            'timeout'           => 10,
            'redirection'       => 10,
            'httpversion'       => '1.0',
            'sslverify'         => false
        );

        // var_dump($this->pbk);
        $this->data = wp_remote_post( 'https://oauthon.local/oauth/onfeed/api/', $args )['body'];
        // $this->data = wp_remote_post( 'https://oauthon.local/oauth/onfeed/api/', $args );

        return $this->data;
    }

    public static function decrypt_data( string $data_to_decrypt, string $id_feed ) {

        global $wpdb;

        if ( empty( $data_to_decrypt ) || $data_to_decrypt === '' || $data_to_decrypt === null || $data_to_decrypt === 'undefined' || 
             empty( $id_feed ) || $id_feed === '' || $id_feed === null || $id_feed === 'undefined' ) {

            return "no data";
        }

        $priv_key = $wpdb->get_results( 
            "SELECT $wpdb->prefix" . "onfeedfb_feeds.priv_key FROM $wpdb->prefix" . "onfeedfb_feeds WHERE $wpdb->prefix" . "onfeedfb_feeds.id='$id_feed'",
            ARRAY_A
        )[0]['priv_key'];

        $data_dec = ONFRSADecrypt::decrypt( $data_to_decrypt, $priv_key );
        return $data_dec;
    }
}