jQuery( 'window' ).ready( ($) => {

    function makeid( length ) {
        let result = window.location.hostname.match(/^(?:.*?\.)?([a-zA-Z0-9\-_]{3,}\.(?:\w{2,8}|\w{2,4}\.\w{2,4}))$/)[1] + "_";
        const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        const charactersLength = characters.length;
        let counter = 0;
        while ( counter < length ) {
            result += characters.charAt( Math.floor( Math.random() * charactersLength ) );
            counter++;
        }
        return result;
    }
                
    $( '#onfeed-btn-sendtoapi' ).click( function() {
        let pk          = makeid( 20 );
        const url       = window.location.href;
        const split_url = split_str( url );
        let response    = false;
        $.post( 
            split_url + '/wp-content/plugins/onfeed-facebook/admin/builder/callback.php', 
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