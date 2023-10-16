<?php
if ( ! defined( 'ABSPATH' ) ) exit;

require_once ONFEED_BUILDER_PATH . "Admin/ONFCache.php";
use Oppimittinetworking\OnfeedFacebook\Admin\ONFCache;

wp_enqueue_style( "onfeed_new_connection_css", ONFEED_PLUGIN_URL . "assets/css/new-connection.css" );
wp_enqueue_script( "onfeed_new_connection_js", ONFEED_PLUGIN_URL . "assets/js/new-connection.js" );

$data_list = ONFCache::get_cache( $_GET['onfeed_new_connection'], 'list' );
?>

<div class="onfeed-new-connection-div" >
    <div class="container-fluid header-new-connection" style="height: 20vh; background-color: black" >
        <div class="maschera-effetto" >

        </div>
    </div>
    <div class="position-relative" style="height: 80vh" >
        <div class="position-absolute top-0 start-50 translate-middle onfeed-fix-position-title-new-connection">
            <h2>
                <b> Choose one Page or Group </b>
            </h2>
        </div>
        <div class="position-absolute top-0 end-0">
            <button class="btn btn-danger fix-position-button" type="button" >
                Annulla
            </button>
        </div>
        <div class="position-absolute top-50 start-50 translate-middle" style="width: 40vw; min-height: 50vh" >
            <div id="prova-page-list">
                <?php if ( isset( $data_list ) && ! empty( $data_list ) ) echo $data_list; ?>
            </div>
        </div>
    </div>
</div>
