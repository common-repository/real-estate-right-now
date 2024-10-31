<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
 function realestaterightnow_get_max_beds()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-beds',
        'orderby' => 'meta_value_num',
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-beds', true);
        if (!empty($x)) {
            $x = (int)$x;
        }
        else
          $x = 10;
        if($x < 1)
          return '10';
        else
          return $x;
    }
}
 function realestaterightnow_get_max_baths()
{
    global $wpdb;
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-baths',
        'orderby' => 'meta_value_num',
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-baths', true);
        if (!empty($x)) {
            $x = (int)$x;
        }
        else
          $x = 10;
        if($x < 1)
          return '10';
        else
          return $x;
    }
}
function realestaterightnow_message_low_memory()
{
    echo '<div class="notice notice-warning">
                     <br />
                     <b>
                     Real Estate Plugin Warning: Your server running Low Memory !
                     <br />
                     Please, check 
                     <br />
                     Dashboard => Real Estate => (tab) Memory Checkup
                     <br /><br />
                     </b>
                     </div>';
}

function realestaterightnow_check_memory() {
    // global $memory;
    $memory["color"] = "font-weight:normal;";
    try {

        // PHP $memory["limit"]
        if(!function_exists('ini_get')){
            $memory["msg_type"] = "notok";
            return $memory;
        }
        else{
            $memory["limit"] = (int) ini_get("memory_limit");
        }

        if (!is_numeric($memory["limit"])) {
            $memory["msg_type"] = "notok";
            return $memory;
        } else {
            if ($memory["limit"] > 9999999) {
                $memory["limit"] =
                    $memory["limit"] / 1024 / 1024;
            }
        }


        // usage
        if(!function_exists('memory_get_usage')){
            $memory["msg_type"] = "notok";
            return $memory;
        }
        else{
            // $bill_install_memory["usage"] = round(memory_get_usage() / 1024 / 1024, 0);
            $memory["usage"] = (int) memory_get_usage();
        }


        if ($memory["usage"] < 1) {
            $memory["msg_type"] = "notok";
            return $memory;
        }
        else{
            $memory["usage"] = round($memory["usage"] / 1024 / 1024, 0);

        }

        if (!is_numeric($memory["usage"])) {
            $memory["msg_type"] = "notok";
            return $memory;
        }


        // WP
        if (!defined("WP_MEMORY_LIMIT")) {
            $memory['wp_limit'] = 40;
        } else {
            $memory['wp_limit'] = (int) WP_MEMORY_LIMIT;

        }		

        $memory["percent"] =
            $memory["usage"] / $memory["wp_limit"];
        $memory["color"] = "font-weight:normal;";
        if ($memory["percent"] > 0.7) {
            $memory["color"] = "font-weight:bold;color:#E66F00";
        }
        if ($memory["percent"] > 0.85) {
            $memory["color"] = "font-weight:bold;color:red";
        }
        $memory["msg_type"] = "ok";
        return $memory;
    } catch (Exception $e) {
        $memory["msg_type"] = "notok(7)";
        return $memory;
    }
}

Function realestaterightnow_check_memory_old()
{
      global $realestaterightnow_memory;
      $realestaterightnow_memory['limit'] = (int) ini_get('memory_limit') ;	
      $realestaterightnow_memory['usage'] = function_exists('memory_get_usage') ? round(memory_get_usage() / 1024 / 1024, 0) : 0;
      if(!defined("WP_MEMORY_LIMIT"))
      {
        $realestaterightnow_memory['msg_type'] = 'notok';  
        return;
      }
      $realestaterightnow_memory['wp_limit'] =  trim(WP_MEMORY_LIMIT) ;
    if ($realestaterightnow_memory['wp_limit'] > 9999999)
        $realestaterightnow_memory['wp_limit'] = ($realestaterightnow_memory['wp_limit'] / 1024) / 1024;
 
        if (!is_numeric($realestaterightnow_memory['usage'])) {
        $realestaterightnow_memory['msg_type'] = 'notok';  
        return;
    }
    
    if (!is_numeric($realestaterightnow_memory['limit'])) {
        $realestaterightnow_memory['msg_type'] = 'notok';  
        return;
    }
    if ($realestaterightnow_memory['usage'] < 1) {
        $realestaterightnow_memory['msg_type'] = 'notok';  
        return;
    }
  $wplimit = $realestaterightnow_memory['wp_limit'];  
  $wplimit = substr($wplimit,0,strlen($wplimit)-1);
  $realestaterightnow_memory['wp_limit'] = $wplimit;
  $realestaterightnow_memory['percent'] = $realestaterightnow_memory['usage'] / $realestaterightnow_memory['wp_limit'];
  $realestaterightnow_memory['color'] = 'font-weight:normal;';
  if ($realestaterightnow_memory['percent'] > .7) $realestaterightnow_memory['color'] = 'font-weight:bold;color:#E66F00';
  if ($realestaterightnow_memory['percent'] > .85) $realestaterightnow_memory['color'] = 'font-weight:bold;color:red';
  $realestaterightnow_memory['msg_type'] = 'ok';  
  return $realestaterightnow_memory;
}


Function realestaterightnow_reorder_terms()
{
     global $wpdb;   
     $args = array(
      'taxonomy' => 'agents',
      'hide_empty' => false,
     );
     $terms = get_terms($args); 
     $qagents = count($terms);
     $RealestateAgents = array();
     if ($qagents > 0)
     {
       $i = 0;
       foreach ( $terms as $term ) 
       {
              $id = $term->term_id;
              $termMeta = get_option( 'agents_' . $id );
              $RealestateAgents[$i]['name'] =  $term->name;
              $RealestateAgents[$i]['description'] =  $term->description;
              $RealestateAgents[$i]['image'] = $termMeta['image'];      
              $RealestateAgents[$i]['function'] = $termMeta['function'];
              $RealestateAgents[$i]['phone'] = $termMeta['phone'];
              $RealestateAgents[$i]['email'] = $termMeta['email'];
              $RealestateAgents[$i]['skype'] = $termMeta['skype'];
              $RealestateAgents[$i]['facebook'] = $termMeta['facebook'];
              $RealestateAgents[$i]['twitter'] = $termMeta['twitter'];
              $RealestateAgents[$i]['linkedin'] = $termMeta['linkedin'];
              $RealestateAgents[$i]['vimeo'] = $termMeta['vimeo'];
              $RealestateAgents[$i]['instagram'] = $termMeta['instagram'];
              $RealestateAgents[$i]['youtube'] = $termMeta['youtube'];         
              $RealestateAgents[$i]['myorder'] = $termMeta['myorder'];         
              $i ++;
       } 
        function realestaterightnow_cmp($a, $b)
        {
            return strcmp($a["myorder"], $b["myorder"]);
        }
        if ($i > 1)
          usort($RealestateAgents, "realestaterightnow_cmp");
    }
    Return $RealestateAgents;
}
add_action( 'wp_loaded', 'realestaterightnow_get_locations' );
function realestaterightnow_get_locations()
{
    global $wpdb;
    /* Properties */ 
    global $wp_query;
    $args = array( 'post_type' => 'products');    
    $wp_query2 = new WP_Query($args);   
    $have_locations = array();
    while ($wp_query2->have_posts())
    {
                 $wp_query2->the_post();
                 $terms3 = get_the_terms( get_the_id(), 'locations');
                 if(gettype($terms3) == 'array'){  
                    $term3 = $terms3[0]; 
                    if(is_object($term3))
                        {
                            $have_locations[] =  $term3->name; 
                        } 
                 }
   } 
   /* end Properties */ 
    $re_locations = array();  
    $args = array(
        'taxonomy'               => 'locations',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    foreach($the_query->get_terms() as $term){
       if( in_array($term->name, $have_locations ) )
       {
           $re_locations[] = $term->name;
       }
    }
 return $re_locations; 
}
function realestaterightnow_findglooglemap()
{
 global $wpdb;
        $argsfindfields = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields'
        );
        query_posts( $argsfindfields );
        $afields = array();
        $afieldsid = array();
        $realestaterightnow_Mapfield_name = '';
        while ( have_posts() ) : the_post();
            $post_id = esc_attr(get_the_ID());
            $realestaterightnow_Mapfield_name = get_the_title($post_id);
            $field_type = esc_attr(get_post_meta($post_id, 'field-typefield', true));
            if($field_type  == 'googlemap')
              {
                if (!empty ($realestaterightnow_Mapfield_name) )
                  return 'product-'.$realestaterightnow_Mapfield_name;
              }
           //   break;
        endwhile;
           return '';
}
function realestaterightnow_get_fields($type)
{
  global $wpdb;
   if(!function_exists('get_userdata()')) {
    include(ABSPATH . "/wp-includes/pluggable.php");
   }
    if ( $type == 'search')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
            array(
            'key' => 'field-searchbar',
            'value' => '1'
            )
        )
    );
    }
    elseif($type == 'all')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC'
        );
    }
    elseif ( $type == 'widget')
    {
    $args = array(
            'post_status' => 'publish',
            'post_type' => 'realestatefields',
            'meta_key' => 'field-order',
            'posts_per_page' => -1,
            'orderby' => 'meta_value_num',
            'order' => 'ASC',
            'meta_query' => array(
            array(
            'key' => 'field-searchwidget',
            'value' => '1'
            )
        )
    );
    }    
        query_posts( $args );
        $afields = array();
        $afieldsid = array();
        while ( have_posts() ) : the_post();
            $afieldsid[] = esc_attr(get_the_ID());
        endwhile;
        ob_start();
        if( isset($GLOBALS['wp_the_query']))        
          wp_reset_query();
        ob_end_clean();       
         return $afieldsid;  
} // end Funcrions
function realestaterightnow_get_meta($post_id)
{
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
    $tot = count($fields);
    for ($i = 0; $i < $tot; $i++) {
        $field_value[$i] = esc_attr(get_post_meta($post_id, $fields[$i], true));
    }
    $field_value[$tot-1] = esc_attr(get_the_title($post_id));
    return $field_value;
}
function realestaterightnow_get_types()
{
    global $wpdb;
    $productmake = array();  
    $args = array(
        'taxonomy'               => 'agents',
        'orderby'                => 'name',
        'order'                  => 'ASC',
        'hide_empty'             => false,
    );
    $the_query = new WP_Term_Query($args);
    $productmake = array();  
    foreach($the_query->get_terms() as $term){ 
       $productmake[] = $term->name;
    }
 return $productmake; 
}
add_action( 'wp_loaded', 'realestaterightnow_get_types' );
function realestaterightnow_currency2()
{
    if (get_option('RealEstatecurrency') == 'Dollar') {
        return "$";
    }
    if (get_option('RealEstatecurrency') == 'Pound') {
        return "&pound;";
    }
    if (get_option('RealEstatecurrency') == 'Yen') {
        return "&yen;";
    }
    if (get_option('RealEstatecurrency') == 'Euro') {
        return "&euro;";
    }
    if (get_option('RealEstatecurrency') == 'Universal') {
        return "&curren;";
    }
    if (get_option('RealEstatecurrency') == 'AUD') {
        return "AUD";
    }
    if (get_option('RealEstatecurrency') == 'Real') {
        return "R&#36;";
    }
     if (get_option('RealEstatecurrency') == 'Krone') {
        return "kr";
    }    
    if (get_option('RealEstatecurrency') == 'Forint') {
        return "Ft"; /* Ft or HUF is also perfect for me. */ 
    }  
// R (for ZAR) our currency - Afric Sul
    if (get_option('RealEstatecurrency') == 'Zar') {
        return "R"; /* Ft or HUF is also perfect for me. */ 
    } 
    if (get_option('RealEstatecurrency') == 'Swiss') {
        return "CHF "; 
    }
}
function realestaterightnow_currency()
{
    $currencies = array(
        'AED'  => __( 'United Arab Emirates Dirham (&#1583;.&#1573;)', 'real-estate-right-now' ),
        'AFN'  => __( 'Afghan Afghani (&#1547;)', 'real-estate-right-now' ),
        'AOA'  => __( 'Angolan Kwanza', 'real-estate-right-now' ),
        'ARS'  => __( 'Argentine Pesos (&#36;)', 'real-estate-right-now' ),
        'AUD'  => __( 'Australian Dollars (&#36;)', 'real-estate-right-now' ),
        'BRL'  => __( 'Brazilian Real (R&#36;)', 'real-estate-right-now' ),
        'BGN'  => __( 'Bulgarian Lev', 'real-estate-right-now' ),
        'CAD'  => __( 'Canadian Dollars (&#36;)', 'real-estate-right-now' ),
        'CHF'  => __( 'Swiss Franc', 'real-estate-right-now' ),
        'CNY'  => __( 'Chinese Yuan (&yen;)', 'real-estate-right-now' ),
        'CZK'  => __( 'Czech Koruna', 'real-estate-right-now' ),
        'DKK'  => __( 'Danish Krone', 'real-estate-right-now' ),
        'EUR'  => __( 'Euros (&euro;)', 'real-estate-right-now' ),
        'GBP'  => __( 'Pound Sterling (&pound;)', 'real-estate-right-now' ),
        'HKD'  => __( 'Hong Kong Dollar (&#36;)', 'real-estate-right-now' ),
        'HRK'  => __( 'Croatian Kuna', 'real-estate-right-now' ),
        'HUF'  => __( 'Hungarian Forint', 'real-estate-right-now' ),
        'IDR'  => __( 'Indonesian Rupiah (Rp)', 'real-estate-right-now' ),
        'ILS'  => __( 'Israeli Shekel (&#8362;)', 'real-estate-right-now' ),
        'INR'  => __( 'Indian Rupee (&#8377;)', 'real-estate-right-now' ),
        'JPY'  => __( 'Japanese Yen (&yen;)', 'real-estate-right-now' ),
        'KRW'  => __( 'South Korean Won (&#8361;)', 'real-estate-right-now' ),
        'MXN'  => __( 'Mexican Peso (&#36;)', 'real-estate-right-now' ),
        'MYR'  => __( 'Malaysian Ringgits', 'real-estate-right-now' ),
        'NOK'  => __( 'Norwegian Krone', 'real-estate-right-now' ),
        'NZD'  => __( 'New Zealand Dollar (&#36;)', 'real-estate-right-now' ),
        'PHP'  => __( 'Philippine Pesos', 'real-estate-right-now' ),
        'PLN'  => __( 'Polish Zloty', 'real-estate-right-now' ),
        'PKR'  => __( 'Pakistani Rupee (₨)', 'real-estate-right-now' ),
        'RON'  => __( 'Romanian Leu', 'real-estate-right-now' ),
        'RUB'  => __( 'Russian Rubles', 'real-estate-right-now' ),
        'SAR'  => __( 'Saudi Riyal (&#65020;)', 'real-estate-right-now' ),
        'SEK'  => __( 'Swedish Krona', 'real-estate-right-now' ),
        'SGD'  => __( 'Singapore Dollar (&#36;)', 'real-estate-right-now' ),
        'THB'  => __( 'Thai Baht (&#3647;)', 'real-estate-right-now' ),
        'TRY'  => __( 'Turkish Lira (&#8378;)', 'real-estate-right-now' ),
        'TWD'  => __( 'Taiwan New Dollars', 'real-estate-right-now' ),
        'USD'  => __( 'US Dollars (&#36;)', 'real-estate-right-now' ),
        'VND'  => __( 'Vietnamese Dong (&#8363;)', 'real-estate-right-now' ),
        'YEN'  => __( 'Yen (&yen;)', 'real-estate-right-now' ),
        'ZAR'  => __( 'South African Rand', 'real-estate-right-now' ),
    );



    $currency =  get_option('RealEstatecurrency');

    if(!function_exists('realestaterightnow_get_currency_symbol')){
        function realestaterightnow_get_currency_symbol($currency) {
            $currencies = array(
                'AED'  => '&#1583;.&#1573;',
                'AFN'  => '&#1547;',
                'AOA'  => 'Kz',
                'ARS'  => '&#36;',
                'AUD'  => '&#36;',
                'BRL'  => 'R&#36;',
                'BGN'  => 'лв',
                'CAD'  => '&#36;',
                'CHF'  => 'CHF',
                'CNY'  => '&yen;',
                'CZK'  => 'Kč',
                'DKK'  => 'kr',
                'EUR'  => '&euro;',
                'GBP'  => '&pound;',
                'HKD'  => '&#36;',
                'HRK'  => 'kn',
                'HUF'  => 'Ft',
                'IDR'  => 'Rp',
                'ILS'  => '&#8362;',
                'INR'  => '&#8377;',
                'JPY'  => '&yen;',
                'KRW'  => '&#8361;',
                'MXN'  => '&#36;',
                'MYR'  => 'RM',
                'NOK'  => 'kr',
                'NZD'  => '&#36;',
                'PHP'  => '&#8369;',
                'PLN'  => 'zł',
                'PKR'  => '₨',
                'RON'  => 'lei',
                'RUB'  => '&#8381;',
                'SAR'  => '&#65020;',
                'SEK'  => 'kr',
                'SGD'  => '&#36;',
                'THB'  => '&#3647;',
                'TRY'  => '&#8378;',
                'TWD'  => 'NT$',
                'USD'  => '&#36;',
                'VND'  => '&#8363;',
                'ZAR'  => 'R',
                // Adicione outros símbolos de moeda conforme necessário
            );
        
            // Verifique se a moeda está na array e retorne o símbolo correspondente
            if (array_key_exists($currency, $currencies)) {
                return $currencies[$currency];
            } else {
                return '&curren;'; // Retorna vazio se a moeda não estiver na array
            }
        }
    }

   
}

function realestaterightnow_get_max($realestaterightnow_meta_purpose)
{
    global $wpdb;
    if( empty($realestaterightnow_meta_purpose))
    {
       if(isset($_GET['meta_purpose'])) 
         $purpose = sanitize_text_field($_GET['meta_purpose']);          
    }
    else
       $purpose = $realestaterightnow_meta_purpose;
    //echo 'mmpp: '.$purpose;
    if(isset($purpose)) 
      {
         // $purpose = sanitize_text_field($_GET['meta_purpose']);          
         // $purpose = __($purpose, 'real-estate-right-now');
          if(!empty($purpose))
            $afilter[] = array('key' => 'product-purpose', 'value' => $purpose);
          else
           $afilter[] = array('key' => 'product-purpose', 'value' => 'Rent');
        //     $afilter[] = array('key' => 'product-purpose', 'value' => __('Rent', 'real-estate-right-now'));
      }
    else
       $afilter[] = array('key' => 'product-purpose', 'value' => 'Rent');
        //  $afilter[] = array('key' => 'product-purpose', 'value' => __('Rent', 'real-estate-right-now'));
    $args = array(
        'numberposts' => 1,
        'post_type' => 'products',
        'meta_key' => 'product-price',
        'orderby' => 'meta_value_num',
        'meta_query' => $afilter,
        'order' => 'DESC');
    $posts = get_posts($args);
    foreach ($posts as $post) {
        $x = get_post_meta($post->ID, 'product-price', true);
        if (!empty($x)) {
            $x = (int)$x;
            if (is_int($x)) {
                $x = ($x) * 1.2;
                $x = round($x, 0, PHP_ROUND_HALF_EVEN);
                //return $x;
            }
        }
        if($x < 1)
          return '100000';
        else
          return $x;
    }
}
function realestaterightnow_localization_init_fail()
{
    echo '<div class="error notice">
                     <br />
                     realestatePlugin: Could not load the localization file (Language file).
                     <br />
                     Please, take a look the online Guide item Plugin Setup => Language.
                     <br /><br />
                     </div>';
}
function realestaterightnow_Show_Notices1()
            {
                    echo '<div class="update-nag notice"><br />';
                    echo 'Warning: Upload directory not found (RealEstate Plugin). Enable debug for more info.';
                    echo '<br /><br /></div>';
            }
function realestaterightnow_plugin_was_activated()
{
                echo '<div class="updated"><p>';
                $bd_msg = '<img src="'.REALESTATERIGHTNOWURL.'assets/images/infox350.png" />';
                $bd_msg .= '<h2>RealEstate Plugin was activated! </h2>';
                $bd_msg .= '<h3>For details and help, take a look at Real Estate Dashboard at your left menu <br />';
                $bd_url = '  <a class="button button-primary" href="admin.php?page=real_estate_plugin">or click here</a>';
                $bd_msg .=  $bd_url;


                $realestaterightnow_allowed_atts = array(
                    'align'      => array(),
                    'class'      => array(),
                    'type'       => array(),
                    'id'         => array(),
                    'dir'        => array(),
                    'lang'       => array(),
                    'style'      => array(),
                    'xml:lang'   => array(),
                    'src'        => array(),
                    'alt'        => array(),
                    'href'       => array(),
                    'rel'        => array(),
                    'rev'        => array(),
                    'target'     => array(),
                    'novalidate' => array(),
                    'type'       => array(),
                    'value'      => array(),
                    'name'       => array(),
                    'tabindex'   => array(),
                    'action'     => array(),
                    'method'     => array(),
                    'for'        => array(),
                    'width'      => array(),
                    'height'     => array(),
                    'data'       => array(),
                    'title'      => array(),
                
                    'checked' => array(),
                    'selected' => array(),
                
                
                );
                
                
                
                
                $realestaterightnow_my_allowed['form'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['select'] = $realestaterightnow_allowed_atts ;
                // select options
                $realestaterightnow_my_allowed['option'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['style'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['label'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['input'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
                
                //more...future...
                $realestaterightnow_my_allowed['form']     = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['label']    = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['input']    = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['textarea'] = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['iframe']   = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['script']   = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['style']    = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['strong']   = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['small']    = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['table']    = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['span']     = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['abbr']     = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['code']     = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['pre']      = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['div']      = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['img']      = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h1']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h2']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h3']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h4']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h5']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['h6']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['ol']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['ul']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['li']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['em']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['hr']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['br']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['tr']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['td']       = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['p']        = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['a']        = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['b']        = $realestaterightnow_allowed_atts ;
                $realestaterightnow_my_allowed['i']        = $realestaterightnow_allowed_atts ;
                 
                
                echo wp_kses($bd_msg, $realestaterightnow_my_allowed);
                
                //echo $bd_msg;


                echo "</p></h3></div>";
     $realestaterightnow_installed = trim(get_option( 'realestaterightnow_installed',''));
     if(empty($realestaterightnow_installed)){
        add_option( 'realestaterightnow_installed', time() );
        update_option( 'realestaterightnow_installed', time() );
     }
} 
if( is_admin())
{
   if(get_option('realestaterightnow_activated', '0') == '1')
   {
     add_action( 'admin_notices', 'realestaterightnow_plugin_was_activated' );
     $r =  update_option('realestaterightnow_activated', '0'); 
     if ( ! $r )
        add_option('realestaterightnow_activated', '0');
   }
} 
if (!function_exists('realestaterightnow_write_log')) {
    function realestaterightnow_write_log ( $log )  {
        if ( true === WP_DEBUG ) {
            if ( is_array( $log ) || is_object( $log ) ) {
                error_log( print_r( $log, true ) );
            } else {
                error_log( $log );
            }
        }
    }
}
add_filter( 'plugin_row_meta', 'realestaterightnow_custom_plugin_row_meta', 10, 2 );
function realestaterightnow_custom_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'realestate.php' ) !== false ) {
		$new_links = array(
				'OnLine Guide' => '<a href="http://realestateplugin.eu/guide/" target="_blank">OnLine Guide</a>',
                                'Pro' => '<a href="http://realestateplugin.eu/premium/" target="_blank"><b><font color="#FF6600">Go Pro</font></b></a>'
				);
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
function realestaterightnow_get_page()
{
  $page = 1;
  $url = esc_url(sanitize_text_field($_SERVER['REQUEST_URI']));
  $pieces = explode("/", $url);
  for ($i=0; $i < count($pieces); $i++)
  {
    if ($pieces[$i] == 'page' and ($i+1) <  count($pieces))
      {
          $page = $pieces[$i+1];
          if(is_numeric($page))
             return $page;
      }
  }
  return $page;
}
function realestaterightnow_wrong_permalink()
{
    echo '<div class="notice notice-warning">
                     <br />
                     Real Estate Plugin: Wrong Permalink settings !
                     <br />
                     Please, fix it to avoid 404 error page.
                     <br />
                     To correct, just follow this steps:
                     <br />
                     Dashboard => Settings => Permalinks => Post Name (check)
                     <br />  
                     Click Save Changes
                     <br /><br />
                     </div>';
}
$realestateurl = esc_url(sanitize_text_field($_SERVER['REQUEST_URI']));
if (strpos($realestateurl, '/options-permalink.php') === false)
{            
  $permalinkopt  = get_option('permalink_structure');
  if($permalinkopt != '/%postname%/')
    add_action( 'admin_notices', 'realestaterightnow_wrong_permalink' );
}
/////////////
function realestaterightnow_ask_for_upgrade()
 { 
    $x = rand(0,4);
    if ($x == 0)
    {
       $banner_image = REALESTATERIGHTNOWIMAGES.'/introductory.png';
       $bill_banner_bkg_color = 'turquoise';
       $banner_txt = __( 'Extend standard plugin functionality with new great options.', 'real-estate-right-now'); 
    }
    elseif ($x == 1)
    {
       $banner_image = REALESTATERIGHTNOWIMAGES.'/lion.jpg';  
       $bill_banner_bkg_color = 'turquoise';
       $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }
       elseif ($x == 2)
     {
       $banner_image = REALESTATERIGHTNOWIMAGES.'/apple.jpg';
       $bill_banner_bkg_color = 'orange';
       $banner_txt = __( 'Add colors and extend standard plugin functionality with new great options.', 'real-estate-right-now'); 
    } 
       elseif ($x == 3)
    {
       $banner_image = REALESTATERIGHTNOWIMAGES.'/racing.jpg';
       $bill_banner_bkg_color = 'orange';
      $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }     
    else
    {
       $banner_image = REALESTATERIGHTNOWIMAGES.'/keys_from_left.png';
       $bill_banner_bkg_color = 'orange';
       $banner_txt = __( 'Make Your Website Look More Professional.', 'real-estate-right-now'); 
    }
   $banner_tit = __( 'It is time to upgrade your', 'real-estate-right-now');
    echo '<script type="text/javascript" src="' . esc_url(REALESTATERIGHTNOWURL) .
            'assets/js/c_o_o_k_i_e.js' . '"></script>';
    ?>
	<script type="text/javascript">
        jQuery(document).ready(function() {
        	var hide_message = jQuery.cookie('realestaterightnow');
/*   hide_message = false;  */
        	if (hide_message == "true") {
        		jQuery(".bill_go_pro_container").css("display", "none");
        	} else {
                 setTimeout( function(){ 
                   jQuery(".bill_go_pro_container").slideDown("slow");
                  }  , 2000 );
        	};
        	jQuery(".bill_go_pro_close_icon").click(function() {
        		jQuery(".bill_go_pro_message").css("display", "none");
        		jQuery.cookie("realestaterightnow", "true", {
        			expires: 7
        		});
        		jQuery(".bill_go_pro_container").css("display", "none");
        	});
        	jQuery(".bill_go_pro_dismiss").click(function(event) {
        		jQuery(".bill_go_pro_message").css("display", "none");
        		jQuery.cookie("realestaterightnow", "true", {
        			expires: 7
        		});
        		event.preventDefault()
        		jQuery(".bill_go_pro_container").css("display", "none");
        	});
        }); // end (jQuery);
	</script>
    <style type="text/css">
            .bill_go_pro_close_icon {
            width:31px;
            height:31px;
            border: 0px solid red;
            /* background: url("http://xxxxxx.com/wp-content/plugins/realestate/assets/images/close_banner.png") no-repeat center center; */
            box-shadow:none;
            float:right;
            margin:8px;
            margin:60px 40px 8px 8px;
            }
            .bill_hide_settings_notice:hover,.bill_hide_premium_options:hover {
            cursor:pointer;
            }
            .bill_hide_premium_options {
            position:relative;
            }
            .bill_go_pro_image {
            float:left;
            margin-right:20px;
            max-height:90px !important;
            }
            .bill_image_go_pro {
            max-width:200px;
            max-height:88px;
            }
            .bill_go_pro_text {
            font-size:18px;
            padding:10px;
            }
            .bill_go_pro_button_primary_container {
            float:left;
            margin-top: 0px;
            }
            .bill_go_pro_dismiss_container
            {
              margin-top: 0px;
            }
            .bill_go_pro_buttons {
              display: flex;
              max-height: 30px;
              margin-top: -10px;
            }        
            .bill_go_pro_container {
                border:1px solid darkgray;
                height:88px;
                padding: 0; 
                margin: 0; 
                background: <?php echo esc_attr($bill_banner_bkg_color); ?>
            }
            .bill_go_pro_dismiss {
              margin-left:15px !important;
            }
             .button {
                vertical-align: top;
            }           
            @media screen and (max-width:900px) {
                .bill_go_pro_text {
                  font-size:16px;
                  padding:5px;
                  margin-bottom: 10px;
                }
            }
            @media screen and (max-width:800px) {
                .bill_go_pro_container {
                  display:none !important;
                }
            }
	</style>
    <div class="notice notice-success bill_go_pro_container" style="display: none;">
    	<div class="bill_go_pro_message bill_banner_on_plugin_page bill_go_pro_banner">
    		<button class="bill_go_pro_close_icon close_icon notice-dismiss bill_hide_settings_notice" title="<?php esc_attr_e('Close notice',
    		'real-estate-right-now'); ?>">
    		</button>
    		<div class="bill_go_pro_image">
    			<img class="bill_image_go_pro" title="" src="<?php echo esc_attr($banner_image);?>" alt="" />
    		</div>
    		<div class="bill_go_pro_text">
    			<?php echo esc_attr($banner_tit);?>
    				<strong>
    					Real Estate Plugin
    				</strong>
    				<?php esc_attr_e( 'to', 'real-estate-right-now'); ?>
    					<strong>
    						Pro
    					</strong>
    					<?php esc_attr_e( 'version!', 'real-estate-right-now'); ?>
    						<br />
    						<span>
    							<?php echo esc_attr($banner_txt);?>
             				</span>
    		</div>
            <div class="bill_go_pro_buttons">
        		<div class="bill_go_pro_button_primary_container">
        			<a class="button button-primary" target="_blank" href="http://realestateplugin.eu/premium/"><?php esc_attr_e('Learn More',
        			'real-estate-right-now'); ?></a>
        		</div>
        		<div class="bill_go_pro_dismiss_container">
        			<a class="button button-secondary bill_go_pro_dismiss" target="_blank" href="http://realestateplugin.eu/premium/"><?php esc_attr_e('Dismiss',
        			'real-estate-right-now'); ?></a>
        		</div>
            </div>
    	</div>
    </div>
<?php               
 } // end Bill ask for upgrade 
 $when_installed = get_option('bill_installed');
 $now = time();
 $delta = $now - $when_installed;

 if ($delta > (3600 * 24 * 8))
 {
    $realestateurl = esc_url(sanitize_text_field($_SERVER['REQUEST_URI']));
  //  if (strpos($realestateurl, 'post_type=products') !== false or strpos($realestateurl, 'post_type=realestatefields') !== false )
    if (strpos($realestateurl, 'real_estate_plugin') !== false or strpos($realestateurl, 'post_type=realestatefields') !== false )
    if (strpos($realestateurl, 'settings') === false)
          add_action( 'admin_notices', 'realestaterightnow_ask_for_upgrade' );
 }


function realestaterightnow_add_admin_files()
{
   wp_enqueue_style('pluginStyleAdmin', REALESTATERIGHTNOWURL . 'settings/styles/admin-settings.css');    
}
add_action('admin_enqueue_scripts', 'realestaterightnow_add_admin_files');
function realestaterightnow_control_availablememory()
{
    $realestaterightnow_memory = realestaterightnow_check_memory();
    if ( $realestaterightnow_memory['msg_type'] == 'notok')
       return;
     if ($realestaterightnow_memory['percent'] > .7) 
      add_action( 'admin_notices', 'realestaterightnow_message_low_memory' ); 
}
if (wp_get_theme() <> 'Real Estate Right Now')     
   add_action( 'wp_loaded', 'realestaterightnow_control_availablememory' );


function realestaterightnow_change_note_submenu_order( $menu_ord ) {
      global $submenu;
      
    function realestaterightnow_str_replace_json($search, $replace, $subject) 
    {
        return json_decode(str_replace($search, $replace, json_encode($subject)), true);
    }
      $key = 'Real Estate';
      $val = 'Dashboard';
      $submenu = realestaterightnow_str_replace_json($key, $val, $submenu);
}
add_filter( 'custom_menu_order', 'realestaterightnow_change_note_submenu_order' );
function realestaterightnow_gopro2_callback() {
    $urlgopro = "http://realestateplugin.eu/premium/";
    ?>
    <script type="text/javascript">
    <!--
     window.location  = "<?php echo esc_attr($urlgopro);?>";
    -->
    </script>
<?php
//
}
function realestaterightnow_add_menu_gopro2()
{
        $realestaterightnow_gopro_page = add_submenu_page('real_estate_plugin', // $parent_slug
            'Go Pro', // string $page_title
            '<font color="#FF6600">Go Pro</font>', // string $menu_title
            'manage_options', // string $capability
            'realestaterightnow_my-custom-submenu-page3', 'realestaterightnow_gopro2_callback');
}
function realestaterightnow_last() {
    include_once REALESTATERIGHTNOWPATH . '/includes/customizer/customizer.php';
    include_once  REALESTATERIGHTNOWPATH  . '/includes/customizer/public.php';
}
function realestaterightnow_plugin_settings_link($links)
{
    $settings_link = '<a href="options.php?page=rep_settings">Settings</a>';
    array_unshift($links, $settings_link);
    return $links;
}?>