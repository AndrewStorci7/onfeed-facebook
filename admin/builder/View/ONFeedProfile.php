<?php
/**
 * @Class ONF_Feed_Profile
 * 
 * Class that contain the props and attrs of the Feeds' personal account
 * 
 * @since 2.2.7
*/ 

namespace Oppimittinetworking\OnfeedFacebook\View;

class ONFeedProfile {
    
    /**
     * @var array|json
     */
    protected $attrs;
    
    /**
     * @var array|json
     */ 
    protected $props;
    
    /**
     * @var array|json
     */ 
    protected $options;
    
    /**
     * @var boolean
     */ 
    protected $active;
    
    public function __construct( $a, $b, $c, $d ) {
        $this->attrs    = $a;
        $this->props    = $b;
        $this->options  = $c;
        $this->active   = $a;
    }
    
    /**
     * @return array|json
     * 
     * @since 2.2.7
     */ 
    public function get_attrs() {
        return $this->attrs;
    }
    
    
    /**
     * @return array|json
     * 
     * @since 2.2.7
     */
    public function get_props() {
       return $this->props; 
    }
    
    /**
     * @return array|json
     * 
     * @since 2.2.7
     */
    public function get_options() {
       return $this->options; 
    }
    
    /**
     * @return boolean
     * 
     * @since 2.2.7
     */
    public function get_active() {
       return $this->active; 
    }
}

?>