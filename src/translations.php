<?php
namespace calisia_customer_notes;

class translations{
    /**
     * Load plugin textdomain.
     */
    public static function load_textdomain() {
        load_plugin_textdomain( 'calisia-customer-notes', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages' ); 
    }
}