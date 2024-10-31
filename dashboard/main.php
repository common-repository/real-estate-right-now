<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2023
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
// ob_start();
define('REALESTATERIGHTNOWHOMEURL', admin_url());
// admin_url() 
// Admin URL	admin_url()	Wrapper for get_site_url(). Takes multisite into consideration. Everything in the 'wp-admin/' folder. Filtered by site_url and later the admin_url filter callbacks.
// http://wpkrauts.com/2015/the-guide-to-wordpress-path-and-urls/
$realestaterightnow_urlfields = REALESTATERIGHTNOWHOMEURL . "/edit.php?post_type=realestatefields";
$realestaterightnow_urlproducts = REALESTATERIGHTNOWHOMEURL . "/edit.php?post_type=products";
$realestaterightnow_urllocations = REALESTATERIGHTNOWHOMEURL . "/edit-tags.php?taxonomy=locations&post_type=products";
$realestaterightnow_urlagents =  REALESTATERIGHTNOWHOMEURL . "/edit-tags.php?taxonomy=agents&post_type=products";
$realestaterightnow_urlsettings = REALESTATERIGHTNOWHOMEURL . "/options.php?page=rep_settings";
add_action('admin_init', 'realestaterightnow_settings_init');
add_action('admin_menu', 'realestaterightnow_add_admin_menu');


function realestaterightnow_fields_callback()
{
    global $realestaterightnow_urlfields;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($realestaterightnow_urlfields); ?>";
        -->
    </script>
<?php
}
function realestaterightnow_products_callback()
{
    global $realestaterightnow_urlproducts;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($realestaterightnow_urlproducts); ?>";
        -->
    </script>
<?php
}
function realestaterightnow_agents_callback()
{
    global $realestaterightnow_urlagents;
    //    die($realestaterightnow_urlagents);
    //http://realestateplugin.eu/wp-admin/edit-tags.php?taxonomy=agents&post_type=products    
    //                          /wp-admin/edit-tags.php?taxonomy=agents&post_type=products
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($realestaterightnow_urlagents); ?>";
        -->
    </script>
<?php
}
function realestaterightnow_locations_callback()
{
    global $realestaterightnow_urllocations;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($realestaterightnow_urllocations); ?>";
        -->
    </script>
<?php
}
function realestaterightnow_settings_callback()
{
    global $realestaterightnow_urlsettings;
?>
    <script type="text/javascript">
        <!--
        window.location = "<?php echo esc_url($realestaterightnow_urlsettings); ?>";
        -->
    </script>
<?php
}
function realestaterightnow_add_admin_menu()
{
    //   global $vmtheme_hook;
    //   $vmtheme_hook = add_theme_page( 'For Dummies', 'For Dummies Help', 'manage_options', 'for_dummies', 'realestaterightnow_options_page' );
    //   add_action('load-'.$vmtheme_hook, 'vmtheme_contextual_help');     
    global $menu;
    add_menu_page(
        'Real Estate',
        'Real Estate',
        'manage_options',
        'real_estate_plugin',
        'realestaterightnow_options_page',
        REALESTATERIGHTNOWURL . 'assets/images/home_icon.png',
        '30'
    );
    include_once(ABSPATH . 'wp-includes/pluggable.php');
    $link_our_new_CPT = urlencode('edit.php?post_type=realestatefields');
    add_submenu_page('real_estate_plugin', 'Fields Table', 'Fields Table', 'manage_options', 'fields-table', 'realestaterightnow_fields_callback');
    add_submenu_page('real_estate_plugin', 'Properties Table', 'Properties Table', 'manage_options', 'products-table', 'realestaterightnow_products_callback');
    add_submenu_page('real_estate_plugin', 'Agents', 'Agents', 'manage_options', 'md-agents', 'realestaterightnow_agents_callback');
    add_submenu_page('real_estate_plugin', 'Locations', 'Locations', 'manage_options', 'md-locations', 'realestaterightnow_locations_callback');
    add_submenu_page('real_estate_plugin', 'Settings', 'Settings', 'manage_options', 'rep-settings', 'realestaterightnow_settings_callback');

    add_submenu_page('real_estate_plugin', 'RealEstate Designer', 'RealEstate Designer', 'manage_options', 'md-designer2', 'realestaterightnow_designer_callback', 7);
}

function realestaterightnow_designer_callback()
{
    if (strpos(wp_get_referer(), 'bill_designer') == false) {
        $realestaterightnow_temp = home_url() . '/wp-admin/customize.php?autofocus[panel]=bill_designer';
    } else {
        $realestaterightnow_temp = home_url() . '/wp-admin/index.php?customize_changeset_uuid=';
    }
    echo '<script>';
    echo 'window.location.href = "' . esc_url($realestaterightnow_temp) . '";';
    echo '</script>';
}


function realestaterightnow_settings_init()
{
    register_setting('real-estate-right-now', 'realestaterightnow_settings');
}
function realestaterightnow_options_page()
{
    global $realestaterightnow_activated, $realestaterightnow_update_theme;
    $wpversion = get_bloginfo('version');
    $current_user = wp_get_current_user();
    $plugin = plugin_basename(__FILE__);
    $email = $current_user->user_email;
    $username =  trim($current_user->user_firstname);
    $user = $current_user->user_login;
    $user_display = trim($current_user->display_name);
    if (empty($username))
        $username = $user;
    if (empty($username))
        $username = $user_display;
    $theme = wp_get_theme();
    $themeversion = $theme->version;
?>
    <!-- Begin Page -->
    <div id="realestate-theme-help-wrapper">
        <div id="realestate-not-activated"></div>
        <div id="realestate-logo">
            <img alt="logo" src="<?php echo esc_url(REALESTATERIGHTNOWIMAGES); ?>logosmall.png" />
        </div>

        <div id="realestate-social">
            <a href="http://realestateplugin.eu/share/"><img alt="social bar" src="<?php echo esc_url(REALESTATERIGHTNOWIMAGES); ?>/social-bar.png" width="250px" /></a>
        </div>

        <div id="realestaterightnow_help_title">
            <?php esc_attr_e("Help and Support Page", "real-estate-right-now"); ?>
        </div>




        <?php
        if (isset($_GET['tab']))
            $active_tab = sanitize_text_field($_GET['tab']);
        else
            $active_tab = 'dashboard';
        ?>
        <h2 class="nav-tab-wrapper">
            <a href="?page=real_estate_plugin&tab=memory&tab=dashboard" class="nav-tab">Dashboard</a>
            <a href="?page=real_estate_plugin&tab=memory" class="nav-tab">Memory Check Up</a>
            <a href="?page=real_estate_plugin&tab=tools" class="nav-tab">More Tools</a>
        </h2>
    <?php


    echo '<div id="realestaterightnow-dashboard-wrap">';
    echo '<div id="realestaterightnow-dashboard-left">';

    if ($active_tab == 'memory') {
        require_once(REALESTATERIGHTNOWPATH . 'dashboard/memory.php');
    } elseif ($active_tab == "tools") {
        $plugin = new realestaterightnow_Bill_show_more_plugins();
        $plugin->bill_show_plugins();
    } else {
        require_once(REALESTATERIGHTNOWPATH . 'dashboard/dashboard.php');
    }
    echo '</div> <!-- "realestate-theme_help-wrapper"> -->';
    //} // end Function realestaterightnow_options_page
    require_once(ABSPATH . 'wp-admin/includes/screen.php');
    // ob_end_clean();
    include_once(ABSPATH . 'wp-includes/pluggable.php');



    echo '</div> <!-- "realestaterightnow-dashboard-left"> -->';
    echo '<div id="realestaterightnow-dashboard-right">';
    echo '<div id="realestaterightnow-containerright-dashboard">';
    require_once(REALESTATERIGHTNOWPATH . 'dashboard/mybanners.php');
    echo '</div>';
    echo '</div> <!-- "realestaterightnow-dashboard-right"> -->';
    echo '</div> <!-- "realestaterightnow-dashboard-wrap"> -->';
} // end Function realestaterightnow_options_page





if (! function_exists('$realestaterightnow_bill_theme')) {
    function realestaterightnow_bill_theme()
    {
        $my_theme = wp_get_theme();
        $theme = trim($my_theme->get('Name'));
        $mythemes = array(
            'boatdealer',
            'KarDealer',
            'verticalmenu',
            'fordummies',
            'Real Estate Right Now',
            'boatseller'
        );
        $count = count($mythemes);
        $theme =  strtolower(trim($theme));
        for ($i = 0; $i < $count; $i++) {
            if ($theme == strtolower(trim($mythemes[$i])))
                return true;
        }
        return false;
    }
}
    ?>