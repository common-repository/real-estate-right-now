<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if (!defined('WPINC')) {
    die;
}
function realestaterightnow_remove_add_new_menu() {
    remove_submenu_page('edit.php?post_type=realestatefields','post-new.php?post_type=realestatefields');
}
add_action('admin_menu','realestaterightnow_remove_add_new_menu');
function realestaterightnow_load()
{
    wp_enqueue_script('realestaterightnow_edit_fields', REALESTATERIGHTNOWURL .
        'includes/multi/multi.js', array('jquery'));
    wp_enqueue_style('pluginStyleGeneral6', REALESTATERIGHTNOWURL .
        'includes/multi/multi.css');
    // Javascript constants
    wp_localize_script('realestaterightnow_edit_fields', 'realestaterightnow_plugins', array(
    'realestatepluginsUrl' => plugins_url(),)); 
    wp_localize_script('realestaterightnow_edit_fields', 'realestaterightnow_images', array(
    'realestateimagesUrl' => REALESTATERIGHTNOWIMAGES,));   
    wp_localize_script('realestaterightnow_edit_fields', 'realestaterightnow_plugin', array(
    'realestateUrl' => REALESTATERIGHTNOWURL,));        
    $url = trailingslashit(plugin_dir_url(__file__));

/*
    wp_localize_script('my-wp-ajax-noob-john-cena-script', 'real-estate-right-now', admin_url
        ('admin-ajax.php'));
        */

        $local_arr = array(
            'ajaxurl'   => admin_url( 'admin-ajax.php' ),
            'realestatesecurity'  => wp_create_nonce( 'realestaterightnow_cfield' )
        );
        // Assign that data to our script as an JS object
        wp_localize_script( 'realestaterightnow_edit_fields', 'realestatenonceObj', $local_arr );
 


    wp_enqueue_style('bill-jquery-help');
    // Create any data in PHP that we may need to use in our JS file
    $local_arr = array(
        'ajaxurl'   => admin_url( 'admin-ajax.php' ),
        'realestatesecurity'  => wp_create_nonce( 'realestaterightnow_cfield' )
    );
    // Assign that data to our script as an JS object
    wp_localize_script( 'realestaterightnow_edit_fields', 'realestatenonceObj', $local_arr );
    // Enqueue our script
    wp_enqueue_script( 'realestaterightnow_edit_fields' );   
}
add_action('wp_loaded', 'realestaterightnow_load');
/* 3. AJAX CALLBACK
------------------------------------------ */
/* AJAX action callback */
add_action('wp_ajax_md_get_post_database', 'realestaterightnow_dbase_get_callback');
//add_action( 'wp_ajax_nopriv_john_cena', 'my_wp_ajax_noob_john_cena_ajax_callback' );
add_action('wp_ajax_md_save_post_database', 'realestaterightnow_dbase_save_callback');
/**
 * Ajax Callback
 */
function realestaterightnow_dbase_get_callback()
{
    // check_ajax_referer( 'realestaterightnow_cfield'); // , 'security', false );
     $nonce = sanitize_text_field($_POST["realestatesecurity"]);
    // $nonce1 = wp_create_nonce('realestaterightnow_cfield');
    if ( !wp_verify_nonce( $nonce, 'realestaterightnow_cfield' ) ) {
       die('Nonce Fail (-1).');
    }

      //  die('test');
    // if(trim($nonce) != trim($nonce1))
    //   wp_die('fail');



     $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',  
        'field-order',
        'field-name');
    // +1 post title (name))
    $field_value = array(
        'field_label',
        'field_typefield',
        'field_drop_options',
        'field_searchbar',
        'field_searchwidget',
        'field_rangemin',
        'field_rangemax',
        'field_rangestep',
        'field_slidemin',
        'field_slidemax',
        'field_slidestep',
        'field_order',
        'field_name');
    // +1 post title (name))    
    $tot = count($fields);
    $post_id = sanitize_text_field($_POST["postid"]);
    for ($i = 0; $i < $tot; $i++) {
        $field_value[$i] = esc_attr(get_post_meta($post_id, $fields[$i], true));
      //  mail('sergiominozzi@gmail.com', 'My Subject', $field_value[$i]);
      //  die('test');
    }
    $field_value[$tot-1] = esc_attr(get_the_title($post_id));
    wp_die(json_encode($field_value));
}
function realestaterightnow_dbase_save_callback()
{
    //    check_ajax_referer( 'realestaterightnow_cform'); // , 'security', false );
     /*
     $nonce = sanitize_text_field($_POST["realestatesecurity"]);
     $nonce1 = wp_create_nonce('realestaterightnow_cfield');
     if(trim($nonce) != trim($nonce1))
       wp_die('fail');
    */

    if (!isset($_POST["realestatesecurity"]) || !wp_verify_nonce(sanitize_text_field($_POST["realestatesecurity"]), 'realestaterightnow_cfield')) {
        wp_die('Nonce fail');
    }

    $fields = array(
        'field-label',
        'field-typefield',
        'field-drop_options',
        'field-searchbar',
        'field-searchwidget',
        'field-rangemin',
        'field-rangemax',
        'field-rangestep',
        'field-slidemin',
        'field-slidemax',
        'field-slidestep',
        'field-order',        
        'field-name');
    $fieldsv = array(
        sanitize_text_field($_POST['field_label']),
        sanitize_text_field($_POST['field_typefield']),
        sanitize_textarea_field($_POST['field_drop_options']),
        sanitize_text_field($_POST['field_searchbar']),
        sanitize_text_field($_POST['field_searchwidget']),
        sanitize_text_field($_POST['field_rangemin']),
        sanitize_text_field($_POST['field_rangemax']),
        sanitize_text_field($_POST['field_rangestep']),
        sanitize_text_field($_POST['field_slidemin']),
        sanitize_text_field($_POST['field_slidemax']),
        sanitize_text_field($_POST['field_slidestep']),  
        sanitize_text_field($_POST['field_order']),
        sanitize_text_field($_POST['field_name']));
    $tot = count($fields);
    $post_id = sanitize_text_field($_POST['postid']);
    if( empty($post_id))
      {
        $mypost = array(
        'post_title'   => sanitize_text_field( $_POST['field_name']),
        'post_type' => 'realestatefields',
        'post_status'   => 'publish',
        );
        $post_id = sanitize_text_field(wp_insert_post( $mypost));
      }
    else
    {
          $mypost = array(
              'ID'           => $post_id,
              'post_type' => 'realestatefields',
              'post_status'   => 'publish',
              'post_title'   => sanitize_text_field($_POST['field_name']),
          );
          wp_update_post( $mypost );        
    }  
    for ($i = 0; $i < ($tot)-1; $i++) {
            $meta_key = $fields[$i] ;
            $meta_value =  trim($fieldsv[$i]) ;
            update_post_meta( $post_id, $meta_key, $meta_value ); 
    }
    wp_die('ok'); 
} 
?>