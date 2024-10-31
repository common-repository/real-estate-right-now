<?php /**
 * @author Bill Minozzi
 * @copyright 2017
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
add_action('wp_enqueue_scripts', 'RealEstateregister_slider');
function RealEstateregister_slider()
{
    wp_register_script('search-slider', REALESTATERIGHTNOWURL .
        'includes/search/search_slider.js', array('jquery'), null, true);
    wp_enqueue_script('search-slider');
 //   wp_register_style('jqueryuiSkin', REALESTATERIGHTNOWURL . 'assets/jquery/jqueryui.css',
 //       array(), '1.12.1');
 //   wp_enqueue_style('jqueryuiSkin');
}
function realestaterightnow_search($is_show_room)
{
    global $realestaterightnow_postNumber, $wp, $post, $realestaterightnow_page_id, $realestaterightnow_meta_purpose, $realestaterightnow_purpose;
    $my_title = __("Search", 'real-estate-right-now');
    if ($is_show_room == '0') // widget
        {

        //$searchlabel = 'search-label-widget';
        //$selectboxmeta = 'select-box-meta-widget';
        //$selectbox = 'select-box-widget';

        $searchlabel = 'realestate-search-label-widget';
        $selectboxmeta = 'realestate-select-box-meta-widget';
        $selectbox = 'realestate-select-box-widget';

        $inputbox = 'input-box-widget';
        $searchItem = 'searchItem-widget';
        $searchItem2 = 'searchItem2-widget';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn-widget';
        $realestaterightnow_search_box = 'realestate-search-box-widget';
        $current_page_url = esc_url(home_url() . '/realestaterightnow_show_room_2/');
        $realestaterightnow_search_type = 'search-widget';
        $afieldsId = realestaterightnow_get_fields('widget');
        $realestaterightnow_container_buttons_search = 'realestaterightnow_container_buttons_search_widget';

    } elseif ($is_show_room == '1') // pag
    {
        //$searchlabel = 'search-label';
        //$selectboxmeta = 'select-box-meta';
        //$selectbox = 'select-box';

        $searchlabel = 'realestate-search-label';
        $selectboxmeta = 'realestate-select-box-meta';
        $selectbox = 'realestate-select-box';


        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn';
        $realestaterightnow_search_box = 'realestate-search-box';
        $current_page_url = home_url(esc_url(add_query_arg(null, null)));
        $realestaterightnow_search_type = 'page';
        $afieldsId = realestaterightnow_get_fields('search');
        $realestaterightnow_container_buttons_search = 'realestaterightnow_container_buttons_search';

    } elseif ($is_show_room == '2') // search result
    {
        //$searchlabel = 'search-label';
        //$selectboxmeta = 'select-box-meta';
        //$selectbox = 'select-box';
        $searchlabel = 'realestate-search-label';
        $selectboxmeta = 'realestate-select-box-meta';
        $selectbox = 'realestate-select-box';
        $inputbox = 'input-box';
        $searchItem = 'searchItem';
        $searchItem2 = 'searchItem';
        $RealEstatesubmitwrap = 'RealEstate-submitBtn';
        $realestaterightnow_search_box = 'realestate-search-box';
        $current_page_url = esc_url(home_url() . '/realestaterightnow_show_room_2/');
        $realestaterightnow_search_type = 'search-widget';
        $afieldsId = realestaterightnow_get_fields('search');
        $realestaterightnow_container_buttons_search = 'realestaterightnow_container_buttons_search';

    }
        $showsubmit = false; 
        //  $afieldsId = realestaterightnow_get_fields('search');
        $totfields = count($afieldsId);
        $ametadataoptions = array();

        //$output = '<div class="' . $realestaterightnow_search_box . '">';
        //$output .= '<div class="RealEstate-search-cuore">';
        //$output .= '<div class="RealEstate-search-cuore-fields">';
       // $output .= '<form method="get" id="searchform3" action="' . $current_page_url . '">';
       

        $output = '<div id="'.$realestaterightnow_search_box . '" class="' . $realestaterightnow_search_box . '">';
        $output .= '<div class="realestate-search-cuore">';
        $output .= '<div class="realestate-search-cuore-fields">';
        $output .= '<form method="get" id="searchform3" action="' . $current_page_url . '">';
 
       
        if (isset($realestaterightnow_page_id)) {
            if ($realestaterightnow_page_id <> '0') {
                $output .= '        <input type="hidden" name="page_id" value="' . $realestaterightnow_page_id .
                    '" />';
            }
        }      
       if (!isset($_GET['meta_purpose'])) {
        $_GET['meta_purpose'] = '';
       }
       if (!isset($_GET['meta_beds'])) {
        $_GET['meta_beds'] = '';
       }  
       if (!isset($_GET['meta_baths'])) {
        $_GET['meta_baths'] = '';
       } 
       
       
  // purpose

      // 2023 container of buttons...

      $output .= '<div class="'.$realestaterightnow_container_buttons_search.'">';


      // 0 widget
      // 1 pag
      // 2 search
     // if($is_show_room == 0)
     //  die(var_dump(get_option('realestaterightnow_widget_show_purpose', 'yes')));
     
      if ((trim(get_option('realestaterightnow_show_purpose', 'yes')) != 'no' and $is_show_room !=
      0) or (trim(get_option('realestaterightnow_widget_show_purpose', 'yes')) != 'no' and $is_show_room ==
      0)) 
        { 
            $showsubmit = true;

            $output .= ' <div class="' . $searchItem . '">
            <span class="' . $searchlabel . '">' . __('Purpose', 'real-estate-right-now') .
            ':</span>';
            if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';

            $realestaterightnow_meta_purpose = sanitize_text_field($_GET['meta_purpose']);
            //        die($realestaterightnow_meta_purpose);
            if( isset($realestaterightnow_purpose))
            { 
                $realestaterightnow_purpose = trim($realestaterightnow_purpose);
                if($realestaterightnow_purpose <> '')
                $realestaterightnow_meta_purpose =  $realestaterightnow_purpose; 
            } 

            $output .=  '<select id="rent_sale" class="' . $selectboxmeta . '" name="meta_purpose">
                        <option ' . (($realestaterightnow_meta_purpose == 'Rent') ? 'selected="selected"' :
                '') . '  value ="Rent"> ' . __('Rent', 'real-estate-right-now') . 
                    '</option>
                        <option ' . (($realestaterightnow_meta_purpose == 'Sale') ? 'selected="selected"' :
                '') . '  value ="Sale"> ' . __('Sale', 'real-estate-right-now') . '</option>
                        </select> 
                </div>';
        }


  // Beds
  if ((trim(get_option('realestaterightnow_show_beds', 'yes')) != 'no' and $is_show_room !=
  0) or (trim(get_option('realestaterightnow_widget_show_beds', 'yes')) != 'no' and $is_show_room ==
  0)) {
          $showsubmit = true;

          $meta_beds = sanitize_text_field($_GET['meta_beds']);    
          $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Beds', 'real-estate-right-now') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .=  '<select class="' . $selectboxmeta . '" name="meta_beds">
    							<option ' . (($meta_beds == 'All') ? 'selected="selected"' :
            '') . '  value ="">' . __("All", "real-estate-right-now") . '</option>';
       $max_beds = realestaterightnow_get_max_beds();
           for($i = 1; $i <= $max_beds; $i++ )
           {
                 $output .= '<option ' . (($meta_beds == $i) ? 'selected="selected"' : '') . ' value ="' . $i .  '"> '  . $i .  '</option>';           
           }
           $output .= ' </select> 
    		</div>';
    } 

// Baths
if ((trim(get_option('realestaterightnow_show_baths', 'yes')) != 'no' 
and $is_show_room != 0) 
or (trim(get_option('realestaterightnow_widget_show_baths', 'yes')) != 'no' 
and $is_show_room == 0)) {
          $meta_baths = sanitize_text_field($_GET['meta_baths']);   
          $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Baths', 'real-estate-right-now') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .=  '<select class="' . $selectboxmeta . '" name="meta_baths">
                               <option ' . (($meta_baths == 'All') ? 'selected="selected"' :
            '') . '  value ="">' . __("All", "real-estate-right-now") . '</option>';
       $max_baths = realestaterightnow_get_max_baths();
           for($i = 1; $i <= $max_baths; $i++ )
           {
                 $output .= '<option ' . (($meta_baths == $i) ? 'selected="selected"' : '') . ' value ="' . $i .  '"> '  . $i .  '</option>';           
           }
           $output .= ' </select> 
    		</div>';
    }     		
    // Location
    
    $alocations = realestaterightnow_get_locations();
    $qlocations = count($alocations);

    if ((trim(get_option('realestaterightnow_show_location', 'yes')) != 'no' and $is_show_room !=
        0) or (trim(get_option('realestaterightnow_widget_show_location', 'yes')) != 'no' and $is_show_room ==
        0)) {
            
            $showsubmit = true;



     if(isset($_GET['meta_locations']))  
       $meta_locations = sanitize_text_field($_GET['meta_locations']);
     else
       $meta_locations = '';       
        $output .= '	 
     					<div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Location', 'real-estate-right-now') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= ' 
                            <select class="' . $selectboxmeta .
            '" name="meta_locations">
    							<option ' . (($meta_locations == '') ? 'selected="selected"' : '') .
            ' value =""> ' . __('All', 'real-estate-right-now') . ' </option>';
        for ($i = 0; $i < $qlocations; $i++) {
          //  die('$make');
            $output .= '<option ' . (($meta_locations == trim($alocations[$i])) ? 'selected="selected"' :
                '') . '  value ="' . $alocations[$i] . '"> ' . $alocations[$i] . '</option>';
        }
        $output .= '</select></div>';
    }

  // Location

    for ($i = 0; $i < $totfields; $i++) {
        $post_id = $afieldsId[$i];
        $ametadata = realestaterightnow_get_meta($post_id);
        $field_value = array(
            'field_label', // 0
            'field_typefield', // 1
            'field_drop_options', // 2
            'field_searchbar', // 3
            'field_searchwidget', //4
            'field_rangemin', // 5
            'field_rangemax', //6
            'field_rangestep', // 7
            'field_slidemin', // 8
            'field_slidemax', // 9
            'field_slidestep', // 10
            'field_order', // 11
            'field_name'); // 12
        if (!empty($ametadata[0]))
            $search_label = $ametadata[0];
        else
            $search_label = $ametadata[12];
        $search_name = $ametadata[12];
        $meta = 'meta_'.$ametadata[12];
        if (!isset($_GET[$search_name])) {
            $_GET[$search_name] = '';
        }
       if (isset($_GET[$meta]))
          $realestaterightnow_meta_con = trim(sanitize_text_field($_GET[$meta]));
       else
          $realestaterightnow_meta_con = ' '; 
        $typefield = $ametadata[1];
        // Dropdown
        if ($typefield == 'dropdown') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $options = explode("\n", $ametadata[2]);
            // $output .= '<option>All</option>';
            //$output .= '<option>'. __('All', 'real-estate-right-now') .'</option>';
            $output .= '<option value="All">'. __('All', 'real-estate-right-now') .'</option>';

            foreach ($options as $option) {
                $output .= '<option ';
                if(trim($realestaterightnow_meta_con) == trim($option))
                  {
                    $output .= ' selected="selected" ';
                   }  
                $output .= '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown
        // Select Range
        if ($typefield == 'rangeselect') {
            $showsubmit = true;
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta . '" name="'.$meta.'">';
            $init = $ametadata[5];
            $max = $ametadata[6];
            $step = $ametadata[7];
            $options = array();
            $output .= '<option value="All">'. __('All', 'real-estate-right-now') .'</option>';
            for ($z = $init; $z <= $max; $z += $step) {
                $option = $z;
                $output .= '<option ' . ($realestaterightnow_meta_con == $option ?
                        ' selected="selected"' : '') . '>' . $option . '</option>';
            }
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Dropdown       
         // Checkbox
        if ($typefield == 'checkbox') {
            $showsubmit = true;
            if (isset($_GET[$meta]))
                $realestaterightnow_meta_con = sanitize_text_field($_GET[$meta]);
            else
                $realestaterightnow_meta_con = ' ';
            $output .= '<div class="' . $searchItem . '">';
            $output .= '<span class="' . $searchlabel . '">' . $search_label . ':</span>';
            if ($is_show_room <> 0)
                $output .= '<div id="bdp_oneline"></div>';
            $output .= '<select class="' . $selectboxmeta .'" name="'.$meta.'">';
               // $output .= '<option value = "All" ' . ($realestaterightnow_meta_con == 'All' ? ' selected="selected"' : '') . '>All</option>';
                $output .= '<option value="All">'. __('All', 'real-estate-right-now') .'</option>';
                $output .= '<option value = "enabled" ' . ($realestaterightnow_meta_con == "enabled"  ? ' selected="selected"' : '') . '>'. __('Yes', 'real-estate-right-now') .'</option>';
                $output .= '<option value = "" ' . ($realestaterightnow_meta_con == '' ? ' selected="selected"' : '') . '>'. __('No', 'real-estate-right-now') .'</option>';
            $output .= '</select>';
            $output .= '</div>'; // SearchItem;
        } // end Checkbox
    } // end Loop 
    
    
    
     // Order by
    if ((trim(get_option('realestaterightnow_show_orderby', 'yes')) != 'no' and $is_show_room !=
        0) or (trim(get_option('realestaterightnow_widget_show_orderby', 'yes')) != 'no' and $is_show_room ==
        0)) {
        $showsubmit = true;
        if (isset($_GET['meta_order']))
            $realestaterightnow_meta_order = sanitize_text_field($_GET['meta_order']);
        else
            $realestaterightnow_meta_order = '';
        $realestaterightnow_meta_order = sanitize_text_field($realestaterightnow_meta_order);
        $output .= ' <div class="' . $searchItem . '">
    						<span class="' . $searchlabel . '">' . __('Order By', 'real-estate-right-now') .
            ':</span>';
        if ($is_show_room <> 0)
            $output .= '<div id="bdp_oneline"></div>';
        $output .= '<select class="' . $selectboxmeta .
            '" name="meta_order" style="min-width: 120px;">
    							<option ' . (($realestaterightnow_meta_order == '') ? 'selected="selected"' :
            '') . ' value =""> ' . __('Any', 'real-estate-right-now') . ' </option>
    							<option ' . (($realestaterightnow_meta_order == 'year_high') ?
            'selected="selected"' : '') . '  value ="year_high"> ' . __('Year newest first',
            'real-estate-right-now') . '</option>
    							<option ' . (($realestaterightnow_meta_order == 'year_low') ?
            'selected="selected"' : '') . '  value ="year_low"> ' . __('Year oldest first',
            'real-estate-right-now') . '</option>
    							<option ' . (($realestaterightnow_meta_order == 'price_high') ?
            'selected="selected"' : '') . '  value ="price_high"> ' . __('Price higher first',
            'real-estate-right-now') . '</option>
    							<option ' . (($realestaterightnow_meta_order == 'price_low') ?
            'selected="selected"' : '') . '  value ="price_low"> ' . __('Price lower first',
            'real-estate-right-now') . '</option>
    						</select>  
    					</div>';
    }    

    // end orderby   
    
    $output .= '</div>'; // end container buttons
    
    
    
    
    
          
        // Slider
        if ((trim(get_option('realestaterightnow_show_price', 'yes')) != 'no' and $is_show_room !=
        0) or (trim(get_option('realestaterightnow_widget_show_price', 'yes')) != 'no' and $is_show_room ==
        0)) {
         $showsubmit = true;
         if( isset($realestaterightnow_purpose)) 
            $realestaterightnow_meta_purpose =  $realestaterightnow_purpose;
         if (isset($realestaterightnow_meta_purpose))
            if ($realestaterightnow_meta_purpose != '')
               $max_car_value = realestaterightnow_get_max($realestaterightnow_meta_purpose);
            else
               $max_car_value = realestaterightnow_get_max('');
        if ($is_show_room != '0') // no widget
           {
            $output .= '<div class="realestate-price-slider">';
            $output .= '<span class="realestatelabelprice">' . __('Price Range', 'real-estate-right-now') . ':</span>';
            $output .= '<input type="text" name="meta_price" id="meta_price" readonly>';
            // slider
            if ($is_show_room == '1')
                $output .= '<div id="realestaterightnow_meta_price" class="realestateslider" ></div>';
            else
                $output .= '<div id="realestaterightnow_meta_price" class="realestateslider" style="margin-top:0px;" ></div>';
            $output .= '<input type="hidden" name="meta_price_max" id="meta_price_max" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price']))
              $price = sanitize_text_field($_GET['meta_price']);
            else
              $price = '';
            /*
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min" id="choice_price_min" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max" id="choice_price_max" value="' .
                    $priceMax . '">';
            }
            */
            $pos = strpos($price, '-');
            if ($pos === false)
               {    
                  $price = '';
                  $priceMin = '0';
                  $priceMax = $max_car_value;
               }            
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
               }             
            $output .= '</div>';
         }  // show room != 0 
        if ($is_show_room == '0') // widget
           {
            $output .= '<div class="realestate-price-slider2">';
            $output .= '<span class="realestatelabelprice2">' . __('Price', 'real-estate-right-now') . ':</span>';
            $output .= '<input type="text" name="meta_price2" id="meta_price2" readonly>';
                $output .= '<div id="realestaterightnow_meta_price2" class="realestateslider" "></div>';
            $output .= '<input type="hidden" name="meta_price_max2" id="meta_price_max2" value="'.$max_car_value.'">';
            if(isset($_GET['meta_price2']))
              $price = sanitize_text_field($_GET['meta_price2']);
            else
              $price = '';
            $pos = strpos($price, '-');
            if ($pos === false)
                $price = '';
            else {
                $priceMin = trim(substr($price, 0, $pos - 1));
                $priceMax = trim(substr($price, $pos + 1));
                $output .= '<input type="hidden" name="choice_price_min2" id="choice_price_min2" value="' .
                    $priceMin . '">';
                $output .= '<input type="hidden" name="choice_price_max2" id="choice_price_max2" value="' .
                    $priceMax . '">';
            }
            $output .= '</div>';
       
           
         }  // show room = 0 
        }         
    // Submit
    if ($showsubmit) {
        $output .= '<div class="realestate-submitBtnWrap">';
        $output .= '<input type="submit" name="submit" id="realestate-submitBtn" value=" ' . __('Search', 'real-estate-right-now') . '" />';
        $output .= '</div>';
        $output .= '<input type="hidden" name="realestaterightnow_post_type" value="products" />';
        $output .= '<input type="hidden" name="postNumber" value="' . $realestaterightnow_postNumber .
            '" />';
        $output .= '<input type="hidden" name="realestaterightnow_search_type" value="' . $realestaterightnow_search_type .
            '" />';
    }
    $output .= '</form></div></div></div>  <!-- end of Basic -->';
    return $output;
}
?>
