<?php
/**
 * Plugin Name:     Plugin Name
 * Plugin URI:      @TODO
 * Description:     @TODO
 * Version:         {{plugin_version}}
 * Author:          {{author_name}}
 * Author URI:      {{author_url}}
 * Text Domain:     plugin-name
 * Domain Path:     /languages
 * Requires PHP:    7.4
*/

defined( 'ABSPATH' ) || exit;

define('PN_VERSION', '1.0.0');
!defined( 'PN_SOFTWARE_TITLE') && define( 'PN_SOFTWARE_TITLE', 'Plugin Name');
!defined( 'PN_FILE') && define( 'PN_FILE', __FILE__);
!defined( 'PN_PLUGIN_ROOT') && define( 'PN_PLUGIN_ROOT', plugin_dir_path( __FILE__ ));
!defined( 'PN_URL') && define( 'PN_URL', plugins_url( '/', __FILE__ ));
!defined( 'PN_BASE_NAME') && define( 'PN_BASE_NAME', plugin_basename( __FILE__ ));

/**
 * The code that runs during plugin activation.
 */
function activate_pn() {
	require_once PN_PLUGIN_ROOT . 'includes/class-pn-activator.php';
	THWEPO_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_pn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pn-deactivator.php';
	THWEPO_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pn' );
register_deactivation_hook( __FILE__, 'deactivate_pn' );

require PN_PLUGIN_ROOT . 'includes/pn.php';