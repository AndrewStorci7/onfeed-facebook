<?php
/**
 * IdFeedNotFound 
 * 
 * @author Andrea Storci
 * 
 * @since 2.2.7
*/

namespace Oppimittinetworking\OnfeedFacebook\Exceptions;

class IdFeedNotFound extends \Exception {

    /**
     * Error Message
     * 
     * @var string
     */
    private $msg = '';

    /**
     * Constructor 
     * 
     * @param   string  $msg    Error message
     */    
    public function __construct( $msg ) {
        $this->msg = $msg;
    }

    /**
     * Get error message
     * 
     * @return  string  $this->msg
     */
    public function get_message() {
        return $this->msg;
    }

}