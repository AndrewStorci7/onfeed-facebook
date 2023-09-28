jQuery( 'window' ).ready( ($) => {

    $( '#onfeed-btn-sendtoapi' ).click( function() {

        let name_feed = $( '#onfeed_input_feedname' ).val();

        if ( name_feed !== 'undefined' && name_feed !== null && name_feed !== '' ) {
            $( ".onfeed-loading-conn-parent" ).css( 'display', 'block' );
                
            let id_feed     = makeId( 20 );
            const url       = window.location.href;
            const split_url = splitStr( url );

            $.post( 
                split_url + '/wp-content/plugins/onfeed-facebook/admin/callback.php', 
                { id_feed: id_feed, feed_name: name_feed },
                ( _r ) => {
                    console.log(_r);
                    
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