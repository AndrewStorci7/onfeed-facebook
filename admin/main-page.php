<?php 
if ( ! defined('ABSPATH') ) exit; // Exit if accessed directly
?>

<div class="container-fluid onfeed-header-pannel" >
    <div class="container-fluid onfeed-content" >
        <img class="onfeed-img" src="<?php echo ONFEED_PLUGIN_URL . "assets/img/logoONFEED-AI-1.png"; ?>" alt="Logo OnFeed" >
    </div>
</div><!-- end onfeed-header-pannel -->

<div class="container-fluid onfeed-main-pannel">
    <div class="row onfeed-new-feed">
        <h2>
            <b>Create A New Feed <i class="fa-solid fa-plus" style="color: #5e91e8;"></i></b>
        </h2>
        <hr class="onfeed-hr">
        <p>
            Connect a new Facebook account.<br>
            <div class="row">
                <div class="col-3">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">@</span>
                        </div>
                        <input name="onfeed_input_feedname" id="onfeed_input_feedname" type="text" class="form-control" placeholder="Feed 1" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>
                <div class="col-1">        
                    <button id="onfeed-btn-sendtoapi" type="button" class="btn btn-info">
                        Create
                    </button>
                </div>
                <div class="col-8"></div>
            </div>
            <!--<form action="" method="post">
                <button name="onfeed_btn_sub" type="submit" class="btn btn-info">
                    Connect
                </button>
            </form>-->
            <p id="prova-hs">
                <?php 
                //if ( $data_from_fb !== null || $data_from_fb !== "" ) { 
                    //echo $data_from_fb;
                //} ?>
            </p>
        </p>
    </div>
    <div class="row onfeed-exis-feed">
        <h2>
            <b>Shape Your Feeds <i class="fa-solid fa-sliders" style="color: #217387;"></i></b>
        </h2>
        <hr class="onfeed-hr">
        <p id="onfeed-show-feeds">
            <!-- PROVVISORIO -->
            No Feed Were Found
        </p>
    </div>
</div><!-- end onfeed-main-pannel -->
<div class="onfeed-copyright-on">
    <p>@2023 All Right Reserved To <a href="https://oppimittinetworking.com" target="_blank">ON</a>, Developer: <a href="https://andreastorci.it" target="_blank">Andrea Storci</a></p>
</div>

<!--
<div class="onfeed-loading-page-connection">
    <div class="container">
        <center>
            Connecting to oppimittinetworging.com
        </center>
        <img src="<?php // echo get_option( 'siteurl' ) . "/wp-content/plugins/onfeed-facebook/admin/builder/"; ?>img/icons8-rhombus-loader.gif" />
        <img style="opacity:0.6;width: 50%; height: auto" src="<?php // echo get_option( 'siteurl' ) . "/wp-content/plugins/onfeed-facebook/admin/builder/"; ?>img/loading-76.gif" />
    </div>
</div>
-->