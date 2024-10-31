<?php /*
Plugin Name: Real Estate Right Now 
Plugin URI: http://realestateplugin.eu
Description: Real Estate Plugin for Real Estate agency.
Version: 4.25
Text Domain:real-estate-right-now
Domain Path: /language
Author: Bill Minozzi
Author URI: http://billminozzi.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
//ob_start();
//error_reporting(E_ALL);
//ini_set('display_errors', 1);

if (!defined('ABSPATH')) exit;
define('REALESTATERIGHTNOWVERSION', '4.24');
define('REALESTATERIGHTNOWPATH', plugin_dir_path(__file__));
define('REALESTATERIGHTNOWURL', plugin_dir_url(__file__));
define('REALESTATERIGHTNOWIMAGES', plugin_dir_url(__file__) . 'assets/images/');
include_once(ABSPATH . 'wp-includes/pluggable.php');
$plugin = plugin_basename(__file__);
/*
if (is_admin()) {
    $path = basename( dirname( __FILE__ ) ) . '/language';
    $loaded = load_plugin_textdomain('real-estate-right-now', false, $path);
    if (!$loaded and get_locale() <> 'en_US') {
      //  if (function_exists('realestaterightnow_localization_init_fail'))
       //     add_action('admin_notices', 'realestaterightnow_localization_init_fail');
    }
} else {
   // add_action('plugins_loaded', 'realestaterightnow_localization_init');
    add_action('plugins_loaded', 'real_estate_rightnow_localization_init', 20);

}
    */
add_filter("plugin_action_links_$plugin", 'realestaterightnow_plugin_settings_link');
require_once(REALESTATERIGHTNOWPATH . "settings/load-plugin.php");
require_once(REALESTATERIGHTNOWPATH . "settings/options/plugin_options_tabbed.php");
//require_once (REALESTATERIGHTNOWPATH . 'includes/contact-form/multi-contact-form.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/help/help.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/functions/functions.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/post-type/meta-box.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/post-type/post-functions.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/templates/template-functions.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/templates/redirect.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/widgets/widgets.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/search/search-function.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/multi/multi.php');
require_once(REALESTATERIGHTNOWPATH . 'dashboard/main.php');
// require_once (REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom1.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/multi/multi-functions.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/contact-form/multi-contact-form.php');
require_once(REALESTATERIGHTNOWPATH . 'assets/inc/aq_resizer.php');
require_once(REALESTATERIGHTNOWPATH . 'includes/team/team.php');

$realestaterightnow_is_admin = realestaterightnow_check_wordpress_logged_in_cookie();


if ($realestaterightnow_is_admin) {
    // require_once (REALESTATERIGHTNOWPATH . 'includes/functions/health.php');
    // require_once (REALESTATERIGHTNOWPATH . 'includes/functions/health_permalink.php');
}
$realestaterightnow_template_gallery = trim(get_option(
    'realestaterightnow_template_gallery',
    'no'
));

$realestaterightnow_auto_updates = trim(get_option('realestaterightnow_auto_updates', 'no'));


if ($realestaterightnow_template_gallery == 'yes')
    require_once(REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom.php');
else
    require_once(REALESTATERIGHTNOWPATH . 'includes/templates/template-showroom1.php');
$realestateurl = esc_url(sanitize_text_field($_SERVER['REQUEST_URI']));
if (strpos($realestateurl, 'product') !== false) {
    $realestaterightnow_overwrite_gallery = strtolower(get_option(
        'realestaterightnow_overwrite_gallery',
        'yes'
    ));
    if ($realestaterightnow_overwrite_gallery == 'yes')
        require_once(REALESTATERIGHTNOWPATH . 'includes/gallery/gallery.php');
}

function realestaterightnow_add_files()
{
    // global $realestaterightnow_is_admin;

    //if ($realestaterightnow_is_admin)
    //    require_once(REALESTATERIGHTNOWPATH . 'dashboard/main.php');

    wp_enqueue_script("jquery");
    wp_enqueue_style('show-room', REALESTATERIGHTNOWURL . 'includes/templates/show-room.css');
    wp_enqueue_style('pluginStyleGeneral', REALESTATERIGHTNOWURL .
        'includes/templates/template-style.css');
    wp_enqueue_style('pluginStyleSearch2', REALESTATERIGHTNOWURL .
        'includes/search/style-search-box.css');
    wp_enqueue_style('pluginStyleSearchwidget', REALESTATERIGHTNOWURL .
        'includes/widgets/style-search-widget.css');
    wp_enqueue_style('pluginStyleGeneral4', REALESTATERIGHTNOWURL .
        'includes/gallery/css/flexslider.css');
    wp_enqueue_style('pluginStyleGeneral5', REALESTATERIGHTNOWURL .
        'includes/contact-form/css/multi-contact-form.css');
    wp_enqueue_style('pluginTeam2', REALESTATERIGHTNOWURL .
        'includes/team/team-custom.css');
    wp_enqueue_style('pluginTeam1', REALESTATERIGHTNOWURL .
        'includes/team/team-custom-bootstrap.css');
    wp_register_style(
        'jqueryuiSkin',
        REALESTATERIGHTNOWURL . 'assets/jquery/jqueryui.css',
        array(),
        '1.12.1'
    );
    wp_enqueue_style('jqueryuiSkin');
    wp_enqueue_style('bill-caricons', REALESTATERIGHTNOWURL . 'assets/icons/icons-style.css');
    wp_enqueue_script('jquery-ui-slider');
    //    wp_enqueue_script('jquery-ui-core');
    wp_register_style('fontawesome-css', REALESTATERIGHTNOWURL . '/assets/fonts/font-awesome/css/font-awesome.min.css', array(), REALESTATERIGHTNOWVERSION);
    wp_enqueue_style('fontawesome-css');
    //  wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );   




}
add_action('wp_enqueue_scripts', 'realestaterightnow_add_files');

add_action('admin_enqueue_scripts', 'realestaterightnow_enqueue_admin_scripts');
function realestaterightnow_enqueue_admin_scripts()
{
    wp_enqueue_script('wp-color-picker');
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('bill-pointer3', REALESTATERIGHTNOWURL . '/dashboard/css/pointer.css');
    wp_enqueue_style('bill-help-realestate', REALESTATERIGHTNOWURL . '/dashboard/css/help.css');
}

function realestaterightnow_activated()
{
    $w = update_option('realestaterightnow_activated', '1');
    if (!$w)
        add_option('realestaterightnow_activated', '1');
    $admin_email = get_option('admin_email');
    $old_admin_email = trim(get_option('realestaterightnow_recipientEmail', ''));
    if (empty($old_admin_email)) {
        $w = update_option('realestaterightnow_recipientEmail', $admin_email);
        if (!$w)
            add_option('realestaterightnow_recipientEmail', $admin_email);
    }
}
register_activation_hook(__file__, 'realestaterightnow_activated');


function realestaterightnow_localization_init()
{
    $path = REALESTATERIGHTNOWPATH . 'language/';
    $locale = apply_filters('plugin_locale', determine_locale(), 'real-estate-right-now');
    // Full path of the specific translation file (e.g., es_AR.mo)
    $specific_translation_path = $path . "real-estate-right-now-$locale.mo";
    $specific_translation_loaded = false;
    // Check if the specific translation file exists and try to load it
    if (file_exists($specific_translation_path)) {
        $specific_translation_loaded = load_textdomain('real-estate-right-now', $specific_translation_path);
        if ($specific_translation_loaded) {
            //error_log("Specific translation loaded successfully: $specific_translation_path");
        } else {
            //error_log("Failed to load specific translation: $specific_translation_path");
        }
    } else {
        //error_log("Specific translation file does not exist: $specific_translation_path");
    }
    // List of languages that should have a fallback to a specific locale
    $fallback_locales = [
        'de' => 'de_DE',  // German
        'fr' => 'fr_FR',  // French
        'it' => 'it_IT',  // Italian
        'es' => 'es_ES',  // Spanish
        'pt' => 'pt_BR',  // Portuguese (fallback to Brazil)
        'nl' => 'nl_NL'   // Dutch (fallback to Netherlands)
    ];
    // If the specific translation was not loaded, try to fallback to the generic version
    if (!$specific_translation_loaded) {
        $language = explode('_', $locale)[0];  // Get only the language code, ignoring the country (e.g., es from es_AR)
        if (array_key_exists($language, $fallback_locales)) {
            // Full path of the generic fallback translation file (e.g., es_ES.mo)
            $fallback_translation_path = $path . "real-estate-right-now-{$fallback_locales[$language]}.mo";
            // Check if the fallback generic file exists and try to load it
            if (file_exists($fallback_translation_path)) {
                $fallback_loaded = load_textdomain('real-estate-right-now', $fallback_translation_path);
                if ($fallback_loaded) {
                    //error_log("Fallback translation loaded successfully:184 $fallback_translation_path");
                } else {
                    //error_log("Failed to load fallback translation: 186  $fallback_translation_path");
                }
            } else {
                //error_log("Fallback translation file does not exist: 189 $fallback_translation_path");
            }
        } else {
            // error_log("No fallback locale defined for language: 192 $language");
        }
    }
}
add_action('plugins_loaded', 'realestaterightnow_localization_init');

function realestateplugin_load_bill_stuff()
{
    global $realestaterightnow_is_admin;
    //wp_enqueue_script('jquery-ui-core');
    if ($realestaterightnow_is_admin) {
        if (isset($_GET['taxonomy']))
            $active_tax = sanitize_text_field($_GET['taxonomy']);
        if (isset($active_tax))
            if ($active_tax == 'agents')
                wp_enqueue_media();
        // did_action( 'wp_enqueue_media' );
    }
}
add_action('wp_loaded', 'realestateplugin_load_bill_stuff');
function realestaterightnow_load_activate()
{
    global $realestaterightnow_is_admin;
    wp_enqueue_script('jquery-ui-core');
    if ($realestaterightnow_is_admin) {
        //require_once (REALESTATERIGHTNOWPATH . 'includes/feedback/activated-manager.php');
        //require_once(REALESTATERIGHTNOWPATH . "includes/feedback/feedback-last.php");
    }
}
//
// add_action('wp_loaded', 'realestaterightnow_load_activate');
add_action('admin_menu', 'realestaterightnow_add_menu_gopro2');
//////////////////////////  CUSTOMIZER PREVIEW  //
function realestaterightnow_add_custom_submenu_page()
{
    add_theme_page(
        'Real_Estate_Designer', // Page title
        'RealEstate Designer',  // Menu title
        'manage_options',  // Capability required to access the page
        'Real_Estate_Designer', // Unique identifier for the page
        '__return_null' // Callback function to display
    );
}
add_action('admin_menu', 'realestaterightnow_add_custom_submenu_page');
function realestaterightnow_plugin_customize_preview_js()
{
    $file =  REALESTATERIGHTNOWURL . 'assets/js/realestaterightnow_customizer-preview.js';
    $r = wp_enqueue_script(
        "my-customize-preview222",
        $file,
        array('jquery'),
        '1.99'
    );
    // Localize script and pass the variable
    $realestaterightnow_previewUrl =  home_url() . '/' . realestaterightnow_find_single_url();
    wp_localize_script('my-customize-preview222', 'realestaterightnow_my_data', array(
        'realestaterightnow_previewUrl' => $realestaterightnow_previewUrl,
    ));
}
add_action('customize_preview_init', 'realestaterightnow_plugin_customize_preview_js');
function realestaterightnow_customize_controls_js()
{
    $file =  REALESTATERIGHTNOWURL . 'js/realestaterightnow_customize_events.js';
    wp_enqueue_script(
        "my-customize-events222",
        REALESTATERIGHTNOWURL . 'assets/js/realestaterightnow_customize_events.js',
        array('jquery'),
        '1.99'
    );
    $file =  REALESTATERIGHTNOWURL . 'assets/js/realestaterightnow_customize-controls.js';
    wp_enqueue_script(
        "my-customize-controls222",
        REALESTATERIGHTNOWURL . 'assets/js/realestaterightnow_customize-controls.js',
        array('customize-preview'),
        '1.99'
    );
    // Localize script and pass the variable
    $realestaterightnow_previewUrl =  home_url() . '/' . realestaterightnow_find_single_url();
    wp_localize_script('my-customize-controls222', 'realestaterightnow_my_data', array(
        'realestaterightnow_previewUrl' => $realestaterightnow_previewUrl,
    ));
}
add_action('admin_enqueue_scripts', 'realestaterightnow_customize_controls_js');
///////////////////////////// find single url
function realestaterightnow_find_single_url()
{
    global $wp;
    //global $query;
    global $wp_query;
    global $wp_the_query;
    $args = array(
        'post_type' => 'products'
    );
    wp_reset_query();
    $car_query = new WP_Query($args);
    $car_posts = get_posts($args);
    if (!isset($car_posts[0]->ID))
        return '-1';
    $post_name = basename(get_permalink($car_posts[0]->ID));
    return $post_name;
}
add_action('plugins_loaded', 'realestaterightnow_last');



function realestaterightnow_check_wordpress_logged_in_cookie()
{
    // Percorre todos os cookies definidos
    foreach ($_COOKIE as $key => $value) {
        // Verifica se algum cookie começa com 'wordpress_logged_in_'
        if (strpos($key, 'wordpress_logged_in_') === 0) {
            // Cookie encontrado
            return true;
        }
    }
    // Cookie não encontrado
    return false;
}

//

function realestaterightnow_new_more_plugins()
{
    $plugin = new realestaterightnow_Bill_show_more_plugins();
    $plugin->bill_show_plugins();
}

function realestaterightnow_bill_more()
{
    global $realestaterightnow_is_admin;
    //if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($realestaterightnow_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_show_more_plugins") !== false) {
                //return;
            }
        }
        require_once dirname(__FILE__) . "/includes/more-tools/class_bill_more.php";
    }
    // }
}
add_action("init", "realestaterightnow_bill_more", 5);

// -------------------------------------


function realestaterightnow_bill_hooking_diagnose()
{
    global $realestaterightnow_is_admin;
    // if (function_exists('is_admin') && function_exists('current_user_can')) {
    if ($realestaterightnow_is_admin and current_user_can("manage_options")) {
        $declared_classes = get_declared_classes();
        foreach ($declared_classes as $class_name) {
            if (strpos($class_name, "Bill_Diagnose") !== false) {
                return;
            }
        }
        $plugin_slug = 'real-estate-right-now';
        $plugin_text_domain = $plugin_slug;
        $notification_url = "https://wpmemory.com/fix-low-memory-limit/";
        $notification_url2 =
            "https://wptoolsplugin.com/site-language-error-can-crash-your-site/";
        require_once dirname(__FILE__) . "/includes/diagnose/class_bill_diagnose.php";
    }
    // } 
}
add_action("init", "realestaterightnow_bill_hooking_diagnose", 10);
//
//



function realestaterightnow_bill_hooking_catch_errors()
{
    global $realestaterightnow_plugin_slug;
    global $realestaterightnow_is_admin;

    $declared_classes = get_declared_classes();
    foreach ($declared_classes as $class_name) {
        if (strpos($class_name, "bill_catch_errors") !== false) {
            return;
        }
    }
    $realestaterightnow_plugin_slug = 'real-estate-right-now';
    require_once dirname(__FILE__) . "/includes/catch-errors/class_bill_catch_errors.php";
}
add_action("init", "realestaterightnow_bill_hooking_catch_errors", 15);

function realestaterightnow_customize_enqueue()
{
    // Enfileirar o estilo do Color Picker
    wp_enqueue_style('wp-color-picker');

    // Enfileirar o script do Color Picker
    wp_enqueue_script('wp-color-picker');

    // Adicionar o seu script de inicialização
    wp_add_inline_script('wp-color-picker', '
        jQuery(document).ready(function($) {
            $(".color-field").wpColorPicker();
        });
    ');
}

add_action('customize_controls_enqueue_scripts', 'realestaterightnow_customize_enqueue');


// ------------------------
