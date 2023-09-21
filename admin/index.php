<?php

include_once 'callback.php';

header( "Access-Control-Allow-Origin: oppimittinetworking.com" );

?>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" 
                integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" 
                crossorigin="anonymous" ></script>
<button id="onas-btn-sendtoapi">
    Encode
</button>
<p>
    <?php if ( $data_from_fb !== null || $data_from_fb !== "" ) { 
        echo $data_from_fb;
    } ?>
</p>
<script>
    function makeid(length) {
        let result = '';
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while (counter < length) {
          result += characters.charAt(Math.floor(Math.random() * charactersLength));
          counter += 1;
        }
        return result;
    }
    
    $( '#onfeed-btn-sendtoapi' ).click( function() {
        let pk = makeid( 10 );
        const url   = window.location.href;
        window.location = "https://oppimittinetworking.com/oauth/onfeed/url.php?url_ref=" + url + "&pk=" + pk;
    });
    
</script>