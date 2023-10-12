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

namespace Oppimittinetworking\OnfeedFacebook\Admin;

// if ( ! defined( 'ABSPATH' ) ) die;

class ONFActivate {

    /**
     * Activate:
     * It will create plugin's tables inside the database
     * @param   none
     * @return  none 
     * 
     * @since 2.2.7
     */
    public static function register_service() {

        global $wpdb;

        if ( $wpdb->get_var( 'SHOW TABLES LIKE "%' . ONFEED_DB_TABLE . '%"' ) == null ) {

            $charset_collate        = $wpdb->get_charset_collate();

            $table_name_posts       = ONFEED_DB_TABLE . 'posts';
            $table_name_album_photo = ONFEED_DB_TABLE . 'album_photo';
            $table_name_events      = ONFEED_DB_TABLE . 'events';
            $table_name_photo       = ONFEED_DB_TABLE . 'photo';
            $table_name_video       = ONFEED_DB_TABLE . 'video';
            $table_name_feeds       = ONFEED_DB_TABLE . 'feeds';
            $table_name_cache       = ONFEED_DB_TABLE . 'cache';

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
                id varchar(20) PRIMARY KEY NOT NULL,
                name_feed varchar(255) NOT NULL DEFAULT 'Custom Feed',
                data_crt datetime NOT NULL COMMENT 'Date-Time Initialization',
                last_upd datetime NOT NULL COMMENT 'Last update of the feed from Facebook',
                time_to_upd integer NULL DEFAULT '86400',
                pe_to_show integer NULL DEFAULT '5' COMMENT 'Number of Posts/Events to show',
                feed_style integer(50) NULL DEFAULT '1',
                id_onfeed_posts varchar(255) NOT NULL DEFAULT '-1',
                id_onfeed_events varchar(255) NOT NULL DEFAULT '-1',
                id_onfeed_album_photo varchar(255) NOT NULL DEFAULT '-1',
                pub_key text NULL,
                priv_key text NULL,
                token_fb varchar(255) NULL
            ) $charset_collate;
            CREATE TABLE $table_name_cache (
                id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
                id_feed varchar(256) NOT NULL,
                data_enc text NULL,
                date_crt datetime NULL,
                date_exp datetime NULL
            ) $charset_collate;
            ALTER TABLE $table_name_cache ADD FOREIGN KEY (id_feed) REFERENCES $table_name_feeds (id);
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_posts) REFERENCES $table_name_posts (id);
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_events) REFERENCES $table_name_events (id);
            ALTER TABLE $table_name_feeds ADD FOREIGN KEY (id_onfeed_album_photo) REFERENCES $table_name_album_photo (id);
            ALTER TABLE $table_name_feeds ADD UNIQUE (pub_key);
            ALTER TABLE $table_name_feeds ADD UNIQUE (priv_key);
            ";

            require_once ABSPATH . 'wp-admin/includes/upgrade.php';
            dbDelta( $sql );
        }

        add_filter( "plugin_action_links_" . ONFEED_PLUGIN_BASENAME, array( "Oppimittinetworking\\OnfeedFacebook\\Admin\\ONFActivate", 'register_settings_link' ) );
    }

    /**
     * Register settings link
     * @param   array   $links
     * @return  array   $links
     */
    public static function register_settings_link( $links ) {
        $settings_link = "<a href='admin.php?page=onfeed_settings_page'>Settings</a>";
        array_push( $links, $settings_link );
        return $links;
    }

    public static function register_feed( array|string $data_to_insert ) {

        global $wpdb;

        if ( ! empty( $data_to_insert ) ) {

            foreach ( $data_to_insert as $k => $v ) {
                if ( $v === null || $v === '' || $v === 'undefined' || empty( $v ) )
                    return false;
            }

            $check = $wpdb->insert( 
                ONFEED_DB_TABLE . "feeds",
                $data_to_insert
            );

            return $check; 
        }

        return false;
    }
}