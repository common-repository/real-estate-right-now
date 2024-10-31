<?php
/**
 * Customizer functionality.
 *
 */

if (!defined("ABSPATH")) {
    die();
}

function realestaterightnow_customize_register($wp_customize)
{
    $section_id = "bill_section";

    /*            ///  PANEL //////     */
    $r = $wp_customize->add_panel("bill_designer", [
        "title" => esc_html__("Real Estate Custom Design", "real-estate-right-now"),
        "capability" => "edit_theme_options",
        "description" => esc_html__(
            'Click the Templates icon at the top left of the preview window to change your template. To customize further, simply click on any element, or it\'s corresponding shortcut icon, to edit it\'s styling. ',
            "real-estate-right-now"
        ),
        "priority" => 150,
    ]);
    /*            ///  END PANEL //////             */

    /*            ///   SECTION HELP  //////     */

    $section_id = "realestaterightnow_help_section";
    $wp_customize->add_section($section_id, [
        "title" => __("Help", "real-estate-right-now"),
        "capability" => "manage_options",
        "panel" => "bill_designer",
    ]);

    function realestaterightnow_customize_render_section($section)
    {
        echo '<div style="text-align: center;">';

        submit_button("Help", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://realestateplugin.eu/help/#11", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);
        echo "&nbsp;&nbsp;&nbsp;";
        submit_button("Demo Video", "secondary", "submit_button_id", false, [
            "onclick" =>
                'window.open("https://realestateplugin.eu/movies/customizer.mp4", "_blank"); return false;',
            "style" => "margin-bottom: 15px",
        ]);

        echo "</div>";
    }
    add_action(
        "customize_render_section_realestaterightnow_help_section",
        "realestaterightnow_customize_render_section"
    );

    // Section Template //
    $section_id = "template name";
    $wp_customize->add_section($section_id, [
        "title" => __("Templates", "real-estate-right-now") . " (2 FREE)",
        "capability" => "manage_options",
        "description" => __(
            "Choose the Real Estate Template to Use.",
            "real-estate-right-now"
        ),
        "panel" => "bill_designer",
    ]);
    /*            ///   END SECTION  //////     */


    // Single Property Section Template //
        $section_id = "single_car_template_name";
        $wp_customize->add_section($section_id, [
            "title" => __("Single Property Templates", "real-estate-right-now") . " (1 FREE)",
            "capability" => "manage_options",
            "description" => __(
                "Choose the Single Property Template to Use.",
                "real-estate-right-now"
            ),
            "panel" => "bill_designer",
        ]);
    /*            ///   END Single Property SECTION  //////     */



    $section_id = "search Box";
    $wp_customize->add_section($section_id, [
        "title" => __("Search Box LayOut", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Design the Search Box", "real-estate-right-now"),
        "panel" => "bill_designer",
    ]);


    $wp_customize->add_section("fields", [
        "title" => __("Search Box Fields", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Manage the Design fields", "real-estate-right-now"),
        "panel" => "bill_designer",
    ]);

    $wp_customize->add_section("slider", [
        "title" => __("Search Box Slider", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the price Slider.", "real-estate-right-now"),
        "panel" => "bill_designer",
    ]);

    $wp_customize->add_section("button", [
        "title" => __("Search Box Button", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Search Box Button.", "real-estate-right-now"),
        "panel" => "bill_designer",
    ]);

    $wp_customize->add_section("template", [
        "title" => __("Property Template and Widgets", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Property Template and Widgets.",
            "real-estate-right-now"
        ),
        "panel" => "bill_designer",
    ]);

    $wp_customize->add_section("template-single", [
        "title" => __("Single Property Template", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __("Customize the Single Property Template.", "real-estate-right-now"),
        "panel" => "bill_designer",
    ]);

    $wp_customize->add_section("back-contact-us", [
        "title" => __("Buttons Back and Contact Us", "real-estate-right-now") . " (PRO)",
        "capability" => "manage_options",
        "description" => __(
            "Customize the Buttons Back and Contact Us.",
            "real-estate-right-now"
        ),
        "panel" => "bill_designer",
    ]);

    /* --------------------- END SECTIONS ---------------------- */

    /*    -------------  Fields --------------- */

    $wp_customize->add_setting("meu_plugin_help_link_setting", [
        "type" => "option",
    ]);

    $wp_customize->add_control("meu_plugin_help_link", [
        "label" => "Link de Ajuda aberto em nova janela.",
        "section" => "realestaterightnow_help_section",
        "settings" => "meu_plugin_help_link_setting",
        "type" => "url",
    ]);

    // exemplo de radio com PRO
    // Add a new setting
    $wp_customize->add_setting("myplugin_setting", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
/*
    $wp_customize->add_control("k_layout_type", [
        "section" => "fields",
        "settings" => "myplugin_setting",
        "type" => "radio",
        "label for" => __("Website Layout", "kardealer") . " -only pro-",
        "description" => "",
        "choices" => [
            "3" => "Boxed Width 1200px",
            "1" => "Boxed Width 1000px",
            "2" => "Wide",
        ],
    ]);

         ///   ADD PRO TO CONTROL   ///  */

    /*
    function realestaterightnow_customize_render_control($control)
    {
      
        ?>
			  <div>This is my custom content for the "My Plugin Setting" control.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php


    }
    add_action(
        "customize_render_control_k_layout_type",
        "realestaterightnow_customize_render_control"
    );
    */

    /*  		///   END ADD PRO TO CONTROL   ///  */

    $wp_customize->add_setting("realestate-search-label", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-label", [
        "label" => __("Search Fields Label Color", "real-estate-right-now"),
        "section" => "fields",
        "settings" => "realestate-search-label",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-select-box-meta-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-select-box-meta-color", [
        "label" => __("Search Fields Controls Color", "real-estate-right-now"),
        "section" => "fields",
        "settings" => "realestate-select-box-meta-color",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-search-fields-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-fields-control-bkg-color", [
        "label" => __("Search Fields Controls Background Color", "real-estate-right-now"),
        "section" => "fields",
        "settings" => "realestate-search-fields-control-bkg-color",
        "type" => "color",
    ]);

    //View Fields round
    $wp_customize->add_setting("realestate-search-fields-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-fields-radius", [
        "type" => "range",
        "section" => "fields",
        "settings" => "realestate-search-fields-radius",
        "label" => __("Search Fields Controls Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    // Flexslider

    $wp_customize->add_setting("realestate-search-slider-label-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-slider-label-color", [
        "label" => __("Search Slider Label Color", "real-estate-right-now"),
        "section" => "slider",
        "settings" => "realestate-search-slider-label-color",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-search-slider-control-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-slider-control-color", [
        "label" => __("Search Slider Color", "real-estate-right-now"),
        "section" => "slider",
        "settings" => "realestate-search-slider-control-color",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-search-slider-handle-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-slider-handle-color", [
        "label" => __("Search Slider Handle Color", "real-estate-right-now"),
        "section" => "slider",
        "settings" => "realestate-search-slider-handle-color",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-search-slider-control-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-slider-control-bkg-color", [
        "label" => __("Search Slider Background Color", "real-estate-right-now"),
        "section" => "slider",
        "settings" => "realestate-search-slider-control-bkg-color",
        "type" => "color",
    ]);

    //View Fields round

    $wp_customize->add_setting("realestate-search-slider-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-slider-radius", [
        "type" => "range",
        "section" => "slider",
        "label" => __("Search Slider Border Radius" , "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    // Slider Border Color
    $wp_customize->add_setting("realestate-search-slider-border-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-slider-border-color", [
        "label" => __("Search Slider Border Color", "real-estate-right-now"),
        "section" => "slider",
        "settings" => "realestate-search-slider-border-color",
        "type" => "color",
    ]);

    /*    -------------  END BUTTONS -------- */

    /*    -------------  BUTTON -------- */
    //Button Background

    //Button Color
    $wp_customize->add_setting("realestate-search-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-button-color", [
        "label" => __("Search Box Button Text Color", "real-estate-right-now"),
        "section" => "button",
        "settings" => "realestate-search-button-color",
        "type" => "color",
    ]);

    //Button Background
    $wp_customize->add_setting("realestate-search-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-button-bkg-color", [
        "label" => __("Search Box Button Background Color", "real-estate-right-now"),
        "section" => "button",
        "settings" => "realestate-search-button-bkg-color",
        "type" => "color",
    ]);

    //Search  Button width
    $wp_customize->add_setting("realestate-search-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-button-width", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Width", "real-estate-right-now"),
        "description" => __("Button width: from 100 to 300.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);

    $wp_customize->add_setting("realestate-search-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-button-radius", [
        "type" => "range",
        "section" => "button",
        "label" => __("Search Box Button Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    /*    -------------  END BUTTON -------- */

    /*    -------------  SLIDER -------- */

    /*    -------------  END SLIDER -------- */

    /*    -------------  TEMPLATE -------- */

    // choose template type
    $wp_customize->add_setting("realestaterightnow_template_gallery", [
        "default" => "",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage", // 'refresh',
    ]);

    $wp_customize->add_control("realestaterightnow_template_gallery", [
        "section" => "template name",
        "settings" => "realestaterightnow_template_gallery",
        "type" => "radio",
        "label" => __("Template Name", "real-estate-right-now"),
        "description" => "",
        "choices" => [
            "yes" => "Gallery",
            "list" => "List View",
            "grid" => "Grid",
        ],
    ]);

    function realestaterightnow_customize_render_control($control)
    {
      
        ?>
			  <div>Template Grid is Pro. You can use, for free, Gallery and List View.</div><div class="bill_pro" style="background:#ffab4a;border-radius: 50px;
			color: #fff; width:50px; text-align: center; padding-bottom: 4px; valign:middle;">pro</div>
			  <?php


    }
    add_action(
        "customize_render_control_realestaterightnow_template_gallery",
        "realestaterightnow_customize_render_control"
    );

    //$section_id = "single_Propertytemplate name";

        // choose Single Property template type
        $wp_customize->add_setting("realestaterightnow_template_single", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
    
        $wp_customize->add_control("realestaterightnow_template_single", [
            "section" => "single_car_template_name",
            "settings" => "realestaterightnow_template_single",
            "type" => "radio",
            "label" => __("Single Property Template Name", "real-estate-right-now"),
            "description" => "",
            "choices" => [
                '1'=> 'Model 1 (free)',
				'2'=> 'Model 2 (with sidebar) (pro)',
            ],
        ]);

        // choose Single Property template type
        $wp_customize->add_setting("realestaterightnow_modal_size", [
            "default" => "",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage", // 'refresh',
        ]);
    
        $wp_customize->add_control("realestaterightnow_modal_size", [
            "section" => "single_car_template_name",
            "settings" => "realestaterightnow_modal_size",
            "type" => "radio",
            "label" => __("Single Property Template Pop Up Modal Width", "real-estate-right-now"),
            "description" => "",
            "choices" => [
                '1'=> '800 px',
				'2'=> '900 px',
				'3'=> '1000 px',
            ],
        ]);



    //Text template page Color
    $wp_customize->add_setting("realestate-template-fg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-fg-color", [
        "label" => __("Template Text Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-fg-color",
        "type" => "color",
    ]);

    //Background template page
    $wp_customize->add_setting("realestate-template-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-bk-color", [
        "label" => __("Template Background Color (works with templates gallery and list view)", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-bk-color",
        "type" => "color",
    ]);

    //Text template title Color
    $wp_customize->add_setting("realestate-template-title-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-title-color", [
        "label" => __("Template Title Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-title-color",
        "type" => "color",
    ]);

    //View Button Color
    $wp_customize->add_setting("realestate-template-button-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-button-color", [
        "label" => __("Template Button View Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-button-color",
        "type" => "color",
    ]);

    //View Button Background Color
    $wp_customize->add_setting("realestate-template-button-bkg-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-button-bkg-color", [
        "label" => __("Template Button View Background Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-button-bkg-color",
        "type" => "color",
    ]);

    //View Button round
    $wp_customize->add_setting("realestate-template-button-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-button-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    //View Button width
    $wp_customize->add_setting("realestate-template-button-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-button-width", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Button View Width", "real-estate-right-now"),
        "description" => __("Button width: from 100 to 300.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);

    //Theme List View Separator
    $wp_customize->add_setting("realestate-template-list-separator", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-list-separator", [
        "label" => __("Template List View Separator Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-list-separator",
        "type" => "color",
    ]);

    //Theme Grid Border
    $wp_customize->add_setting("realestate-template-grid-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    // grid border ...
    $wp_customize->add_control("realestate-template-grid-border", [
        "label" => __("Template Grid Border Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-grid-border",
        "type" => "color",
    ]);

    //Theme Gallery Border color
    $wp_customize->add_setting("realestate-template-gallery-border", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-gallery-border", [
        "label" => __("Template Gallery and Widgets Border Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-gallery-border",
        "type" => "color",
    ]);

    //Theme Gallery Border color
    $wp_customize->add_setting("realestate-template-gallery-border-radius", [
        "default" => "5",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-gallery-border-radius", [
        "type" => "range",
        "section" => "template",
        "label" => __("Template Gallery and Widgets Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    $wp_customize->add_setting("realestate-template-gallery-title", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-gallery-title", [
        "label" => __("Template Gallery and Widgets Title Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-template-gallery-title",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-template-gallery-title-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-gallery-title-bkg", [
        "label" => __(
            "Template Gallery and Widgets Title Background Color",
            "real-estate-right-now"
        ),
        "section" => "template",
        "settings" => "realestate-template-gallery-title-bkg",
        "type" => "color",
    ]);

    $wp_customize->add_setting("realestate-widget-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-widget-bkg", [
        "label" => __("Widget Search Background Color", "real-estate-right-now"),
        "section" => "template",
        "settings" => "realestate-widget-bkg",
        "type" => "color",
    ]);

    /*    -------------  END TEMPLATE -------- */

    /*    -------------  Single Property -------- */

    //single Background
    $wp_customize->add_setting("realestate-template-single-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-single-bk-color", [
        "label" => __("Single Property Template Background Color", "real-estate-right-now"),
        "section" => "template-single",
        "settings" => "realestate-template-single-bk-color",
        "type" => "color",
    ]);

    //single color
    $wp_customize->add_setting("realestate-template-single-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-single-color", [
        "label" => __("Single Property Template Color", "real-estate-right-now"),
        "section" => "template-single",
        "settings" => "realestate-template-single-color",
        "type" => "color",
    ]);

    // features background
    $wp_customize->add_setting("realestate-template-single-features-bkg", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-single-features-bkg", [
        "label" => __(
            "Single Property Template Features Title Background Color",
            "real-estate-right-now"
        ),
        "section" => "template-single",
        "settings" => "realestate-template-single-features-bkg",
        "type" => "color",
    ]);

    //features color
    $wp_customize->add_setting("realestate-template-single-features-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-template-single-features-color", [
        "label" => __("Single Property Template Features Title Color", "real-estate-right-now"),
        "section" => "template-single",
        "settings" => "realestate-template-single-features-color",
        "type" => "color",
    ]);

    //features Border
    $wp_customize->add_setting(
        "realestate-template-single-features-border-color",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );

    $wp_customize->add_control(
        "realestate-template-single-features-border-color",
        [
            "label" => __(
                "Single Property Template Features Border Color",
                "real-estate-right-now"
            ),
            "section" => "template-single",
            "settings" => "realestate-template-single-features-border-color",
            "type" => "color",
        ]
    );

    // Border radius
    $wp_customize->add_setting(
        "realestate-template-single-features-border-radius",
        [
            "default" => "#ffffff",
            "sanitize_callback" => "sanitize_text_field",
            "type" => "option",
            "transport" => "postMessage",
        ]
    );
    $wp_customize->add_control(
        "realestate-template-single-features-border-radius",
        [
            "type" => "range",
            "section" => "template-single",
            "label" => __("Features Border Radius", "real-estate-right-now"),
            "description" => __("Features Border Radius: from 0 to 30.", "real-estate-right-now"),
            "settings" => "realestate-template-single-features-border-radius",
            "input_attrs" => [
                "min" => 0,
                "max" => 30,
                "step" => 1,
            ],
        ]
    );

    /*    -------------  END Single Property -------- */

    // Layout
    //Search Background
    $wp_customize->add_setting("realestate-search-box-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);


    $wp_customize->add_control("realestate-search-box-bk-color", [
        "label" => __("Background Color", "real-estate-right-now"),
        "section" => "search Box",
        "settings" => "realestate-search-box-bk-color",
        "type" => "color",
    ]);

    // Border size
    $wp_customize->add_setting("realestate-search-box-border-size", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-box-border-size", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Size", "real-estate-right-now"),
        "description" => __(
            "Border Size: from 0 to 5. Mark 0 to hide the Boarder.",'real-estate-right-now'),
        "input_attrs" => [
            "min" => 0,
            "max" => 5,
            "step" => 1,
        ],
    ]);

    // Border radius
    $wp_customize->add_setting("realestate-search-box-border-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);
    $wp_customize->add_control("realestate-search-box-border-radius", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 1 to 70px.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    //Search Border Color
    $wp_customize->add_setting("realestate-search-box-border-color", [
        "default" => "#cccccc",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-box-border-color", [
        "label" => __("Border Color", "real-estate-right-now"),
        "section" => "search Box",
        "settings" => "realestate-search-box-border-color",
        "type" => "color",
    ]);

    // Margin Bottom
    $wp_customize->add_setting("realestate-search-box-margin-bottom", [
        "default" => "25",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-search-box-margin-bottom", [
        "type" => "range",
        "section" => "search Box",
        "label" => __("Margin Bottom", "real-estate-right-now"),
        "description" => __("Margin Bottom: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 70,
            "step" => 1,
        ],
    ]);

    // end layout

    /*    -------------  Go Back and Contact Us BUTTONs -------- */

    //Button Color
    $wp_customize->add_setting("realestate-back-contact-buttons-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-back-contact-buttons-color", [
        "label" => __("Back and Contact Us Buttons Color", "real-estate-right-now"),
        "section" => "back-contact-us",
        "settings" => "realestate-back-contact-buttons-color",
        "type" => "color",
    ]);

    //Button Background
    $wp_customize->add_setting("realestate-back-contact-buttons-bk-color", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
    ]);

    $wp_customize->add_control("realestate-back-contact-buttons-bk-color", [
        "label" => __(
            "Back and Contact Us Buttons Background Color",
            "real-estate-right-now"
        ),
        "section" => "back-contact-us",
        "settings" => "realestate-back-contact-buttons-bk-color",
        "type" => "color",
    ]);

    //realestate-back-contact-buttons-width

    $wp_customize->add_setting("realestate-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "realestaterightnow_customizer_callback", // sua callback function personalizada
    ]);

    $wp_customize->add_control("realestate-back-contact-buttons-width", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons width", "real-estate-right-now"),
        "description" => __("Border Radius: from 100 to 300.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 100,
            "max" => 300,
            "step" => 10,
        ],
    ]);

    $wp_customize->add_setting("realestate-back-contact-buttons-width", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "realestaterightnow_customizer_callback", // sua callback function personalizada
    ]);

    //realestate-back-contact-buttons-radius
    $wp_customize->add_setting("realestate-back-contact-buttons-radius", [
        "default" => "#ffffff",
        "sanitize_callback" => "sanitize_text_field",
        "type" => "option",
        "transport" => "postMessage",
        "my_callback" => "realestaterightnow_customizer_callback", // sua callback function personalizada
    ]);
    $wp_customize->add_control("realestate-back-contact-buttons-radius", [
        "type" => "range",
        "section" => "back-contact-us",
        "label" => __("Back and Contact Us Buttons Border Radius", "real-estate-right-now"),
        "description" => __("Border Radius: from 0 to 30.", "real-estate-right-now"),
        "input_attrs" => [
            "min" => 0,
            "max" => 30,
            "step" => 1,
        ],
    ]);

    function realestaterightnow_customizer_callback($value)
    {
        // código para tratar as atualizações do setting
    }

    /*    -------------  END BUTTONS -------- */
}

add_action("customize_register", "realestaterightnow_customize_register", 11);
