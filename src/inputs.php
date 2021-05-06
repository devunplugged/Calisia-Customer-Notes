<?php
namespace calisia_customer_notes;

class inputs{
    public static function select($options, $output = false){
        $select = '<label>'.$options['label'].'</label>';
        $select .= '<select id="'.$options['id'].'" name="'.$options['id'].'" class="'.$options['class'].'">';
        foreach($options['options'] as $option_key => $option_value){
            $select .= '<option value="'.$option_key.'" ';
            if($options['value'] == $option_key)
                $select .= "selected";
            $select .= '>'.$option_value.'</option>';
        }
        $select .= '</select>';

        if(!$output)
            return $select;

        echo $select;
    }

    public static function textarea($options, $output = false){
        $ta = '<label>'.$options['label'].'</label>';
        $ta .= '<textarea placeholder="'.$options['placeholder'].'" id="'.$options['id'].'" name="'.$options['id'].'" class="'.$options['class'].'">';
        $ta .= $options['value'];
        $ta .= '</textarea>';

        if(!$output)
            return $ta;

        echo $ta;
    }
   /* 
   
   array(
            'id'          => '_calisia_user_desc',
            'label'       => __( 'Add comment:', 'calisia-customer-notes' ) . '<br>',
            'placeholder' => __( 'Your Comment', 'calisia-customer-notes' ),
            //'desc_tip'    => true,
            //'description' => __( "Wprowadź kod półki na której znajduje się produkt.", "woocommerce" ),
            'value' => ''
        );
   
   
   
   array(
        'id'      => '_calisia_user_trait',
        'label'   => __( 'Customer is:', 'calisia-customer-notes' ) . '<br>',
        'options' => array(
            'neutral'   => __( 'Neutral', 'calisia-customer-notes' ),
            'positive'   => __( 'Good', 'calisia-customer-notes' ),
            'negative' => __( 'Bad', 'calisia-customer-notes' )
        ),
        'value' => get_user_meta( $user_id, '_calisia_user_trait', true )
    );*/
}