<?php
namespace calisia_customer_notes;

class saver{
    public static function save_user_desc_from_order_page(){
        if($_POST['_calisia_user_desc'] == '')
            return;

        global $wpdb;
        global $post;
        $order = new \WC_Order($post->ID);
        $user_id = $order->get_customer_id();

        self::save_user_desc($user_id);
    }

    public static function save_user_desc($user_id){
        if($_POST['_calisia_user_desc'] == '')
            return;

        global $wpdb;
        $table_name = $wpdb->prefix . 'calisia_customer_notes';
        
        $wpdb->insert( 
            $table_name, 
            array( 
                'time' => current_time( 'mysql' ), 
                'text' => $_POST['_calisia_user_desc'], 
                'user_id' => $user_id, 
                'added_by' => get_current_user_id(), 
                'deleted' => 0 
            ) 
        );
    }

    public static function save_extra_fields( $user_id ) {
        if ( empty( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'update-user_' . $user_id ) ) {
            return;
        }
        
        if ( !current_user_can( 'edit_user', $user_id ) ) { 
            return false; 
        }
        
     //   update_user_meta( $user_id, '_calisia_user_desc', $_POST['_calisia_user_desc'] );
        update_user_meta( $user_id, '_calisia_user_trait', $_POST['_calisia_user_trait'] );

    }

    public static function save_extra_fields_from_order_page(){
        global $post;
        $order = new \WC_Order($post->ID);
        $user_id = $order->get_customer_id();

        update_user_meta( $user_id, '_calisia_user_trait', $_POST['_calisia_user_trait'] );
    }
}