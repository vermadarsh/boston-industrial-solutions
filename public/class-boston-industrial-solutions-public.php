<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/vermadarsh/
 * @since      1.0.0
 *
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Boston_Industrial_Solutions
 * @subpackage Boston_Industrial_Solutions/public
 * @author     Adarsh Verma <adarsh.srmcem@gmail.com>
 */
class Boston_Industrial_Solutions_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function boston_wp_enqueue_scripts_callback() {
		// Custom public css.
		wp_enqueue_style(
			$this->plugin_name,
			BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_URL . 'public/css/boston-industrial-solutions-public.css',
			array(),
			filemtime( BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'public/css/boston-industrial-solutions-public.css' ),
			'all'
		);

		// Custom public js.
		wp_enqueue_script(
			$this->plugin_name,
			BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_URL . 'public/js/boston-industrial-solutions-public.js',
			array( 'jquery' ),
			filemtime( BOSTON_INDUSTRIAL_SOLUTIONS_PLUGIN_PATH . 'public/js/boston-industrial-solutions-public.js' ),
			true
		);

		// Localize variables.
		wp_localize_script(
			$this->plugin_name,
			'Boston_Industrial_Solutions_Public_Js',
			array(
				'ajax_url' => admin_url( 'admin-ajax.php' ),
			)
		);
	}
}
