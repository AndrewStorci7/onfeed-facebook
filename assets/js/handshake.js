jQuery( 'window' ).ready( ($) => {

    $( '#onfeed-btn-sendtoapi' ).click( function() {
        
        let name_feed   = $( '#onfeed_input_feedname' ).val();
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
    });
});