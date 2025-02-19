<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://anurag.com
 * @since      1.0.0
 *
 * @package    Form
 * @subpackage Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Form
 * @subpackage Form/includes
 * @author     anurag <anurag@gmail.com>
 */
class Form {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Form_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'FORM_VERSION' ) ) {
			$this->version = FORM_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'form';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Form_Loader. Orchestrates the hooks of the plugin.
	 * - Form_i18n. Defines internationalization functionality.
	 * - Form_Admin. Defines all hooks for the admin area.
	 * - Form_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-form-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-form-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-form-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-form-public.php';

		$this->loader = new Form_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Form_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Form_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Form_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes_edit_order_page' );
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'add_meta_boxes_edit_order_page_form' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'my_custom_admin_menu' );
		$this->loader->add_action('init',$plugin_admin,'fee_portal_handler');
		$this->loader->add_filter( 'manage_woocommerce_page_wc-orders_columns', $plugin_admin, 'custom_shop_order_column' );
		$this->loader->add_action( 'manage_woocommerce_page_wc-orders_custom_column', $plugin_admin, 'custom_orders_list_column_content_hpos', 20, 2);
		$this->loader->add_action('woocommerce_order_list_table_restrict_manage_orders',$plugin_admin, 'rudr_order_filter', 25, 2);
		$this->loader->add_action('woocommerce_order_list_table_prepare_items_query_args',$plugin_admin, 'add_filter_in_order_list');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Form_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'wpbootstrap_enqueue_styles' );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'init_shorcodes' );

		$this->loader->add_action( 'wp_ajax_degree_form_data', $plugin_public, 'send_degree_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_degree_form_data', $plugin_public, 'send_degree_form_data' );

		$this->loader->add_action( 'wp_ajax_tc_cc_form_data', $plugin_public, 'send_tc_cc_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_tc_cc_form_data', $plugin_public, 'send_tc_cc_form_data' );

		$this->loader->add_action( 'wp_ajax_studing_certificate_form_data', $plugin_public, 'send_studing_certificate_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_studing_certificate_form_data', $plugin_public, 'send_studing_certificate_form_data' );

		$this->loader->add_action( 'wp_ajax_cde_fee_form_data', $plugin_public, 'send_cde_fee_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_cde_fee_form_data', $plugin_public, 'send_cde_fee_form_data' );

		$this->loader->add_action( 'wp_ajax_cde_geo_fee_form_data', $plugin_public, 'send_cde_geo_fee_form_data' );
		$this->loader->add_action( 'wp_ajax_nopriv_cde_geo_fee_form_data', $plugin_public, 'send_cde_geo_fee_form_data' );

		$this->loader->add_action( 'woocommerce_thankyou', $plugin_public, 'bbloomer_add_content_thankyou' );
		$this->loader->add_action( 'woocommerce_locate_template', $plugin_public, 'intercept_wc_template' ,99,3);
		// $this->loader->add_action('woocommerce_new_order',$plugin_public, 'update_tc_cc_serial_number', 10, 1);

		// do_action( 'wp_body_open' )

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Form_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public static function college_update_order_meta($order_id, $meta_key, $meta_value) {
		// Get the order object
		$order = wc_get_order($order_id);
	
		if ($order) {
			// Update the meta data
			$order->update_meta_data($meta_key, $meta_value);
	
			// Save the order to persist the changes
			$order->save();
		} else {
			// Handle the case where the order is not found
			//error_log("Order not found: " . $order_id);
		}
	}

	public static function college_get_order_meta($order_id, $meta_key = false) {
		// Get the order object
		$order = wc_get_order($order_id);
		if ($order) {
			// Get the meta data
			$meta_value = $order->get_meta($meta_key);
	
			return $meta_value;
		} else {
			// Handle the case where the order is not found
			error_log("Order not found: " . $order_id);
			return null;
		}
	}



}
