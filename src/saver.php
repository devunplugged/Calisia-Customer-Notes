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
        
        $wpdb->insert( 
            $wpdb->prefix . 'calisia_customer_notes', 
            array( 
                'time' => current_time( 'mysql' ), 
                'text' => $_POST['_calisia_user_desc'], 
                'user_id' => $user_id, 
                'added_by' => get_current_user_id(), 
                'deleted' => 0 
            ) 
        );
    }

    public static function save_trait_changed_note($current_trait,$new_trait,$user_id){
        global $wpdb;

        $wpdb->insert( 
            $wpdb->prefix . 'calisia_customer_notes', 
            array( 
                'time' => current_time( 'mysql' ), 
                'text' => sprintf(
                                    /* translators: 1: Name of a city 2: ZIP code */
                                    __( 'User trait changed from %1$s to %2$s.', 'calisia-customer-notes' ),
                                    data::get_trait_name($current_trait)['name'],
                                    data::get_trait_name($new_trait)['name']
                                ), 
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

        self::save_user_trait($user_id, '_calisia_user_trait', $_POST['_calisia_user_trait']);
    }

    public static function save_extra_fields_from_order_page(){
        global $post;
        $order = new \WC_Order($post->ID);
        $user_id = $order->get_customer_id();

        self::save_user_trait($user_id, '_calisia_user_trait', $_POST['_calisia_user_trait']);
        //update_user_meta( $user_id, '_calisia_user_trait', $_POST['_calisia_user_trait'] );
    }

    public static function save_user_trait($user_id, $meta, $value){
        $current_user_trait = get_user_meta( $user_id, $meta, true) ;
        if($current_user_trait != $value)
            self::save_trait_changed_note($current_user_trait, $value, $user_id);

        update_user_meta( $user_id, $meta, $value );
    }
}