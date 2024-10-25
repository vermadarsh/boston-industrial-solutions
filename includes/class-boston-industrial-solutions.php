<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://github.com/vermadarsh/
 * @since      1.0.0
 *
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/includes
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
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/includes
 * @author     Adarsh Verma <adarsh.srmcem@gmail.com>
 */
class Boston_Industrial_Solutions {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Boston_Industrial_Solutions_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		$this->version     = ( defined( 'BOSTON_INDUSTRIAL_SOLUTIONS_VERSION' ) ) ? BOSTON_INDUSTRIAL_SOLUTIONS_VERSION : '1.0.0';
		$this->plugin_name = 'boston-industrial-solutions';

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
	 * - Boston_Industrial_Solutions_Loader. Orchestrates the hooks of the plugin.
	 * - Boston_Industrial_Solutions_i18n. Defines internationalization functionality.
	 * - Boston_Industrial_Solutions_Admin. Defines all hooks for the admin area.
	 * - Boston_Industrial_Solutions_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 *
	 * @access   private
	 */
	private function load_dependencies() {
		// The class responsible for orchestrating the actions and filters of the core plugin.
		require_once BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'includes/class-boston-industrial-solutions-loader.php';

		// The class responsible for defining internationalization functionality of the plugin.
		require_once BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'includes/class-boston-industrial-solutions-i18n.php';

		// The file responsible for defining all reusable functions.
		require_once BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'includes/boston-industrial-solutions-functions.php';

		// The class responsible for defining all actions that occur in the admin area.
		require_once BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'admin/class-boston-industrial-solutions-admin.php';

		// The class responsible for defining all actions that occur in the public-facing side of the site.
		require_once BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'public/class-boston-industrial-solutions-public.php';

		$this->loader = new Boston_Industrial_Solutions_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Boston_Industrial_Solutions_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Boston_Industrial_Solutions_i18n();

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
		$plugin_admin = new Boston_Industrial_Solutions_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'boston_admin_enqueue_scripts_callback' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Boston_Industrial_Solutions_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'boston_wp_enqueue_scripts_callback' );
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
	 * @return    Boston_Industrial_Solutions_Loader    Orchestrates the hooks of the plugin.
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
}
