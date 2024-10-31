<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly 
}

$realestaterightnow_memory = realestaterightnow_check_memory();
echo '<div id="realestate-memory-page">';
echo '<div class="realestate-block-title">';

if ($realestaterightnow_memory['msg_type'] == 'notok') {
    esc_attr_e("Unable to get your Memory Info", 'real-estate-right-now');
    echo '</div>';
} else {
    esc_attr_e("Memory Info", 'real-estate-right-now');
    echo '</div>';
    echo '<div id="memory-tab">';
    echo '<br />';

    if ($realestaterightnow_memory['msg_type'] == 'ok') {
        $mb = 'MB';
    } else {
        $mb = '';
    }

    if ($realestaterightnow_memory['limit'] > 9999) {
        $realestaterightnow_memory['limit'] = ($realestaterightnow_memory['limit'] / 1024);
        $mbl = 'TB';
    } else {
        $mbl = 'MB';
    }

    echo esc_attr__("Current memory WordPress Limit:", 'real-estate-right-now') . ' ' . esc_attr($realestaterightnow_memory['wp_limit']) . esc_attr($mb) .
        '&nbsp;&nbsp;&nbsp;  |&nbsp;&nbsp;&nbsp;';
    $perc = $realestaterightnow_memory['usage'] / $realestaterightnow_memory['wp_limit'];

    if ($perc > .7) {
        echo '<span style="' . esc_attr($realestaterightnow_memory['color']) . ';">';
    }

    echo esc_attr__("Your usage now:", 'real-estate-right-now') . ' ' . esc_attr($realestaterightnow_memory['usage']) . 'MB &nbsp;&nbsp;&nbsp;';

    if ($perc > .7) {
        echo '</span>';
    }

    echo '|&nbsp;&nbsp;&nbsp;' . esc_attr__("Total Server Memory:", 'real-estate-right-now') . ' ' . esc_attr($realestaterightnow_memory['limit']) . esc_attr($mbl);

    echo '<br /><br /><br />';

    ///////////////////////////
    // Fix it...

    echo esc_attr__("If you want adjust and control your WordPress Memory Limit and PHP Memory Limit quickly, try our free plugin WPmemory:", 'real-estate-right-now');

    echo '<br />';
    echo '<a href="https://wordpress.org/plugins/wp-memory/">' . esc_attr__("Learn More", 'real-estate-right-now') . '</a>';

    echo '<br /><br />';
    echo '<hr>';

    esc_attr_e("Follow these instructions to do it manually:", 'real-estate-right-now');

    echo '<br /><br />';
?>

    <strong>
        <?php esc_attr_e("To increase the WordPress memory limit, add this info to your file wp-config.php (located at the root folder of your server)", 'real-estate-right-now'); ?>
    </strong>
    <br />
    <?php esc_attr_e("(just copy and paste)", 'real-estate-right-now'); ?>

    <br /><br />
    <strong>
        define('WP_MEMORY_LIMIT', '128M');
    </strong>
    <br /><br />

    <?php esc_attr_e("before this line:", 'real-estate-right-now'); ?>

    <br />
    /* That's all, stop editing! Happy blogging. */
    <br /><br />

    <?php esc_attr_e("If you need more, just replace 128 with the new memory limit.", 'real-estate-right-now'); ?>

    <br /><br />

    <?php esc_attr_e("To increase your total server memory, talk with your hosting company.", 'real-estate-right-now'); ?>

    <br /><br />
    <hr />

    <br />
    <strong>
        <?php esc_attr_e("How to Tell if Your Site Needs More Memory:", 'real-estate-right-now'); ?>
    </strong>
    <br /><br />

    <?php esc_attr_e("If your site is behaving slowly, pages fail to load, you get random white screens of death or 500 internal server errors, you may need more memory.", 'real-estate-right-now'); ?>
    <br />

    <?php esc_attr_e("Several things consume memory, such as WordPress itself, installed plugins, the theme, and the content of your site.", 'real-estate-right-now'); ?>
    <br />

    <?php esc_attr_e("Basically, the more content and features you add to your site, the larger your memory limit needs to be.", 'real-estate-right-now'); ?>
    <br /><br />

    <?php esc_attr_e("If you're running a small site with basic functions, you may not need to increase your memory limit. But once you start using premium themes or plugins, or encounter unexpected issues, it's time to adjust your memory limit.", 'real-estate-right-now'); ?>
    <br /><br />



    </div>
    </div>
<?php
}
?>