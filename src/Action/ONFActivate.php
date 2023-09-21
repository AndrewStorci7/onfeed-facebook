<?php
/**
 * OnFeedActivate class
 * Activation plugin class
 * 
 * @package onfeed-facebook
 * @author Andrea Storci
 * 
 * @since 2.2.7
 */

namespace Oppimittinetworking\OnfeedFacebook\Action;

class ONFActivate {

    /**
     * Activate:
     * It will create plugin's tables inside the database
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function activate() {
        global $wpdb;

        if ( $wpdb->get_var( 'SHOW TABLES LIKE "%' . ONFEED_DB_TABLE . '%"' ) == null ) {

            $charset_collate        = $wpdb->get_charset_collate();

            $table_name_posts       = ONFEED_DB_TABLE . 'posts';
            $table_name_album_photo = ONFEED_DB_TABLE . 'album_photo';
            $table_name_events      = ONFEED_DB_TABLE . 'events';
            $table_name_photo       = ONFEED_DB_TABLE . 'photo';
            $table_name_video       = ONFEED_DB_TABLE . 'video';
            $table_name_feeds       = ONFEED_DB_TABLE . 'feeds';

            $sql = "
            CREATE TABLE $table_name_posts (
                id varchar(255) PRIMARY KEY NOT NULL,
                json_resp text
            ) $charset_collate;
            CREATE TABLE $table_name_album_photo (
                id varchar(255) PRIMARY KEY NOT NULL,
                json_content text
            ) $charset_collate;
            CREATE TABLE $table_name_events (
                id varchar(255) PRIMARY KEY NOT NULL,
                json_resp text
            ) $charset_collate;
            CREATE TABLE $table_name_photo (
                id varchar(255) PRIMARY KEY NOT NULL,
                img_path varchar(255)
            ) $charset_collate;
            CREATE TABLE $table_name_video (
                id varchar(255) PRIMARY KEY NOT NULL,
                wav_path varchar(255)
            ) $charset_collate;
            CREATE TABLE $table_name_feeds (
                id int PRIMARY KEY NOT NULL AUTO_INCREMENT,
                name_feed varchar(255) NOT NULL DEFAULT 'Custom Feed',
                data_crt datetime NOT NULL COMMENT 'Date-Time Initialization',
                last_upd datetime NOT NULL COMMENT 'Last update of the feed from Facebook',
                time_to_upd integer,
                pe_to_show integer COMMENT 'Number of Posts/Events to show',
                feed_style integer(50),
                id_onfeed_posts varchar(255) NOT NULL DEFAULT '-1',
                id_onfeed_events varchar(255) NOT NULL DEFAULT '-1',
                id_onfeed_album_photo varchar(255) NOT NULL DEFAULT '-1',
                pub_key text NOT NULL,
                priv_key text NOT NULL,
                token_fb varchar(255) NOT NULL
            ) $charset_collate;
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_posts) REFERENCES $table_name_posts (id);
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_events) REFERENCES $table_name_events (id);
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_album_photo) REFERENCES $table_name_album_photo (id);
            ALTER TABLE $table_name_feeds ADD UNIQUE (pub_key);
            ALTER TABLE $table_name_feeds ADD UNIQUE (priv_key);
            ";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta( $sql );
        }
    }

    /**
     * Register Admin Scripts:
     * It call a delegated internal function: enqueue_admin()
     * and add it to the admin_enqueue_scripts()
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function register_admin_scripts() {
        add_action( 'admin_enqueue_scripts', array( 'Oppimittinetworking\\OnfeedFacebook\\Action\\ONFActivate', "enqueue_admin" ) );

        add_action( 'admin_menu', array( "Oppimittinetworking\\OnfeedFacebook\\Action\\ONFActivate", 'add_admin_pages' ) );
    }

    public static function add_admin_pages() {
        add_menu_page( 'OnFeed Facebook', 'OnFeed Facebook', 'manage_options', 'onfeed_admin_menu', array( 'Oppimittinetworking\\OnfeedFacebook\\Action\\ONFActivate', 'admin_index' ), 'dashicons-facebook-alt', 110 );
    }

    public static function admin_index() {
        require_once plugin_dir_path( __FILE__ ) . '../../admin/builder/index.php';
    }

    /**
     * Register Wordpress Scripts:
     * It call a delegated internal function: enqueue_wp()
     * and add it to the wp_enqueue_scripts()
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function register_wp_scripts() {
        // TODO
    }

    /**
     * Enqueue Admin:
     * It will add all the admin's scripts plugin needs
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function enqueue_admin() {
        // Enqueue admin css files
        // Bootstrap@5.3.0
        wp_register_style( "bootstrap", "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" );
        wp_enqueue_style( "bootstrap" );

        // FontAwesome@6.4.0
        wp_register_style( "font_awesome", "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" );
        wp_enqueue_style( "font_awesome" );

        wp_enqueue_style( "onfeed_main_css", plugins_url( "../../assets/css/main.css", __FILE__ ) );
        wp_enqueue_style( "onfeed_shortcut_css", plugins_url( "../../assets/css/shortcut.css", __FILE__ ) );
        wp_enqueue_style( "onfeed_feedspage_css", plugins_url( "../../assets/css/feedspage.css", __FILE__ ) );
        
        // Enqueue admin js files
        // jQuery@3.6.3
        wp_enqueue_script( "jquery_3_7_1-min", plugins_url( "../../assets/js/jquery-3.7.1.min.js", __FILE__ ), null, '3.7.1', array( 'strategy' => 'async' ) );

        wp_enqueue_script( "onfeed_function_js", plugins_url( "../../assets/js/function.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_handshake_js", plugins_url( "../../assets/js/handshake.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_shortcut_js", plugins_url( "../../assets/js/shortcut.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
        wp_enqueue_script( "onfeed_feedspage_js", plugins_url( "../../assets/js/feedspage.js", __FILE__ ), null, '2.2.0', array( 'strategy' => 'defer' ) );
    }

    /**
     * Enqueue Wordpress:
     * It will add all the global's scripts plugin needs
     * 
     * no @param
     * no @return
     * 
     * @since 2.2.7
     */
    public static function enqueue_wp() {
        // TODO
    }
}