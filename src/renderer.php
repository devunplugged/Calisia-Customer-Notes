<?php
namespace calisia_customer_notes;

class renderer{
    public static function render($template, $args = array()){
        include  __DIR__ . '/../templates/'.$template.'.php';
    }

    public static function render_note_trait_select($user_id, $template){
        
        $client_trait_settings = array(
            'id'      => '_calisia_user_trait',
            'label'   => __( 'Customer is:<br>', 'calisia-customer-notes' ),
            'options' => array(
                'neutral'   => __( 'Neutral', 'calisia-customer-notes' ),
                'positive'   => __( 'Good', 'calisia-customer-notes' ),
                'negative' => __( 'Bad', 'calisia-customer-notes' )
            ),
            'value' => get_user_meta( $user_id, '_calisia_user_trait', true )
        );

        self::render($template, array("client_trait_settings"=>$client_trait_settings));
    }

    public static function render_note_textarea($user_id, $template){
        
        $client_desc_settings = array(
            'id'          => '_calisia_user_desc',
            'label'       => __( 'Add comment:<br>', 'calisia-customer-notes' ),
            'placeholder' => __( 'Your Comment', 'calisia-customer-notes' ),
            //'desc_tip'    => true,
            //'description' => __( "Wprowadź kod półki na której znajduje się produkt.", "woocommerce" ),
            'value' => ''
        );
        self::render($template, array("client_desc_settings"=>$client_desc_settings));
    }

    public static function render_customer_form($user_id, $notes, $user){
        self::render_note_trait_select($user_id, 'user-notes-trait-select');
        self::render(
            'user-notes',
            array(
                'notes' => $notes,
                'user' => $user
            )
        );
        self::render_note_textarea($user_id, 'user-notes-textarea');
    }

    public static function render_customer_form_table($customer_form){
        self::render(
            'user-form-table',
            array(
                'form' => $customer_form
            )
        );
    }

    public static function render_user_trait($order){
        require_once __DIR__ . '/data.php';

        //$trait = get_user_meta( $order->get_customer_id(), '_calisia_user_trait', true );
        self::render(
            'user-info',
            array(
                'trait' => data::get_trait_name( get_user_meta( $order->get_customer_id(), '_calisia_user_trait', true))
            )
        );
    }
}