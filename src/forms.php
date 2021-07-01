<?php
namespace calisia_customer_notes;

if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

class forms{
    public static function add_meta_boxes(){
        add_meta_box( 'calisia-customer-notes', __('Notes: Customer','calisia-customer-notes'), 'calisia_customer_notes\forms::metabox_form', 'shop_order', 'side', 'core' );
    }

    public static function add_customer_notes_form($user){
        ob_start();
        self::customer_notes_form($user->ID);
        $customer_form = ob_get_contents();
        ob_end_clean();
        renderer::render_customer_form_table($customer_form);
    }

    public static function metabox_form(){
        global $post;
        $order = new \WC_Order($post->ID);
        $user_id = $order->get_customer_id();
        
        self::customer_notes_form($user_id);
    }

    public static function customer_notes_form($user_id){
        //$user = get_user_by( 'id', $user_id );
        $notes = data::get_customer_notes($user_id);
        $nonce = wp_create_nonce( 'calisia_delete_user_note_' . $user_id );
        renderer::render_customer_form($user_id, $notes, $nonce);
    }
}