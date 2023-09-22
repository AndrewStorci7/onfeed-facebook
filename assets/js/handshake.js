jQuery( 'window' ).ready( ($) => {

    $( '#onfeed-btn-sendtoapi' ).click( function() {

        let pk          = makeId( 20 );
        const url       = window.location.href;
        const split_url = splitStr( url );
        let response    = false;
        $.post( 
            split_url + '/wp-content/plugins/onfeed-facebook/admin/callback.php', 
            { pk: pk, hs: true },
            ( _r ) => {
                console.log(_r);
                $( '#prova-hs' ).text( _r );
            }
        );
        if ( response ) {
            // ONLY FOR TEST
            window.location = "https://oauthon.local/oauth/onfeed/inc/url.php?url_ref=" + url + "&pk=" + pk;
            // window.location = "https://oppimittinetworking.com/oauth/onfeed/url.php?url_ref=" + url + "&pk=" + pk;
        }
    });
});