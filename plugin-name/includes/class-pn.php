<?php
/**
 * Plugin_Name
 *
 * @package   Plugin_Name
 * @author    {{author_name}} <{{author_email}}>
 * @copyright {{author_copyright}}
 * @license   {{author_license}}
 * @link      {{author_url}}
 */

/**
 * Get the settings of the plugin in a filterable way
 *
 * @since {{plugin_version}}
 * @return array
 */

defined( 'ABSPATH' ) || exit;

final class PN {

	/**
	 * Plugin version.
	 *
	 * @var string
	 */
	public $version = PN_VERSION;

	/**
	 * plugin Schema version.
	 *
	 * @since 4.3 started with version string 430.
	 *
	 * @var string
	 */
	public $db_version = '';

	/**
	 * The single instance of the class.
	 *
	 * @var WooCommerce
	 * @since 2.1
	 */
	protected static $_instance = null;

	/**
	 * Query instance.
	 *
	 * @var WC_Query
	 */
	public $query = null;

	/**
	 * API instance
	 *
	 * @var WC_API
	 */
	public $api;

	/**
	 * Main Plugin Instance.
	 *
	 * Ensures only one instance of Plugin is loaded or can be loaded.
	 *
	 * @since 2.1
	 * @static
	 * @see PN()
	 * @return Plugin - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		$this->define_constants();
		$this->define_tables();
		$this->includes();
		$this->init_hooks();
	}

	/**
	 * When WP has loaded all plugins, trigger the `pn_loaded` hook.
	 *
	 * This ensures `plugin_loaded` is called only after all other plugins
	 * are loaded, to avoid issues caused by plugin directory naming changing
	 * the load order.
	 *
	 */
	public function on_plugins_loaded() {
		/**
		 * Action to signal that WooCommerce has finished loading.
		 *
		 * @since 3.6.0
		 */
		do_action( 'pn_loaded' );
	}

	private function init_hooks() {

		/*add_action( 'plugins_loaded', array( $this, 'on_plugins_loaded' ), -1 );
		add_action( 'admin_notices', array( $this, 'build_dependencies_notice' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'PN_Shortcodes', 'init' ) );
		add_action( 'init', array( $this, 'add_image_sizes' ) );
		add_action( 'init', array( $this, 'load_rest_api' ) );*/

	}































	
}