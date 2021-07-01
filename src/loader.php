<?php
namespace calisia_customer_notes;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class loader{
    public static function load_css(){
        wp_enqueue_style('calisia_customer_notes_css', plugins_url('../css/calisia_customer_notes.css',__FILE__ ));
    }

    public static function load_js(){
        wp_enqueue_script('calisia_customer_notes_js', plugins_url('../js/calisia_customer_notes.js',__FILE__ ));
    }
}