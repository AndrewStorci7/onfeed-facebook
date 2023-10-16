<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
?>

<div class="container-fluid onfeed-header-pannel" >
    <div class="container-fluid onfeed-content" >
        <!--<img class="onfeed-img" src="" alt="Logo OnFeed" >-->
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
                    <p id="onfeed-feedname-notvalid-error-message"></p>
                </div>
                <div class="col-1">        
                    <button id="onfeed-btn-sendtoapi" type="button" class="btn btn-info">
                        Create
                    </button>
                </div>
                <div class="col-8"></div>
            </div>
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
    <p id="onfeed-all-right-reserved" >@2023 All Right Reserved To <a href="https://oppimittinetworking.com" target="_blank">ON</a>, Developer: <a href="https://andreastorci.it" target="_blank">Andrea Storci</a></p>
    <p id="onfeed-plugin-version" >Version <?php echo ONFEED_V; ?></p>
</div>

<!-- LOADING DIV -->
<div class="container-fluid onfeed-loading-conn-parent">
    <div class="container onfeed-loading-conn">    
        <div class="loadingio-spinner-radio-buqhezk3sag">
            <div class="ldio-8zvggs87mmq">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        <p>
            <span id="onfeed-connected-valid" style="font-size: 18px; font-weight: bold; padding: 0 20px 20px 20px">
                Connecting to <span style="font-weight: 100; font-family: 'Inconsolata', monospace;">oppimittinetworking.com</span>
            </span> </br>
            <span style="font-size: 18px; font-weight: bold; padding: 0 20px 20px 20px" id="onfeed-redirect-valid"></span>
            <button style="display: none; margin-top: 5px; margin-bottom: 10px; float: right;" id="onfeed-connection-failed-btn" class="btn btn-danger" >Close</button>
        </p>
    </div>
</div>