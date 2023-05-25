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

if(!class_exists('THWEPO_Admin')):
 
class THWEPO_Admin {
	private $plugin_name;
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    2.3.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		//$this->init_product_settings();
	}
	
	public function enqueue_styles_and_scripts($hook) {
		if(strpos($hook, 'product_page_th_extra_product_options_pro') === false) {
			return;
		}
		$debug_mode = apply_filters('thwepo_debug_mode', false);
		$suffix = $debug_mode ? '' : '.min';
		
		$this->enqueue_styles($suffix);
		$this->enqueue_scripts($suffix);
	}
	
	private function enqueue_styles($suffix) {
		wp_enqueue_style('jquery-ui-style', '//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css?ver=1.11.4');
		wp_enqueue_style('woocommerce_admin_styles', THWEPO_WOO_ASSETS_URL.'css/admin.css');
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_style('thwepo-admin-style', THWEPO_ASSETS_URL_ADMIN . 'css/thwepo-admin'. $suffix .'.css', $this->version);
		//wp_enqueue_style('thwepo-colorpicker-style', THWEPO_ASSETS_URL_ADMIN . 'colorpicker/spectrum.css');
	}

	private function enqueue_scripts($suffix) {
		$deps = array('jquery', 'jquery-ui-dialog', 'jquery-ui-sortable', 'jquery-tiptip', 'wc-enhanced-select', 'selectWoo', 'wp-color-picker',);
		wp_enqueue_media();
		wp_enqueue_script( 'thwepo-admin-script', THWEPO_ASSETS_URL_ADMIN . 'js/thwepo-admin'. $suffix .'.js', $deps, $this->version, false );
	}
	
	public function admin_menu() {
		$capability = THWEPO_Utils::wepo_capability();
		$this->screen_id = add_submenu_page('edit.php?post_type=product', THWEPO_i18n::__t('WooCommerce Extra Product Option'), 
		THWEPO_i18n::__t('Extra Product Option'), $capability, 'th_extra_product_options_pro', array($this, 'output_settings'));
 	
		//add_action('admin_print_scripts-'. $this->screen_id, array($this, 'enqueue_admin_scripts'));
	}
	
	public function add_screen_id($ids){
		$ids[] = 'woocommerce_page_th_extra_product_options_pro';
		$ids[] = strtolower( THWEPO_i18n::__t('WooCommerce') ) .'_page_th_extra_product_options_pro';

		return $ids;
	}

	/*public function init_product_settings(){
		$prod_settings = THWEPO_Admin_Settings_Product::instance();	
		$prod_settings->render_page();
	}*/
	
	public function plugin_action_links($links) {
		$settings_link = '<a href="'.admin_url('edit.php?post_type=product&page=th_extra_product_options_pro').'">'. __('Settings') .'</a>';
		array_unshift($links, $settings_link);
		return $links;
	}
	
	public function plugin_row_meta( $links, $file ) {
		if(THWEPO_BASE_NAME == $file) {
			$doc_link = esc_url('https://www.themehigh.com/docs/category/extra-product-option-for-woocommerce/?utm_source=wepo_pro&utm_medium=docs&utm_campaign=help_docs');
			$support_link = esc_url('https://help.themehigh.com/hc/en-us/requests/new');
				
			$row_meta = array(
				'docs' => '<a href="'.$doc_link.'" target="_blank" aria-label="'.THWEPO_i18n::esc_attr__t('View plugin documentation').'">'.THWEPO_i18n::esc_html__t('Docs').'</a>',
				'support' => '<a href="'.$support_link.'" target="_blank" aria-label="'. THWEPO_i18n::esc_attr__t('Visit premium customer support' ) .'">'. THWEPO_i18n::esc_html__t('Premium support') .'</a>',
			);

			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}

}

endif;