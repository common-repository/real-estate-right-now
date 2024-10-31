<?php
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function realestaterightnow_right_now_add_custom_js_to_header() {
    ?>
    <script type="text/javascript">
        function realestaterightnow_goBack() {
            window.history.back(); 
        }
    </script>
    <?php
}
add_action('wp_head', 'realestaterightnow_right_now_add_custom_js_to_header');



$my_theme =  strtolower(wp_get_theme());
if ($my_theme == 'twenty fourteen')
{
?>
<style type="text/css">
<!--
	.site::before {
    width: 0px !important;
}
-->
</style>
<?php 
}
 get_header();
  ?>
	    <div id="container2"> 
         <?php 
        if(isset($_SERVER['HTTP_REFERER']))
         {?>
          <center>
          <button id="realestaterightnow_goback" onclick="realestaterightnow_goBack()">
          <?php 
          echo esc_attr__('Back', 'real-estate-right-now');?> 
          </button>
          <br /><br />
          </center>
        <?php } ?> 
        
 
             <?php realestaterightnow_profile(); ?>           
                                
            <div id="content2" role="main">
            
              

                     
            
            
            
            
				<?php realestaterightnow_detail();
               $realestaterightnow_enable_contact_form = trim(get_option('realestaterightnow_enable_contact_form', 'yes'));
               if ($realestaterightnow_enable_contact_form == 'yes')
               {               
                ?>
                 <br />
                 <center>
                 <button id="realestaterightnow_cform">
                 <?php echo esc_attr__('Contact Us', 'real-estate-right-now'); ?>
                 </button>
                 </center>
                 <br />
			</div> 
            <?php 
            } 
               if ($realestaterightnow_enable_contact_form == 'yes')               
                   include_once (REALESTATERIGHTNOWPATH . 'includes/contact-form/multi-contact-show-form.php');  
         ?>  
		</div>
<?php 
        $registered_sidebars = wp_get_sidebars_widgets();
        foreach( $registered_sidebars as $sidebar_name => $sidebar_widgets ) {
        	unregister_sidebar( $sidebar_name );
        }
get_footer(); 
?>