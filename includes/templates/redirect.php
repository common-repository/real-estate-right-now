<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action("template_redirect", 'realestaterightnow_template_redirect');
function realestaterightnow_template_redirect()
{
    global $wp;
    //global $query;
    global $wp_query;

    //debug();
    //debug2();


    if (isset($_GET['realestaterightnow_search_type'])) {
        
   
        
        
        $realestaterightnow_search_type = sanitize_text_field($_GET['realestaterightnow_search_type']);
 
        
       //debug2($realestaterightnow_search_type);



   //          require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom3.php');


            $realestaterightnow_template_gallery = trim(get_option('realestaterightnow_template_gallery',
                'no'));

    

               // die($realestaterightnow_template_gallery);
/*
            if ($realestaterightnow_template_gallery == 'yes')
               require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom2.php');
            elseif($realestaterightnow_template_gallery == 'list')
               require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom3.php');
            else{
                debug($realestaterightnow_template_gallery);
               require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom1.php');
            }
*/

            // debug($realestaterightnow_template_gallery);

            if ($realestaterightnow_template_gallery == 'yes') {
                //debug2();
              require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom2.php');
                // elseif($realestaterightnow_template_gallery == 'grid')
                //    require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom1.php');
                    }
           else{
               //debug2();
               require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom3.php');

           }
            
            die();        
        
        
    }
   if (is_single()) {
        $realestateurl = esc_url(sanitize_text_field($_SERVER['REQUEST_URI']));
        if (strpos($realestateurl, '/product/') === false)
            return;
        if (isset($wp->query_vars["post_type"])) {
            if ($wp->query_vars["post_type"] == "products") {
                if (have_posts()) {
                    include (REALESTATERIGHTNOWPATH . 'includes/templates/template-single.php');
                    die();
                }
            }
        }
    }
}