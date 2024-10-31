<?php 
// 2023/12/15

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$realestaterightnow_Mapfield_name = realestaterightnow_findglooglemap();  
$afields = array(
  array(
				'name' => 'Purpose',
				'desc' => __('For Rent or For Sale.', 'real-estate-right-now'),
				'id' => 'product-purpose',
				'type' => 'select',
				'options' => array (
				// 'Rent' => __('Rent',  'real-estate-right-now'),
                'Rent' => 'Rent',
				// 'Sale' => __('Sale',  'real-estate-right-now'),
				'Sale' =>'Sale',
				),
				'default' => 'Rent'
			), 
  array(  
        'name' => 'Price',
        'desc' => __('No special characters here ("$" "," "."), the plugin will auto format the number.',
            'real-estate-right-now'),
        'id' => 'product-price',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => 'Year',
        'desc' => __('The year of the product. Only numbers, no point, no comma.',
            'real-estate-right-now'),
        'id' => 'product-year',
        'type' => 'text',
        'default' => ''),
    array(
        'name' => 'Featured',
        'desc' => __('Mark to show up at Featured Widget.', 'real-estate-right-now'),
        'id' => 'product-featured',
        'type' => 'checkbox'),
 		array(
				'name' => 'Beds',
				'desc' => __('How many Beds.', 'real-estate-right-now'),
				'id' => 'product-beds',
				'type' => 'select',
				'options' => array (
				'0' => '0',
				'1' => '1',
  				'2' => '2',
				'3' => '3',              
 				'4' => '4',
				'5' => '5',               
 				'6' => '6',
				'7' => '7',               
				'8' => '8',
				'9' => '9',                
 				'10' => '10',                
				),
				'default' => '0'
			), 
 		array(
				'name' => 'Baths',
				'desc' => __('How many Baths.', 'real-estate-right-now'),
				'id' => 'product-baths',
				'type' => 'select',
				'options' => array (
				'0' => '0',
				'1' => '1',
  				'2' => '2',
				'3' => '3',              
 				'4' => '4',
				'5' => '5',               
 				'6' => '6',
				'7' => '7',               
				'8' => '8',
				'9' => '9',                
 				'10' => '10',                
				),
				'default' => '0'
			),
    array(
        'name' => 'Address',
        'desc' => __('Address of the property.', 'real-estate-right-now'),
        'id' => 'product-address',
        'type' => 'text',       
        'default' => '',
	),
    array(
        'name' => 'Area',
        'desc' => __('Area of the property.', 'real-estate-right-now'),
        'id' => 'product-area',
        'type' => 'text', 
        'default' => '0',      
        )); 
        
// 2024
// Checking for duplicate field IDs
$afieldsIds = []; // Array to store field IDs
$duplicateIds = []; // Array to store duplicate IDs

if (isset($realestaterightnow_meta_box) && is_array($realestaterightnow_meta_box)){
    foreach ($realestaterightnow_meta_box[$post->post_type]["fields"] as $field) {
        $fieldId = $field["id"];

        if (in_array($fieldId, $afieldsIds)) {
            // If the field ID is already present, it's a duplicate
            $duplicateIds[] = $fieldId;
        } else {
            // Add the field ID to the $afieldsIds array
            $afieldsIds[] = $fieldId;
        }
    }

    // Check if there are any duplicate IDs
    if (!empty($duplicateIds)) {
        // Display a message indicating which IDs are duplicates
        //echo 'The following field IDs are duplicates: ' . implode(', ', $duplicateIds);

        // Remove duplicate fields from the $realestaterightnow_meta_box[$post->post_type]['fields'] array
        foreach ($duplicateIds as $duplicateId) {
            foreach ($realestaterightnow_meta_box[$post->post_type]["fields"] as $key => $field) {
                if ($field["id"] === $duplicateId) {
                    unset($realestaterightnow_meta_box[$post->post_type]["fields"][$key]);
                }
            }
        }
    } else {
        //echo 'No duplicates.';
    }
   

}
// end 2024 //       




$afieldsId = realestaterightnow_get_fields('all');
$totfields = count($afieldsId);
$ametadataoptions = array();
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
        $label = $ametadata[0];
    else
        $label = $ametadata[12];
    if ($ametadata[1] == 'checkbox') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => $ametadata[1],
            );
    } elseif ($ametadata[1] == 'text') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => $ametadata[1],
            'default' => '');
    } elseif ($ametadata[1] == 'dropdown') {
        $arr = explode("\n", $ametadata[2]);
        $options = array();
        for ($z = 0; $z < count($arr); $z++) {
            // $options[$arr[$z]] = $arr[$z];
            $options[$z] = $arr[$z];
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {


        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];



        // Check if the number of steps would be too high
        $proposedStep = $max / 20; // Propose the step value

        // Limit the step to a maximum of 20
        $step = $proposedStep > 20 ? 20 : $proposedStep;


        if(empty($init)) 
         $init = 0;
        $options = array();

        /*
        if (!empty($max) and !empty($step)) {
            for ($z = $init; $z <= $max; $z += $step) {
                $options[$z] = $z;
            }
        }
        */

        if (!empty($max) && !empty($step) && $step > 0) {

            try {
                for ($z = $init; $z <= $max; $z += $step) {
                    $options[$z] = $z;
                }
            } catch (Exception $e) {
                error_log('Error metabox options: ' . $e->getMessage());
            }

            $afields[] = array(
                'name' => $label,
                'desc' => ' ',
                'id' => 'product-' . $ametadata[12],
                'type' => 'select',
                'options' => $options,
                'default' => '');
        }

    } elseif ($ametadata[1] == 'rangeslider') {
        $init = $ametadata[8];
        $max = $ametadata[9];
        $step = $ametadata[10];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'select',
            'options' => $options,
            'default' => '');
    } elseif ($ametadata[1] == 'rangeselect') {
        $init = $ametadata[5];
        $max = $ametadata[6];
        $step = $ametadata[7];
        $options = array();
        for ($z = $init; $z <= $max; $z += $step) {
            $options[$z] = $z;
        }
    } elseif ($ametadata[1] == 'googlemap') {
        $afields[] = array(
            'name' => $label,
            'desc' => ' ',
            'id' => 'product-' . $ametadata[12],
            'type' => 'googlemap',
            'default' => '');
    }
}
$realestaterightnow_meta_box['products'] = array(
    'id' => 'listing-details',
    'title' => __('Details', 'real-estate-right-now'),
    'context' => 'normal',
    'priority' => 'high',
    'fields' => $afields);
add_action('admin_menu', 'realestaterightnow_listing_add_box');
update_option('meta_boxes', $realestaterightnow_meta_box);
function realestaterightnow_listing_add_box()
{
    global $realestaterightnow_meta_box;
    foreach ($realestaterightnow_meta_box as $post_type => $value) {
        add_meta_box($value['id'], $value['title'], 'realestaterightnow_listing_format_box', $post_type,
            $value['context'], $value['priority']);
    }
}

//
function realestaterightnow_listing_format_box()
    {
        global $realestaterightnow_meta_box, $arealestaterightnow_features, $post;
        wp_enqueue_style('meta', REALESTATERIGHTNOWURL . 'includes/post-type/meta.css');
        echo '<input type="hidden" name="listing_meta_box_nonce" value="',
            esc_attr(wp_create_nonce(basename(__file__))), '" />';
    
        $displayed_fields = array(); // Array para armazenar os nomes dos campos já exibidos
    
        foreach ($realestaterightnow_meta_box[$post->post_type]['fields'] as $field) {
            $meta = get_post_meta($post->ID, $field['id'], true);
            $title = $field['name'];
    
            // fix duplicities...
            if (in_array($title, $displayed_fields)) 
              continue;
    
            $displayed_fields[] = $title;
    
            switch ($field['type']) {
                case 'text':
                    echo '<div class="boxes-small">';

$title_processed = str_replace("_", " ", $title);

$title_escaped = esc_attr($title_processed);

// Gerar a saída HTML
echo '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_attr($title_escaped) . '</label></div>';


    
                    //echo '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_attr($title) =
                     //   str_replace("_", " ", esc_attr($title)) . '</label></div>';
                    
                    
                        echo '<div class="box-content"><p>';
    
    /*
                    echo '<input type="text" name="' . esc_attr($field['id']) . '" class="' . esc_attr($field['name']) .
                        '" id="' . $field['id'] . '" value="' . esc_attr(($meta ? $meta : $field['default'])) .
                        '" size="30" style="width:97%" />' . '<br />' . esc_attr($field['desc']);
    */     
                        


       
// Parte 1: Início da tag input
echo '<input type="text" name="';

// Parte 2: Valor do atributo name, escapado
echo esc_attr($field['id']);

// Parte 3: Classe do input, escapada
echo '" class="' . esc_attr($field['name']);

// Parte 4: ID do input, escapado
echo '" id="' . esc_attr($field['id']);

// Parte 5: Valor do input, escapado
//echo '" value="' . esc_attr($meta ? $meta : $field['default']);


// Parte 1: Achar o valor da variável $meta
$input_value = ($meta ? $meta : $field['default']);

// Parte 2: Fazer o echo sanitizado
echo '" value="' . esc_attr($input_value);




// Parte 6: Tamanho e estilo do input
echo '" size="30" style="width:97%" />';

// Parte 7: Quebra de linha e descrição do campo, escapada
echo '<br />' . esc_html($field['desc']);




                    
                    
                        echo '</div></div>';
                    break;
                case 'select':


                    $title = str_replace("_", " ", $title);  
                    echo '<div class="boxes-small">' . '<div class="box-label"><label for="' . esc_attr($field['id']) .
                        '">' . esc_attr($title) . '</label></div>' .
                        '<div class="box-content"><p>';



                    echo '<select name="' . esc_attr($field['id']) . '" id="' . esc_attr($field['id']) . '" class="' . esc_attr($field['name']) .
                        '">';
                    foreach ($field['options'] as $option100) {
                       // echo '<option ' . ($meta == $option100 ? ' selected="selected"' : '') . '>' . $option100 .
                       //     '</option>';

                      
// Início do <option>
echo '<option ';

// Verifica se $meta é igual a $option100 e adiciona 'selected="selected"' se for verdadeiro
if ($meta == $option100) {
    echo 'selected="selected" ';
}

// Fecha o início do <option> e imprime o conteúdo de $option100
echo '>' . esc_attr($option100) . '</option>';



                    }
                    echo '</select>';
                    echo '<br />';
                    echo esc_attr($field['desc']);
                    echo '</div></div>';
                    break;
                case 'checkbox':
                    $title = str_replace("_", " ", $title);
                    echo '<div class="boxes-small">' . '<div class="box-label"><label for="' . esc_attr($field['id']) .
                        '">' . esc_attr($title) . '</label></div>' .
                        '<div class="box-content"><p>';

                    echo '<div class = "checkboxSlide">';
                    /*
                    echo '<input type="checkbox" class="' . esc_attr($field['name']) .
                        '" value="enabled" name="' . esc_attr($field['id']) . '" id="CheckboxSlide"' . ($meta ?
                        ' checked="checked"' : '') . '<br />' . $field['desc'];
                        */



                       
                        // Início da tag input checkbox
                        echo '<input type="checkbox" class="' . esc_attr($field['name']) .
                            '" value="enabled" name="' . esc_attr($field['id']) . '" id="CheckboxSlide"';
                        
                        // Verifica se $meta é verdadeiro e adiciona 'checked="checked"' se for verdadeiro
                        if ($meta) {
                            echo ' checked="checked"';
                        }
                        
                        // Fecha a tag input checkbox e adiciona a quebra de linha e a descrição do campo
                        echo ' /><br />' . esc_attr($field['desc']);
                      
                        





                    echo '</div>';
                    echo '</div></div>';
                    break;
                case 'googlemap':
                    //$meta = get_post_meta($post->ID, 'product-googlemap', true);
                    $value = $meta ? $meta : $field['default'];
                    $googlemap = explode(PHP_EOL, $value);
                    if (isset($googlemap[0]))
                        $googlemap_latitude = $googlemap[0];
                    else
                        $googlemap_latitude = '';
                    if (isset($googlemap[1]))
                        $googlemap_longitude = $googlemap[1];
                    else
                        $googlemap_longitude = '';
                    if (isset($googlemap[2]))
                        $googlemap_zoom = $googlemap[2];
                    else
                        $googlemap_zoom = '';
                    // echo '<div class="boxes-googlemaps">';
                    echo '<div class="boxes-googlemaps" style="padding-bottom: 50px;">';

                    /*
                    echo '<div class="box-label"><label for="' . $field['id'] . '">' . $title =
                    str_replace("_", " ", $title) . '</label></div>';
                    */
$title = str_replace("_", " ", $title);

echo '<div class="box-label"><label for="' . esc_attr($field['id']) . '">' . esc_attr($title) . '</label></div>';




                    echo '<div class="box-content"><p>';
                    echo 'Latitude';
                    echo '<br />';
                    echo '<input type="text" name="product-latitude" class="googlemap" id="product-latitude" value="' .
                        esc_attr($googlemap_latitude) . '" size="30" style="width:97%" />' . '<br />';
                    echo '</div>';
                    echo '<div class="box-content"><p>';
                    echo 'Longitude';
                    echo '<br />';
                    echo '<input type="text" name="product-longitude" class="googlemap" id="product-longitude" value="' .
                        esc_attr($googlemap_longitude) . '" size="30" style="width:97%" />' . '<br />';
                    echo '</div>';
                    echo '<div class="box-content"><p>';
                    echo 'Zoom';
                    //
                    echo '<br />';
                    echo '<input type="text" name="product-zoom" class="googlemap" id="product-zoom" value="' .
                        esc_attr($googlemap_zoom) . '" size="30" style="width:97%" />' . '<br />';
                    // echo '</div>';
                    echo '</div></div>';
                    break;
            } // end Switch
            //   echo '</div></div>';
        }
    } // end function listing_format_box

add_action('save_post', 'realestaterightnow_listing_save_data');
function realestaterightnow_listing_save_data($post_id)
{
    global $realestaterightnow_Mapfield_name,
        $current_post_id,
        $realestaterightnow_meta_box,
        $post,
        $arealestaterightnow_features;
    $current_post_id = $post_id;
    if (!is_object($post)) {
        return;
    }
    if (!isset($realestaterightnow_meta_box[$post->post_type]["fields"])) {
        return;
    }
    //Verify nonce
    if (isset($_POST["listing_meta_box_nonce"])) {
        if (
            !wp_verify_nonce(
                sanitize_text_field($_POST["listing_meta_box_nonce"]),
                basename(__FILE__)
            )
        ) {
            return $post_id;
        }
    }
    //Check autosave
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return $post_id;
    }
    //Check permissions
    if (isset($_POST["post_type"])) {
        if ("page" == sanitize_text_field($_POST["post_type"])) {
            if (!current_user_can("edit_page", $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can("edit_post", $post_id)) {
            return $post_id;
        }
    } else {
        return;
    }

    foreach ($realestaterightnow_meta_box[$post->post_type]["fields"] as $field) {
        if ($field["id"] == $realestaterightnow_Mapfield_name) {
            $latitude = sanitize_text_field($_POST["product-latitude"]);
            $longitude = sanitize_text_field($_POST["product-longitude"]);
            $zoom = sanitize_text_field($_POST["product-zoom"]);
            $address = sanitize_text_field($_POST["product-address"]);

            if (
                !empty($latitude) ||
                !empty($longitude) ||
                !empty($zoom) ||
                !empty($address)
            ) {
                $new =
                    $latitude .
                    PHP_EOL .
                    $longitude .
                    PHP_EOL .
                    $zoom .
                    PHP_EOL .
                    $address;
                update_post_meta($post_id, $realestaterightnow_Mapfield_name, $new);
            }
        }
        // end googlemap
        else {
            if (isset($_POST[$field["id"]])) {
                $new = sanitize_text_field($_POST[$field["id"]]);
            } else {
                $new = "";
            }
            //$old = get_post_meta($post_id, $field['id'], true);
            if ($field["id"] == "product-price") {
                if ($new == "") {
                    $new = "0";
                }
                $r = update_post_meta($post_id, $field["id"], trim($new));
            } else {
                $old = get_post_meta($post_id, $field["id"], true);
                if ($new && $new != $old) {
                    $r = update_post_meta($post_id, $field["id"], trim($new));
                } elseif ("" == $new && $old) {
                    delete_post_meta($post_id, $field["id"], $old);
                }
            }
        }
    } // end loop
} // end Function Save Data