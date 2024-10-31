<?php 
/**
 * @author Bill Minozzi
 * @copyright 2017
 */
namespace realestate\WP\Settings;
// http://autosellerplugin.com/wp-admin/tools.php?page=rep_settings1
// $mypage = new Page('Settings', array('type' => 'submenu2', 'parent_slug' =>'admin.php?page=real_estate_plugin'));
// $mypage = new Page('rep_settings', array('type' => 'submenu', 'parent_slug' =>'tools.php'));
  $mypage = new Page('rep_settings', array('type' => 'submenu2', 'parent_slug' =>'real_estate_plugin'));
 // $mypage = new Page('rep_settings', array('type' => 'menu'));
$msg = 'This is a scction 1 ... ';
$settings = array();
//$settings['Mutidealer Settings']['Mutidealer Settings'] = array('info' => $msg );
$fields = array();
/*
$fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'RealEstatecurrency',
	'label' => __('Currency', 'real-estate-right-now'),
	'select_options' => array(
		array('value'=>'Dollar', 'label' => 'Dollar'),
		array('value'=>'Euro', 'label' => 'Euro'),
		array('value'=>'AUD', 'label' => 'Australian Dollar'),
  		array('value'=>'Forint', 'label' => 'Forint'),        
        array('value'=>'Krone', 'label' => 'Danish Krone'),
		array('value'=>'Pound', 'label' => 'Pound'),
		array('value'=>'Real', 'label' => 'Brazil Real'),
   		array('value'=>'Swiss', 'label' => 'Swiss Franc'),
		array('value'=>'Yen', 'label' => 'Yen'),
		array('value'=>'Zar', 'label' => 'Zar'),  
		array('value'=>'Universal', 'label' => 'Universal')     
		)			
	);
	*/
	$fields[] = array(
		'type' 	=> 'select',
		'name' 	=> 'RealEstatecurrency',
		'label' => __('Currency', 'real-estate-right-now'),
		'select_options' => array(
					array('value' => 'USD', 'label' => 'US Dollars (&#36;)'),
					array('value' => 'AED', 'label' => 'United Arab Emirates Dirham (&#1583;.&#1573;'),
					array('value' => 'AOA', 'label' => 'Angolan Kwanza'),
					array('value' => 'AFN', 'label' => 'Afghan Afghani (&#1547;)'),
					array('value' => 'ARS', 'label' => 'Argentine Pesos (&#36;)'),
					array('value' => 'AUD', 'label' => 'Australian Dollars (&#36;)'),
					array('value' => 'BRL', 'label' => 'Brazilian Real (R&#36;)'),
					array('value' => 'BGN', 'label' => 'Bulgarian Lev'),
					array('value' => 'CAD', 'label' => 'Canadian Dollars (&#36;)'),
					array('value' => 'CNY', 'label' => 'Chinese Yuan (&yen;)'),
					array('value' => 'HRK', 'label' => 'Croatian Kuna'),
					array('value' => 'CZK', 'label' => 'Czech Koruna'),
					array('value' => 'DKK', 'label' => 'Danish Krone'),
					array('value' => 'EUR', 'label' => 'Euros (&euro;)'),
					array('value' => 'HKD', 'label' => 'Hong Kong Dollar (&#36;)'),
					array('value' => 'HUF', 'label' => 'Hungarian Forint'),
					array('value' => 'INR', 'label' => 'Indian Rupee (&#8377;)'),
					array('value' => 'RIAL', 'label' => 'Iranian Rial (&#65020;)'),
					array('value' => 'ILS', 'label' => 'Israeli Shekel (&#8362;)'),
					array('value' => 'JPY', 'label' => 'Japanese Yen (&yen;)'),
					array('value' => 'KRW', 'label' => 'South Korean Won (₩)'),
					array('value' => 'MYR', 'label' => 'Malaysian Ringgits'),
					array('value' => 'MXN', 'label' => 'Mexican Peso (&#36;)'),
					array('value' => 'NZD', 'label' => 'New Zealand Dollar (&#36;)'),
					array('value' => 'NOK', 'label' => 'Norwegian Krone'),
					array('value' => 'PKR', 'label' => 'Pakistani Rupee (₨)'),
					array('value' => 'PHP', 'label' => 'Philippine Pesos'),
					array('value' => 'PLN', 'label' => 'Polish Zloty'),
					array('value' => 'GBP', 'label' => 'Pound Sterling (&pound;)'),
					array('value' => 'RON', 'label' => 'Romanian Leu'),
					array('value' => 'RUB', 'label' => 'Russian Rubles'),
					array('value' => 'SAR', 'label' => 'Saudi Riyal (&#65020;)'),
					array('value' => 'CHF', 'label' => 'Swiss Franc'),
					array('value' => 'SEK', 'label' => 'Swedish Krona'),
					array('value' => 'SGD', 'label' => 'Singapore Dollar (&#36;)'),
					array('value' => 'THB', 'label' => 'Thai Baht (&#3647;)'),
					array('value' => 'TRY', 'label' => 'Turkish Lira (&#8378;)'),
					array('value' => 'TWD', 'label' => 'Taiwan New Dollars'),
					array('value' => 'VND', 'label' => 'Vietnamese Dong (&#8363;)'),
					array('value' =>' YEN', 'label' => 'Yen (&yen;)'),
					array('value' => 'ZAR', 'label' => 'South African Rand'),
					array('value' => 'Universal', 'label' => 'Universal')
				)
			);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'realestaterightnow_measure',
	'label' => __('Meters - Feets','real-estate-right-now'),
	'select_options' => array(
		array('value'=>'M2', 'label' => __('Meters', 'real-estate-right-now')),
		array('value'=>'Sq Ft', 'label' => __('Feets', 'real-estate-right-now')),
		)			
	);
/*
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'realestaterightnow_liter',
	'label' => __('Liters - Gallons','real-estate-right-now'),
	'select_options' => array(
		array('value'=>'Liters', 'label' => __('Liters', 'real-estate-right-now')),
		array('value'=>'Gallons', 'label' => __('Gallons', 'real-estate-right-now')),
		)			
	);
    $fields[] = array(
	'type' 	=> 'select',
	'name' 	=> 'realestaterightnow_lenght',
	'label' => __('Feet - Meters','real-estate-right-now'),
	'select_options' => array(
		array('value'=>'Feet', 'label' => __('Feet', 'real-estate-right-now')),
		array('value'=>'Meters', 'label' => __('Meters', 'real-estate-right-now') ),
		)			
	);
 */
	$fields[] =	array(
            	'type' 	=> 'select',
				'name' => 'realestaterightnow_quantity',
				'label' => __('How many properties would you like to display per page?', 'real-estate-right-now'),
				'select_options' => array (
                		array('value'=>'3', 'label' => '3'),
	                	array('value'=>'6', 'label' => '6'),
                		array('value'=>'9', 'label' => '9'),
	                	array('value'=>'12', 'label' => '12'),
	                	array('value'=>'12', 'label' => '15'),
	         	)
 	); 
/*
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Use dedicated Search Results Page').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
*/
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'sidebar_search_page_result',
	'label' => __('Remove Sidebar from Search Result Page','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_overwrite_gallery',
	'label' => __('Replace the Wordpress Gallery with Flexslider Gallery','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_enable_contact_form',
	'label' => __('Enable Contact Form in Single Product Page?','real-estate-right-now'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_show_location',
	'label' => __('Enable Location control in search bar?','real-estate-right-now'),
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);     
$fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'realestaterightnow_recipientEmail',
	'label' => __('Fill out your contact email to receive email from your Contact Form at bottom of the individual Product page.' ,'real-estate-right-now')
    ); 
   $fields[] = array(
	'type' 	=> 'text',
	'name' 	=> 'realestaterightnow_googlemapsapi',
	'label' => __('Optional. Fill out your Google API to use with yours maps (google maps)' ,'real-estate-right-now')
    );   
 $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_template_gallery',
	'label' => __('In Show Room Page, use Gallery or List View Template','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Gallery'),
		array('value'=>'no', 'label' => 'List View'),
		)			
	);  

	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'realestaterightnow_template_gallery',
		'label' => __('In Show Room Page, use Gallery, List View or Grid Template','real-estate-right-now').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Gallery'),
			array('value'=>'list', 'label' => 'List View'),
			array('value' => 'grid', 'label' => 'Grid - Premium Version'),
			)			
		);

$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_image_size',
	'label' => __('In Show Room Page, Template List View or Grid, Choose the thumbnail image size (width) - Premium Version', 'real-estate-right-now') . ':',
	'radio_options' => array(
		array('value' => '300', 'label' =>'300px'),
		array('value' => '350', 'label' =>'350px'),
		array('value' => '400', 'label' =>'400px'),
	)
);


$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_template_single',
	'label' => __('In Single Product Page, use Template', 'real-estate-right-now') . ':',
	'radio_options' => array(
		array('value' => '1', 'label' =>'Model 1'),
		array('value' => '2', 'label' => 'Model 2 (with sidebar) - Premium Version'),
	//	array('value' => '3', 'label' => 'Model 3 '),
	)
);
/*
$fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_auto_updates',
	'label' =>esc_attr__("Enable Auto Update Plugin? (default Yes)", 'real-estate-right-now'),
	'radio_options' => array(
		array('value' => 'Yes', 'label' =>esc_attr__('Yes, enable Real Estate Auto Update', 'real-estate-right-now')),
		array('value' => 'No', 'label' =>esc_attr__('No (unsafe)', 'real-estate-right-now')),
	)
);
*/
//
//


$settings['Real Estate Settings']['Settings']['fields'] = $fields;
//Purpose:
//Beds:
//Baths:
//Location:
//Order By:

$fields = array();


    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_show_purpose',
	'label' => __('Show the Purpose Control','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'realestaterightnow_show_beds',
		'label' => __('Show the Beds Control','real-estate-right-now').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Yes'),
			array('value'=>'no', 'label' => 'No'),
			)			
		);
	$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'realestaterightnow_show_baths',
			'label' => __('Show the Baths Control','real-estate-right-now').'?',
			'radio_options' => array(
				array('value'=>'yes', 'label' => 'Yes'),
				array('value'=>'no', 'label' => 'No'),
				)			
			);

	$fields[] = array(
				'type' 	=> 'radio',
				'name' 	=> 'realestaterightnow_show_location',
				'label' => __('Show the Location Control','real-estate-right-now').'?',
				'radio_options' => array(
					array('value'=>'yes', 'label' => 'Yes'),
					array('value'=>'no', 'label' => 'No'),
					)			
				);


    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_show_orderby',
	'label' => __('Show the Order By Control','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);


	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'realestaterightnow_show_price',
		'label' => __('Show the Price Slider Control','real-estate-right-now').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Yes'),
			array('value'=>'no', 'label' => 'No'),
			)			
		);



$settings['Search']['Search']['fields'] = $fields;

$settings['Widget']['Widget'] = array('info' => __('Customize your Search Widget Options. Choose the fields to show on the Search Widget.','real-estate-right-now'));

//Purpose:
//Beds:
//Baths:
//Location:
//Order By:
$fields = array();
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_widget_show_purpose',
	'label' => __('Show the Purpose Control','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'realestaterightnow_widget_show_beds',
		'label' => __('Show the Beds Control','real-estate-right-now').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Yes'),
			array('value'=>'no', 'label' => 'No'),
			)			
		);
	$fields[] = array(
			'type' 	=> 'radio',
			'name' 	=> 'realestaterightnow_widget_show_baths',
			'label' => __('Show the Baths Control','real-estate-right-now').'?',
			'radio_options' => array(
				array('value'=>'yes', 'label' => 'Yes'),
				array('value'=>'no', 'label' => 'No'),
				)			
			);
	$fields[] = array(
				'type' 	=> 'radio',
				'name' 	=> 'realestaterightnow_widget_show_location',
				'label' => __('Show the Location Control','real-estate-right-now').'?',
				'radio_options' => array(
					array('value'=>'yes', 'label' => 'Yes'),
					array('value'=>'no', 'label' => 'No'),
					)			
				);
    $fields[] = array(
	'type' 	=> 'radio',
	'name' 	=> 'realestaterightnow_widget_show_orderby',
	'label' => __('Show the Order By Control','real-estate-right-now').'?',
	'radio_options' => array(
		array('value'=>'yes', 'label' => 'Yes'),
		array('value'=>'no', 'label' => 'No'),
		)			
	);
	$fields[] = array(
		'type' 	=> 'radio',
		'name' 	=> 'realestaterightnow_widget_show_price',
		'label' => __('Show the Price Slider Control','real-estate-right-now').'?',
		'radio_options' => array(
			array('value'=>'yes', 'label' => 'Yes'),
			array('value'=>'no', 'label' => 'No'),
			)			
		); 

$settings['Widget']['Widget']['fields'] = $fields;


new OptionPageBuilderTabbed($mypage, $settings);
