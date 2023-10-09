jQuery( 'window' ).ready( ($) => {

    $( '#onfeed-btn-sendtoapi' ).click( function() {

        let name_feed = $( '#onfeed_input_feedname' ).val();

        if ( name_feed !== 'undefined' && name_feed !== null && name_feed !== '' ) {
            $( ".onfeed-loading-conn-parent" ).css( 'display', 'block' );
                
            let id_domain   = makeId( 20 );
            const url       = window.location.href;
            const split_url = splitStr( url );

            $.post( 
                split_url + '/wp-content/plugins/onfeed-facebook/admin/callback.php', 
                { id_domain: id_domain, feed_name: name_feed },
                ( _r ) => {

                    console.log( _r );
                    var parse = JSON.parse( _r );
                    if ( parse.code == 200 ) {

                        $( ".ldio-8zvggs87mmq div:nth-child(1)" ).delay(100).queue( () => {
                            console.log( "primo" );
                            $( ".ldio-8zvggs87mmq div:nth-child(1)" ).css( "background", "#2AA73F" );
                        } );
                        $( ".ldio-8zvggs87mmq div:nth-child(2)" ).delay(300).queue( () => { 
                            console.log( "secondo" );
                            $( ".ldio-8zvggs87mmq div:nth-child(2)" ).css( "border-color", "#186225" );
                        } );
                        $( ".ldio-8zvggs87mmq div:nth-child(3)" ).delay(600).queue( () => { 
                            console.log( "terzo" );
                            $( ".ldio-8zvggs87mmq div:nth-child(3)" ).css( "border-color", "#08210D" );
                            $( "#onfeed-connected-valid" ).html( "Connected <i class=\"fa-solid fa-circle-check\" style=\"color: #2aa73f;\"></i>" );
                            $( "#onfeed-redirect-valid" ).html( "Redirect to <span style=\"font-weight: 100; font-family: 'Inconsolata', monospace;\">oppimittinetworking.com</span>" );
                            window.location.href = "https://oauthon.local/oauth/onfeed/inc/url.php?url_ref=" + url + "&id_feed=" + id_domain;
                        } );
                        $( ".ldio-8zvggs87mmq div" ).css( "animation", "none" );
                        
                    } else if ( parse.code == 500 ) {

                        $( ".ldio-8zvggs87mmq div:nth-child(1)" ).delay(100).queue( () => { 
                            $( ".ldio-8zvggs87mmq div:nth-child(1)" ).css( "background", "#DF2E29" );
                        } );
                        $( ".ldio-8zvggs87mmq div:nth-child(2)" ).delay(300).queue( () => { 
                            $( ".ldio-8zvggs87mmq div:nth-child(2)" ).css( "border-color", "#A01C18" );
                        } );
                        $( ".ldio-8zvggs87mmq div:nth-child(3)" ).delay(600).queue( () => {

                            $( ".ldio-8zvggs87mmq div:nth-child(3)" ).css( "border-color", "#470D0B" );
                            $( "#onfeed-connected-valid" ).html( "Connection failed <i class=\"fa-solid fa-circle-xmark\" style=\"color: #df2e29;\"></i>" );
                            $( "#onfeed-redirect-valid" ).html( "<a href=\"javascript:void(0);\" id=\"onfeed-show-more-details-error\" style=\"font-size: 12px; color: blue; text-decoration: none;\" type=\"button\"><span><i style=\"padding-right: 10px;\" class=\"fa-solid fa-caret-up fa-lg\"></i></span>Show more details, and contact the plugin's author</a><span id=\"onfeed-details-error-message\" style=\"font-weight: 100; font-family: 'Inconsolata', monospace; display: none\">Error: " + parse.msg + "</span>" );
                            $( "#onfeed-connection-failed-btn" ).css( "display", "block" );

                            var clicked = true; 
                            $( "#onfeed-show-more-details-error" ).click( () => {
                                if ( clicked ) {
                                    $( "#onfeed-show-more-details-error" ).children(0).html( "<i style=\"padding-right: 10px;\" class=\"fa-solid fa-caret-down fa-lg\"></i>" );
                                    $( "#onfeed-details-error-message" ).css( "display", "block" );
                                    clicked = false;
                                } else {
                                    $( "#onfeed-show-more-details-error" ).children(0).html( "<i style=\"padding-right: 10px;\" class=\"fa-solid fa-caret-up fa-lg\"></i>" );
                                    $( "#onfeed-details-error-message" ).css( "display", "none" );
                                    clicked = true;
                                }
                            } );

                            $( "#onfeed-connection-failed-btn" ).click( () => {
                                $( ".onfeed-loading-conn-parent" ).css( 'display', 'none' );
                                window.location.href = "";
                            } );
                        } );

                        $( ".ldio-8zvggs87mmq div" ).css( "animation", "none" );
                    }
                }
            );
        } else {
            $( "#onfeed-feedname-notvalid-error-message" ).html( 
                "<span style='color: red; font-size: 12px'>" + 
                    "Please enter the name of the feed. If you are unsure, you can modify it later in the settings." + 
                "</span>" 
            );
            $( "#onfeed_input_feedname" ).css( "border", "2px solid red" );
            $( ".input-group" ).animate( { left: "20px" }, "fast" );
            $( ".input-group" ).animate( { left: "-20px" }, "fast" );
            $( ".input-group" ).animate( { left: "10px" }, "fast" );
            $( ".input-group" ).animate( { left: "-10px" }, "fast" );
            $( ".input-group" ).animate( { left: "5px" }, "fast" );
            $( ".input-group" ).animate( { left: "-5px" }, "fast" );
            $( ".input-group" ).animate( { left: "0px" }, "fast" );
        }
    });

});