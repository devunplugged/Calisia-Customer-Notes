<?php
namespace calisia_customer_notes;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class shortcodes{
    public static function add_shortcode(){
        add_shortcode( 'calisia_customer_notes', 'calisia_customer_notes\shortcodes::show_notes' );
        add_shortcode( 'calisia_customer_trait', 'calisia_customer_notes\shortcodes::show_user_trait' );
    }

    public static function show_notes($atts){
        extract(
            shortcode_atts(
                array(
                    'user_id' => 0,
                ),
                $atts
            )
        );

        if($user_id === 0)
            return "error";

        $notes = data::get_customer_notes($user_id);
        $nonce = wp_create_nonce( 'calisia_delete_user_note_' . $user_id );

        ob_start();
        renderer::render(
            'user-notes',
            array(
                'notes' => $notes,
                'nonce' => $nonce,
                'user_id' => $user_id
            )
        );
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }

    public static function show_user_trait($atts){
        extract(
            shortcode_atts(
                array(
                    'user_id' => 0,
                ),
                $atts
            )
        );

        if($user_id === 0)
            return "error";


        return data::get_trait_name( get_user_meta( $user_id, '_calisia_user_trait', true))['name'];
    }
}