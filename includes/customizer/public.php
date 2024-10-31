<?php
/**
 * Front-facing functionality.
 * 2023-05-31
 */
if ( ! defined( 'ABSPATH' ) ) {
	die();
}
/**
 * Print inline style element.
 *
 */
function realestaterightnow_enqueue_dynamic_styles() {
    // Generate the dynamic CSS code
	$dynamic_styles = realestaterightnow_the_css();
		wp_register_style( 'realestate-dynamic-styles', false ); 
		wp_enqueue_style( 'realestate-dynamic-styles' ); 
		$r = wp_add_inline_style( 'realestate-dynamic-styles', $dynamic_styles ); 
}
 add_action( 'wp_enqueue_scripts', 'realestaterightnow_enqueue_dynamic_styles', 99999 );
function realestaterightnow_enqueue_dynamic_script2() {
	$realestaterightnow_template_button_color =	get_option( 'realestate-template-button-color', 'white' );
	$realestaterightnow_template_button_bkg_color =	get_option( 'realestate-template-button-bkg-color', 'gray' );
	$realestaterightnow_template_button_radius =	get_option( 'realestate-template-button-radius', '0 px' );
	$set_border =  $realestaterightnow_template_button_radius.'px';
	$set_bkg_color = $realestaterightnow_template_button_bkg_color;
	$set_color = $realestaterightnow_template_button_color;
	$realestaterightnow_slider_color =	get_option( 'realestate-search-slider-control-bkg-color', '0 px' );
	$realestaterightnow_template_single_features_border_color = get_option( 'realestate-template-single-features-border-color', 'gray' );
    /*
	$dynamic_script = "
        jQuery(document).ready(function($) {
			var count = $('[id^=\"realestaterightnow_btn_view-\"]').length;
			for (let i = 1; i <= count; i++) {
				let elementId = '#realestaterightnow_btn_view-' + i;
				//console.log(elementId);
				$(elementId).css('background', '$set_bkg_color');
				$(elementId).css('color', '$set_color');
				$(elementId).css('border-radius', '$set_border');
			}
			var setcolor = '1px solid $realestaterightnow_template_single_features_border_color';
			$('.featuredCar').css('border', 'setcolor');
		});
    ";
	*/



	$dynamic_script = "
    jQuery(document).ready(function($) {
        var count = $('[id^=\"realestaterightnow_btn_view-\"]').length;
        for (let i = 1; i <= count; i++) {
            let elementId = '#realestaterightnow_btn_view-' + i;
            //console.log(elementId);
            $(elementId).css('background', '" . esc_js($set_bkg_color) . "');
            $(elementId).css('color', '" . esc_js($set_color) . "');
            $(elementId).css('border-radius', '" . esc_js($set_border) . "');
        }
        var setcolor = '1px solid " . esc_js($realestaterightnow_template_single_features_border_color) . "';
        $('.featuredCar').css('border', setcolor);
  	  });
	";
	
	$dynamic_script = wp_kses( $dynamic_script, array(
		'script' => array(
			'type' => true,
		),
		'var' => array(),
		'for' => array(),
		'let' => array(),
		'console' => array(),
		'id' => array(),
		'length' => array(),
		'background' => array(),
		'color' => array(),
		'border-radius' => array(),
		'featuredCar' => array(),
		'border' => array(),
	));
	$handle = 'dynamic-script';
	wp_register_script( 'realestate-dynamic-script', false ); 
	wp_enqueue_script( 'realestate-dynamic-script' ); 
	wp_add_inline_script( 'realestate-dynamic-script', $dynamic_script );



}
// add_action( 'wp_enqueue_scripts', 'realestaterightnow_enqueue_dynamic_script2','99999' );
/**
 * Echo the CSS.
 *
 */

function realestaterightnow_the_css() {
	?>


<style type='text/css'>
/* Car Template */
.realestate-item-grid { 
   border : 1px solid gray;
}
.realestaterightnow_gallery_2016 { 
   border : 1px solid gray;
}
.sideTitle, .realestaterightnow_caption_img, .realestaterightnow_caption_text, .realestaterightnow_gallery_2016 { 
	border-radius : 6px 6px 0px 0px; 
}
.multiTitle, .sideTitle, .multiTitle-widget, .RealEstateTitle{ 
   background : #636363;
   color: #ffffff; 
}
#realestaterightnow_content { 
	background : #f4f4f4;
}
/* 6-23 */
#container2  { 
  /* background : #f4f4f4; */
}

.multiTitle17, .multiInforightText17  {
	color : #333333;
}
.realestaterightnow_description, #realestaterightnow_content, .multiBasicRow, .multi-content-modal {
	color : #4c4c4c;
}
[id^="realestaterightnow_btn_view-"] {
	width : 110px; ;
}

.realestaterightnow_container17 {
	border-bottom:  1px solid #c4c4c4 ;
}
/* Single Car Template */
#content2 {
	background : #efefef;
}
.multiContent, #content2, .featuredList {
	color : #636363;
}
.featuredTitle {
	color : #ffffff;	
	background : #777777;
	border-radius : graypx graypx 0px 0px ;
}
.featuredCar {
	/* color : #636363; */
	border : 1px solid #999999;
	border-radius : 0px 0px graypx graypx;

}
.featuredList {
	color : #636363;
}
#realestaterightnow_goback, #realestaterightnow_cform  {
	color : #ffffff;	
	background : #777777;
	border-radius : 2px;;
	width: 180px;;	
}
#realestate-submitBtn, #realestate-submitBtn-widget  {
	color : #ffffff;	
	background : #757575;
	border-radius : 4px;;
	width : 190px;;
}
.realestate-search-box {
	background-color : #ffffff;
	border : 0px solid gray;
	border-radius : 0px;;
	border-color : #dd3333;
}
#realestate-search-box {
	margin-bottom: 17px;;
}
.realestate-search-label, .search-label-widget {
	color : #545454;
}
.realestate-select-box-meta, .realestate-select-box-meta-widget  {
	color : #424242;	
	background : #e2e2e2;
	border-radius : 4px;;
}
.realestatelabelprice , #meta_price, .realestatelabelprice2 , #meta_price2 {
  color : #565656;
}
/* slider */
.ui-slider .ui-slider-range{
	/* margin-top: 20px; */
	background : #999999; 
}
.ui-state-default, .ui-widget-content .ui-state-default{
	/* margin-top: 20px; */
	background : #999999; /*!important; */ 
}
#slider-button-0, #slider-button-1, #slider-button-2, #slider-button-3  {
	background: #878787;
	width: 1.0em;
	height: 1.0em;
	border-radius: 50%

}
.realestate-price-slider, .realestate-price-slider2 {
	background: #ededed; 
	border-radius: 4px;;
	border: 1px solid #c1c1c1;
}
#realestate-search-box-widget {
	background: #d3d3d3;	
}
</style>

<?php
}
