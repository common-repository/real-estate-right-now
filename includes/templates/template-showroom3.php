<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
function realestaterightnow_add_custom_css_to_header() {
    ?>
    <style type="text/css">
    <!--
    <?php if (get_option('sidebar_search_page_result', 'no') == 'yes') { ?>
        #secondary, .sidebar-container {
            display: none !important; 
        }
    <?php } ?>
    #main {
        width: 100%!important;
        position:  absolute;
    }
    -->
    </style>
    <?php
}
add_action('wp_head', 'realestaterightnow_add_custom_css_to_header');

global $wp;
//global $query;
global $wp_query;
$wp_query->is_404 = false;
get_header();
$output = '<div style="margin-top: 20px;">';
$output .= '<div id="realestaterightnow_content">';
if (!isset($_GET['submit'])) {
    $_GET['submit'] = '';
} else
    $submit = sanitize_text_field($_GET['submit']);
if (isset($_GET['post_type'])) {
    $post_type = sanitize_text_field($_GET['post_type']);
}
if (isset($_GET['postNumber'])) {
    $realestaterightnow_postNumber = sanitize_text_field($_GET['postNumber']);
}
if (empty($realestaterightnow_postNumber)) {
    $realestaterightnow_postNumber = get_option('realestaterightnow_quantity', 6);
}
$output .= realestaterightnow_search(2);
    if (get_query_var('paged')) {
        $paged = get_query_var('paged');
    } elseif (get_query_var('page')) {
        $paged = get_query_var('page');
    }
    if(! isset($paged))
       $paged = realestaterightnow_get_page();
if (isset($submit)) {
    require_once (REALESTATERIGHTNOWPATH . 'includes/search/search_get_par.php');
    $afieldsId = realestaterightnow_get_fields('all');
    $totfields = count($afieldsId);
    $afilter = array();
    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = realestaterightnow_get_meta($post_id);
        $keyname = 'product-' . $ametadata[12];
        $metaname = 'meta_' . $ametadata[12];
        if (isset($_GET[$metaname])) {
            $keyval = trim(sanitize_text_field($_GET[$metaname]));
            if ($keyval != 'All') {
                if ($ametadata[1] == 'checkbox') {
                    if ($keyval == 'enabled') {
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => $keyval,
                            'compare' => 'EXISTS');
                    }
                    else
                    {
                        echo esc_attr($keyname);
                        $afilter[] = array(
                            'key' => $keyname,
                            'value' => 'enabled',
                            'compare' => 'NOT EXISTS');                       
                    }
                } else // not checkbox
                {
                    if ( !empty($keyval))
                    {
                    $afilter[] = array(
                        'key' => $keyname,
                        // serialize())
                        'value' => $keyval,
                        'compare' => 'LIKE');
                    }
                }
            }
        }
    } // end Loop fields
            if(isset($_GET['meta_price']))  
               $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            if(isset($_GET['meta_price2']))  
               $price = sanitize_text_field($_GET['meta_price2']);
            if ($price != '') {
        $pos = strpos($price, '-');
        if ($pos !== false) {
            $priceMin = trim(substr($price, 0, $pos - 1));
            $priceMax = trim(substr($price, $pos + 1));
                      $afilter[] = array(
                     // array(
                      'relation' => 'OR',
                       array(
                        'key' => 'product-price',
                        'value' => array($priceMin, $priceMax),
                        'type' => 'numeric',
                        'compare' => 'BETWEEN'),
                      array(
                        'key' => 'product-price',
                        'value' => '0',
                        'type' => 'numeric',  
                        'compare' => '='),
                  );                
        }
    } // end meta_price
    // meta_purpose
    if (isset($_GET['meta_purpose'])) {
        if (isset($_GET['meta_purpose']))
            $purpose = sanitize_text_field($_GET['meta_purpose']);
        else
            $purpose = '';
        $afilter[] = array('key' => 'product-purpose', 'value' => $purpose);
    } // end meta_purpose
    // meta_beds
    if (isset($_GET['meta_beds'])) {
        if (isset($_GET['meta_beds']))
            $beds = sanitize_text_field($_GET['meta_beds']);
        else
            $beds = '';
        if (!empty($beds)) {
            $afilter[] = array('key' => 'product-beds', 'value' => $beds);
        }
    } // end meta_beds
    // meta_baths
    if (isset($_GET['meta_baths'])) {
        if (isset($_GET['meta_baths']))
            $baths = sanitize_text_field($_GET['meta_baths']);
        else
            $baths = '';
        if (!empty($baths)) {
            $afilter[] = array('key' => 'product-baths', 'value' => $baths);
        }
    } // end meta_baths
    // Featured
    if (isset($_GET['meta_order']))
        $order = trim(sanitize_text_field($_GET['meta_order']));
    else
        $order = '';
    if (!empty($order)) {
        if ($order == 'price_high') {
            $wmetakey = 'product-price';
            $wmetaorder = 'DESC';
        }
        if ($order == 'price_low') {
            $wmetakey = 'product-price';
            $wmetaorder = 'ASC';
        }
        if ($order == 'year_high') {
            $wmetakey = 'product-year';
            $wmetaorder = 'DESC';
        }
        if ($order == 'year_low') {
            $wmetakey = 'product-year';
            $wmetaorder = 'ASC';
        }
    } // no order
    $args = array(
        'post_type' => 'products',
        'showposts' => $realestaterightnow_postNumber,
        'paged' => $paged,
        );
    if (!empty($order)) {
        $args['orderby'] = 'meta_value';
        $args['meta_type'] = 'NUMERIC';
        $args['meta_key'] = $wmetakey;
        $args['order'] = $wmetaorder;
    }
    $args['meta_query'] = $afilter;
    if(!empty($meta_locations) and $meta_locations <> 'All')
            {
               $args['tax_query'] = array(                
                               array(
                        'taxonomy' => 'locations',
                        'field' => 'name',
                        'terms' => $meta_locations,
                    ),
                 );
            }     
} else // submit
{
    $args = array(
        'post_type' => 'products',
        'showposts' => $realestaterightnow_postNumber,
        'paged' => $paged,
        'order' => 'DESC');
}
//
/*
 echo '<pre>';
 print_r($args);
 echo '</pre>'; 
*/ 
global $wp_query;
wp_reset_query();
$wp_query = new WP_Query($args);
$qposts = $wp_query->post_count;
// echo 'q posts: '.$qposts;
$realestaterightnow_measure = get_option('realestaterightnow_measure', 'M2');
$ctd = 0;
$output .= '<div class="multiGallery">';
while ($wp_query->have_posts()):
    $wp_query->the_post();
    $ctd++;
    $price = get_post_meta(get_the_ID(), 'product-price', true);
         if ($price <> '' and $price != '0')
         { 
            $price = number_format_i18n($price, 0);
            $price = realestaterightnow_currency() . $price;
         }
         else
            $price =  __('Call for Price', 'real-estate-right-now'); 
    $image_id = get_post_thumbnail_id();
 


        if (empty($image_id)) {
            $image = REALESTATERIGHTNOWIMAGES . 'imagenoavailable800x600_br.jpg';
           // $image = str_replace("-", "", $image);
           $thumb = $image;
        } else {
            $image_url = wp_get_attachment_image_src($image_id, 'medium', true);
            $image = str_replace("-" . $image_url[1] . "x" . $image_url[2], "", $image_url[0]);
            $thumb = realestaterightnow_aq_resize($image, '300', '225', true, true, true );
      
        }





    $year = get_post_meta(get_the_ID(), 'product-year', true);
    $beds = get_post_meta(get_the_ID(), 'product-beds', true);
    $baths = get_post_meta(get_the_ID(), 'product-baths', true);
    $area = get_post_meta(get_the_ID(), 'product-area', true);
    $output .= '<br /><div class="realestaterightnow_container17">';
    $output .= '<div class="realestaterightnow_gallery_17">';
    $output .= '<a class="nounderline" href="' . get_permalink() . '">';
    
    $output .= '<img class="realestaterightnow_caption_img17" src="' . $thumb . '" alt="' .
            get_the_title() . '" />';
    
    
    
    $output .= '</a>';
    $output .= '</div>';
    $output .= '<div class="multiInfoRight17">';
    $output .= '<a class="nounderline" href="' . get_permalink() . '">';
    $output .= '<div class="multiTitle17">' . get_the_title() . '</div>';
    $output .= '</a>';
    $output .= '<div class="multiInforightText17">';
    $output .= '<div class="multiInforightbold">';
    $output .= '<div class="realestaterightnow_smallblock">';
    $output .= $price;
    $output .= '</div>';
        if ($year <> '') {
        $output .= '<div class="realestaterightnow_smallblock">';  
            $output .= '<span class="billcar-calendar">';
            $output .= ' ' . $year;
        $output .= '</div>'; 
        }        
        if ($beds <> '') {
        $output .= '<div class="realestaterightnow_smallblock">';  
            $output .= '<span class="billcar-bed">';
            $output .= ' ' . $beds;
        $output .= '</div>'; 
        }
        if ($baths <> '') {
        $output .= '<div class="realestaterightnow_smallblock">';  
            $output .= '<span class="billcar-bathtub">';
            $output .= ' ' . $baths;
            $output .= '</div>'; 
        }
        if ($area <> '') {
        $output .= '<div class="realestaterightnow_smallblock">';  
            $output .= '<span class="billcar-area3">';
            $output .= ' ' . $area;
            $output .= ' (' . $realestaterightnow_measure. ')';
            $output .= '</div>'; 
        }
    $content_post = get_post(get_the_ID());
    $desc = sanitize_textarea_field($content_post->post_content);
    $desc = preg_replace("/\[([^\[\]]++|(?R))*+\]/", "", $desc);
    $output .= '<br>';
    $output .= substr($desc, 0, 200);
    if (substr($desc, 200) <> '')
        $output .= '...';
    $output .= '</div>';
        $output .= '</div>';
        $output .= '<input type="submit" class="realestaterightnow_btn_view"';
    $output .= ' onClick="location.href=\'' . get_permalink() . '\'"';
    $output .= ' value="' . __('View', 'real-estate-right-now') . '" />';
    $output .= '</div>';
    $output .= '</a>';
    $output .= '</div>';
endwhile;
$output .= '</div>';
ob_start();
the_posts_pagination(array(
    'mid_size' => 2,
    'prev_text' => __('Back', 'real-estate-right-now'),
    'next_text' => __('Onward', 'real-estate-right-now'),
    ));
$output .= ob_get_contents();
ob_end_clean();
$output .= '</div>';
$output .= '</div>';
wp_reset_postdata();
wp_reset_query();
if ($qposts < 1) {
    $output .= '<br /><h4>' . __('Not Found !', 'real-estate-right-now') . '</h4>';
}

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
 

echo wp_kses($output, $realestaterightnow_my_allowed);
//echo $output;


$registered_sidebars = wp_get_sidebars_widgets();
if (get_option('sidebar_search_page_result', 'no') == 'yes') {
    foreach ($registered_sidebars as $sidebar_name => $sidebar_widgets) {
        unregister_sidebar($sidebar_name);
    }
}
get_footer(); ?>