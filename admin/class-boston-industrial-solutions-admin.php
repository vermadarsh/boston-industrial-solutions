<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/vermadarsh/
 * @since      1.0.0
 *
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/admin
 * @author     Adarsh Verma <adarsh.srmcem@gmail.com>
 */
class Boston_Industrial_Solutions_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function boston_admin_enqueue_scripts_callback() {
		// Custom admin css.
		wp_enqueue_style(
			$this->plugin_name,
			BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_URL . 'admin/css/boston-industrial-solutions-admin.css',
			array(),
			filemtime( BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'admin/css/boston-industrial-solutions-admin.css' ),
			'all'
		);

		// Custom admin js.
		wp_enqueue_script(
			$this->plugin_name,
			BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_URL . 'admin/js/boston-industrial-solutions-admin.js',
			array( 'jquery' ),
			filemtime( BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'admin/js/boston-industrial-solutions-admin.js' ),
			true
		);

		// Localize variables.
		wp_localize_script(
			$this->plugin_name,
			'Boston_Industrial_Solutions_Admin_Js',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}
