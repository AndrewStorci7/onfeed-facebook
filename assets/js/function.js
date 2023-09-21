function split_str( _str ) {

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