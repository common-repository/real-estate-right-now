<?php

/**
 * @author William Sergio Minozzi
 * @copyright 2017
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly
?>

<div id="realestate-services3">
    <div class="realestate-block-title">
        <?php esc_attr_e("Server Check", "real-estate-right-now"); ?>
    </div>

    <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
            <h3><?php esc_attr_e("Memory Status", "real-estate-right-now"); ?></h3>
            <?php
            $ds = 256;
            $du = 60;
            $realestaterightnow_memory = realestaterightnow_check_memory();
            if ($realestaterightnow_memory['msg_type'] == 'notok') {
                echo esc_attr_e('Unable to get your Memory Info', 'real-estate-right-now');
            } else {
                $ds = $realestaterightnow_memory['wp_limit'];
                $du = $realestaterightnow_memory['usage'];
                if ($ds > 0) {
                    $perc = number_format(100 * $du / $ds, 2);
                } else {
                    $perc = 0;
                }
                if ($perc > 100) {
                    $perc = 100;
                }
                $color = '#e87d7d';
                $color = '#029E26';
                if ($perc > 50) {
                    $color = '#e8cf7d';
                }
                if ($perc > 70) {
                    $color = '#ace97c';
                }
                if ($perc > 50) {
                    $color = '#F7D301';
                }
                if ($perc > 70) {
                    $color = '#ff0000';
                }
                echo '<p><li style="max-width:50%;font-weight:bold;padding:5px 15px;border-radius:4px;-moz-border-radius:4px;-webkit-border-radius:4px;background-color:#0073aa;margin-left:13px;color:white;">' .
                    esc_attr__('Memory Usage', 'real-estate-right-now') . '<div style="border:1px solid #ccc;background:white;width:100%;margin:2px 5px 2px 0;padding:1px">' .
                    '<div style="width: ' . esc_attr($perc) . '%;background-color:' . esc_attr($color) .
                    ';height:6px"></div></div>' . esc_attr($du) . ' ' . esc_attr__('of', 'real-estate-right-now') . ' ' . esc_attr($ds) . ' MB ' . esc_attr__('Usage', 'real-estate-right-now') . '</li>';
            } ?>
            <br><br>
            <?php esc_attr_e("For details, click the Memory Checkup Tab above.", "real-estate-right-now"); ?>
            <br><br>
        </div>

        <div class="realestate-help-column realestate-help-column-2">
            <h3><?php esc_attr_e("Permalink Settings", "real-estate-right-now"); ?></h3>
            <?php
            $permalinkopt = get_option('permalink_structure');
            if ($permalinkopt != '/%postname%/') { ?>
                <img alt="aux" width="40px" src="<?php echo esc_attr(REALESTATERIGHTNOWURL) ?>assets/images/noktick.png" />
                <br>
                <br>
                <?php esc_attr_e("Wrong Permalink settings!", "real-estate-right-now"); ?>
                <br>
                <?php esc_attr_e("Please, fix it to avoid 404 error page.", "real-estate-right-now"); ?>
                <br>
                <?php esc_attr_e("To correct, just follow these steps:", "real-estate-right-now"); ?>
                <br>
                <?php esc_attr_e("Dashboard => Settings => Permalinks => Post Name (check)", "real-estate-right-now"); ?>
                <br>
                <?php esc_attr_e("Click Save Changes", "real-estate-right-now"); ?>
            <?php
            } else {
                echo '<img alt="aux" width="40px" src="' . esc_attr(REALESTATERIGHTNOWURL) . 'assets/images/oktick.png" />';
            }
            ?>
        </div>

        <div class="realestate-help-column realestate-help-column-3">
            <h3 style="color:red;"><?php esc_attr_e("Premium Version Disabled.", "real-estate-right-now"); ?></h3>

            <?php esc_attr_e("Many Features are not included in the free version.", "real-estate-right-now"); ?>
            <br>


            <?php esc_attr_e("Complete real time visual template design functionality.", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- Last Properties", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- Featured Properties", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- Order by Price/Year Ascending/Descending", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- List only properties for rent / sale", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- Create Blocks type Gallery or Page List", "real-estate-right-now"); ?>

            <br>
            <?php esc_attr_e("- Number of Properties to show", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- Show or Hide Search Box / Pagination", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("- More...", "real-estate-right-now"); ?>
            <br>

            <?php $site = 'http://realestateplugin.eu/premium/'; ?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary"><?php esc_attr_e("Learn More", "real-estate-right-now"); ?></a>
        </div>
    </div>
</div>
<div id="realestate-steps3">
    <div class="realestate-block-title">
        <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/3steps.png" />
        <br><br>
        <?php esc_attr_e("Follow these 3 steps after installing the plugin:", "real-estate-right-now"); ?>
    </div>

    <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/step1.png" />
            <h3><?php esc_attr_e("Configure Settings", "real-estate-right-now"); ?></h3>
            <?php esc_attr_e("Go to", "real-estate-right-now"); ?><br>
            <?php esc_attr_e("Dashboard => Real Estate => Settings", "real-estate-right-now"); ?>
            <br>
            <em><?php esc_attr_e("Fill out the information", "real-estate-right-now"); ?>:</em>
            <br>
            - <?php esc_attr_e("Your Currency", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Meters - Feet", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Your Contact Email", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("And so on...", "real-estate-right-now"); ?>
            <br><br>
            <strong><?php esc_attr_e("Import Demo Data:", "real-estate-right-now"); ?></strong>
            <br>
            <?php esc_attr_e("If you want to import demo data, click the Help button at the top right corner", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("If you import demo data, you can skip step 2.", "real-estate-right-now"); ?>
        </div>

        <div class="realestate-help-column realestate-help-column-2">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/step2.png" />
            <h3><?php esc_attr_e("Fill Out Fields and Properties Table", "real-estate-right-now"); ?></h3>
            <strong><?php esc_attr_e("Go to Fields Table:", "real-estate-right-now"); ?></strong><br>
            <?php esc_attr_e("Dashboard => Real Estate => Fields Table", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("These are the fields that will appear in your properties form:", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Google Maps", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Pool", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Balcony", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Garage", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("And so on...", "real-estate-right-now"); ?>
            <br><br>
            <?php esc_attr_e("You don't need to include these fields:", "real-estate-right-now"); ?>
            <?php esc_attr_e("Address, Purpose, Beds, Baths, Price, Year, Area.", "real-estate-right-now"); ?>
            <br><br>
            <strong><?php esc_attr_e("Go to Properties Table:", "real-estate-right-now"); ?></strong><br>
            <?php esc_attr_e("Dashboard => Real Estate => Properties Table", "real-estate-right-now"); ?>
            <br>
            <?php esc_attr_e("Fill out this table with your properties, for example:", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Apartments", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("Offices", "real-estate-right-now"); ?>
            <br>
            - <?php esc_attr_e("And so on.", "real-estate-right-now"); ?>
            <br><br>
        </div>

        <div class="realestate-help-column realestate-help-column-3">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/step3.png" />
            <h3><?php esc_attr_e("Paste the Code in Your Page", "real-estate-right-now"); ?></h3>
            <?php esc_attr_e("Go to your page and copy and paste this code:", "real-estate-right-now"); ?>
            <br>[realestate]
            <br><br>
            <?php esc_attr_e("To show only the search bar, use the following shortcode:", "real-estate-right-now"); ?>
            <br>[realestate onlybar="yes"]
            <br><br>
            <?php esc_attr_e("To create a Team page, use the following shortcode:", "real-estate-right-now"); ?>
            <br>[realestaterightnow_team]
            <br><br>
            <strong><?php esc_attr_e("The premium version includes dozens of extra shortcodes...", "real-estate-right-now"); ?></strong>
        </div>
    </div>
</div>

<div id="realestate-services3">
    <div class="realestate-block-title">
        <?php esc_attr_e("Help, Demo, Support, Troubleshooting:", "real-estate-right-now"); ?>
    </div>

    <div class="realestate-help-container1">
        <div class="realestate-help-column realestate-help-column-1">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/support.png" />
            <h3><?php esc_attr_e("Help and More Tips", "real-estate-right-now"); ?></h3>
            <?php esc_attr_e("Just click the HELP button at the top right corner of this page for context help. Tooltips are also available in the fields form.", "real-estate-right-now"); ?>
            <br><br>
        </div>

        <div class="realestate-help-column realestate-help-column-2">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/service_configuration.png" />
            <h3><?php esc_attr_e("Online Guide, Support, Demo, Demo Video, FAQ...", "real-estate-right-now"); ?></h3>
            <?php esc_attr_e("You can find our complete and updated online guide, demo video, FAQ page, and link to the support page on our site.", "real-estate-right-now"); ?>
            <br><br>
            <?php $site = 'http://realestateplugin.eu'; ?>
            <a href="<?php echo esc_url($site); ?>" class="button button-primary"><?php esc_attr_e("Go", "real-estate-right-now"); ?></a>
        </div>

        <div class="realestate-help-column realestate-help-column-3">
            <img alt="aux" src="<?php echo esc_url(REALESTATERIGHTNOWURL) ?>assets/images/system_health.png" />
            <h3><?php esc_attr_e("Troubleshooting Guide", "real-estate-right-now"); ?></h3>
            <?php esc_attr_e("Issues like using an old WordPress version, low memory, plugins with JavaScript errors, or wrong permalink settings can cause problems. Read the troubleshooting guide to fix them quickly!", "real-estate-right-now"); ?>
            <br><br>
            <a href="http://siterightaway.net/troubleshooting/" class="button button-primary"><?php esc_attr_e("Troubleshooting Page", "real-estate-right-now"); ?></a>
            <br><br>
        </div>
    </div>
</div>