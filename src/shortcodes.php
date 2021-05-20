<?php
namespace calisia_customer_notes;

class shortcodes{
    public static function add_shortcode(){
        add_shortcode( 'calisia_customer_notes', 'calisia_customer_notes\shortcodes::show_notes' );
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
}