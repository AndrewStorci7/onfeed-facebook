function splitStr( _str ) {

    var count = 0;
    var $i = 0;

    for ( let i = 0; i < _str.length; i++ ) {
        if ( count === 3 ) {
            $i = i - 1;
            break;
        }
            
        if ( _str[i] === '/' )
            count++;
    }

    return _str.substring( 0, $i );
}

function makeId( length ) {

    var result = '';
    const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    const charactersLength = characters.length;
    let counter = 0;

    while ( counter < length ) {
        result += characters.charAt( Math.floor( Math.random() * charactersLength ) );
        counter++;
    }

    return result;
}

function getHostname() {
    return window.location.hostname.match(/^(?:.*?\.)?([a-zA-Z0-9\-_]{3,}\.(?:\w{2,8}|\w{2,4}\.\w{2,4}))$/)[1] + "_";
}