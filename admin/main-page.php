<?php
/**
 * 
 */

// session_start();

if ( ! defined('ABSPATH') ) exit; // Exit if accessed directly

if ( isset( $_GET['onfeed_new_connection'] ) ) {
    $_SESSION["onfeed_new_connection"] = 1;
    // setcookie( "onfeed_new_connection", true, time() + ( 5 * 24 * 60 * 60 ), "/" );
}

if ( isset( $_SESSION['onfeed_new_connection'] ) ) {
    require_once __DIR__ . "/new-feed.php";
} else {
    require_once __DIR__ . "/all-feeds.php";
}