<?php
/*
 * Plugin Name: WCMp Legacy Settings
 * Plugin URI: https://wc-marketplace.com/
 * Description: A free plugin compatible with WC Marketplace 3.0 with all the removed settings
 * Author: WC Marketplace, The Grey Parrots
 * Version: 1.0.0
 * Author URI: https://wc-marketplace.com/about-us/
 * Requires at least: 4.0
 * Tested up to: 4.9.2
 * WC requires at least: 3.0
 * WC tested up to: 3.3.1
 *
 * Text Domain: wcmp-legacy
 * Domain Path: /languages/
 */

if (!class_exists('WCMp_Legacy_Dependencies')) {
    require_once 'includes/class-wcmp-legacy-dependencies.php';
}
require_once 'includes/wcmp-legacy-core-functions.php';
require_once 'wcmp-legacy-config.php';
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly
if (!defined('WCMP_LEGACY_PLUGIN_TOKEN')) {
    exit;
}
if (!defined('WCMP_LEGACY_TEXT_DOMAIN')) {
    exit;
}
/* Plugin activation hook */
register_activation_hook(__FILE__, 'activate_wcmp_legacy_plugin');
/* Plugin deactivation hook */
register_deactivation_hook(__FILE__, 'deactivate_wcmp_legacy_plugin');

if (WCMp_Legacy_Dependencies::wc_marketplace_plugin_active_check()) {
    if (!class_exists('WCMP_Legacy')) {
        require_once( 'classes/class-wcmp-legacy.php' );
        global $WCMP_Legacy;
        $WCMP_Legacy = new WCMP_Legacy(__FILE__);
        $GLOBALS['WCMP_Legacy'] = $WCMP_Legacy;
    }
} else{
    add_action('admin_notices', 'wcmp_inactive_notice');
}