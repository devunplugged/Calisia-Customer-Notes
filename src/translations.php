<?php
namespace calisia_customer_notes;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class translations{
    /**
     * Load plugin textdomain.
     */
    public static function load_textdomain() {
        load_plugin_textdomain( 'calisia-customer-notes', false, dirname( plugin_basename( __FILE__ ) ) . '/../languages' ); 
    }
}