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
}