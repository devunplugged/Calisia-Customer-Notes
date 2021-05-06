<?php
namespace calisia_customer_notes;

class ajax{
    public static function delete_note(){
        global $wpdb;
        $result = $wpdb->update( $wpdb->prefix . 'calisia_customer_notes', array( 'deleted' => 1 ), array( 'id' => $_POST['id'] ), array( '%d' ), array( '%d' ) );
      /*  $result = $wpdb->delete(
            'wp_calisia_customer_notes', // table to delete from
            array(
                'id' => $_POST['id'] // value in column to target for deletion
            ),
            array(
                '%d' // format of value being targeted for deletion
            )
        );*/
        echo json_encode(array('result'=>$result, 'id'=>$_POST['id']));
        wp_die();
    }
}