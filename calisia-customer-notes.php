<?php 
/**
 * Plugin Name: calisia-customer-notes
 * Author: Tomasz Boroń
 * Text Domain: calisia-customer-notes
 * Domain Path: /languages
 */
require_once __DIR__ . '/src/renderer.php';
require_once __DIR__ . '/src/install.php';
require_once __DIR__ . '/src/saver.php';
require_once __DIR__ . '/src/loader.php';
require_once __DIR__ . '/src/ajax.php';
require_once __DIR__ . '/src/data.php';
require_once __DIR__ . '/src/forms.php';
require_once __DIR__ . '/src/translations.php';
require_once __DIR__ . '/src/inputs.php';

//add form to user profile page
//add_action( 'show_user_profile', array($calisia_customer_notes, 'add_customer_notes_form'), 20); //when editing own profile
add_action( 'edit_user_profile', 'calisia_customer_notes\forms::add_customer_notes_form', 20); //when editing profiles of other users

//saving data
add_action( 'personal_options_update', 'calisia_customer_notes\saver::save_extra_fields' );
add_action( 'personal_options_update', 'calisia_customer_notes\saver::save_user_desc' );
add_action( 'edit_user_profile_update', 'calisia_customer_notes\saver::save_extra_fields' );
add_action( 'edit_user_profile_update', 'calisia_customer_notes\saver::save_user_desc' );
add_action( 'woocommerce_saved_order_items', 'calisia_customer_notes\saver::save_extra_fields_from_order_page' );
add_action( 'woocommerce_saved_order_items', 'calisia_customer_notes\saver::save_user_desc_from_order_page' );

//display after billing address in order edit
add_action( 'woocommerce_admin_order_data_after_billing_address', 'calisia_customer_notes\renderer::render_user_trait' );

//add metabox
add_action( 'add_meta_boxes', 'calisia_customer_notes\forms::add_meta_boxes' );

//check if update is necessary
add_action( 'plugins_loaded', 'calisia_customer_notes\install::update_check' );

//load css and js files in backend (admin)
add_action('admin_enqueue_scripts', 'calisia_customer_notes\loader::load_css');
add_action('admin_enqueue_scripts', 'calisia_customer_notes\loader::load_js' );

//ajax endpoint (delete note)
add_action( "wp_ajax_calisia_delete_user_note", 'calisia_customer_notes\ajax::delete_note' ); //ajax call endpoint

//load plugin textdomain
add_action( 'init', 'calisia_customer_notes\translations::load_textdomain' );