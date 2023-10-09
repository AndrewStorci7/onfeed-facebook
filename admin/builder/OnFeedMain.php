<?php
/**
 * Main Class for OnFeedFacebook Plugin
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook;
use Oppimittinetworking\OnfeedFacebook\ONFHttpRequest;
use Oppimittinetworking\OnfeedFacebook\Admin\ONFAdmin;

class OnFeedMain {

    /**
     * ONFHttpRequest
     * 
     * @var ONFHttpRequest
     */
    public $onf_http_request;

    /**
     * ONFHttpRequest
     * 
     * @var ONFAdmin
     */
    public $onf_admin;

    /**
     * Database Version
     * 
     * @var   string  Version
     */
    public readonly string $db_v;
    
    /**
     * Plugin PATH
     * 
     * @var   string  PATH
     */
    public readonly string $plugin_path;

    /**
     * Plugin URL
     * 
     * @var   string  URL
     */
    public readonly string $plugin_url;

    /**
     * Main File
     * 
     * @var   string  Main file
     */
    public readonly string $main_file;

    /**
     * Basename of the plugin
     * 
     * @var   string  Basename
     */
    public readonly string $basename;

    /**
     * Builder Path of the plugin
     * 
     * @var   string  Builder path
     */
    public readonly string $builder_path;

    /**
     * SLUG of the plugin
     * 
     * @var   string  SLUG
     */
    public readonly string $slug;

    /**
     * Table's name of saved Facebook Feeds
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_feeds;

    /**
     * Table's name of saved Facebook Album Photos/Videos
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_album;

    /**
     * Table's name of saved Facebook Photos
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_photo;

    /**
     * Table's name of saved Facebook Posts
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_posts;

    /**
     * Table's name of saved Facebook Videos
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_video;

    /**
     * Table's name of saved Facebook Events
     * 
     * @var   string  Name of the table
     */
    public readonly string $db_table_events;

    /**
     * Constructor:
     * It will call the functions that register admin and gloabal's scripts, 
     * add ... , 
     * and create the tables plugin needs inside the database. 
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
    */
    public function __construct( string $db_v = null, string $plugin_path = null, string $plugin_url = null, string $main_file = null, string $basename = null, string $builder_path = null, string $slug = null, string $db_name = null ) {
        
        // $this->onf_http_request = new ONFHttpRequest();
        // $this->onf_admin        = new ONFAdmin();
        $this->db_v             = $db_v;
        $this->plugin_path      = $plugin_path;
        $this->plugin_url       = $plugin_url;
        $this->main_file        = $main_file;
        $this->basename         = $basename;
        $this->builder_path     = $builder_path;
        $this->slug             = $slug;
        $this->db_table_feeds   = $db_name . "feeds";
        $this->db_table_album   = $db_name . "album";
        $this->db_table_photo   = $db_name . "photo";
        $this->db_table_posts   = $db_name . "posts";
        $this->db_table_video   = $db_name . "video";
        $this->db_table_events  = $db_name . "events";
    }

    public function connect( $type = 1, $name_feed = null ) {

        switch ( $type ) {
            case 1: {
                // New Connection
                $this->onf_http_request->new_feed_connection();
                break;
            }
            case 2: {
                // Fetch data
                $this->onf_http_request->make_post_request( $name_feed );
                break;
            }
        }
    }
}
