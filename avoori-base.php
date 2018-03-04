<?php
/**
 * Plugin Name: Avoori Base
 * Plugin URI: https://avoori.com/
 * Description: Avoori Base Plugin. Use the plugin as a base for your development requirements 
 * Author: Avoori Team
 * Author URI: http://avoori.com/
 * Version: 1.0.0
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

 // Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Returns the main instance of Avoori_Base_Class to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object Avoori_Product_Social_Sharing
 */
function Avoori_Base_Class() {
	return Avoori_Base_Class::instance();
} // End Avoori_Product_Social_Sharing()

Avoori_Base_Class();

/**
 * Main Avoori_Base_Class Class
 *
 * @class Avoori_Base_Class
 * @version	1.0.2
 * @since 1.0.0
 * @package	Avoori Base
 */
final class Avoori_Base_Class {
	/**
	 * Avoori_Base_Class The single instance of Avoori_Base_Class.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * The token.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $token;

	/**
	 * The version number.
	 * @var     string
	 * @access  public
	 * @since   1.0.0
	 */
	public $version;

	// Admin - Start
	/**
	 * The admin object.
	 * @var     object
	 * @access  public
	 * @since   1.0.0
	 */
	public $admin;

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function __construct( $widget_areas = array() ) {
		$this->token 				= 'avoori_base_plugin';
		$this->plugin_url 			= plugin_dir_url( __FILE__ );
		$this->plugin_path 			= plugin_dir_path( __FILE__ );
		$this->version 				= '1.0.2';

		register_activation_hook( __FILE__, array( $this, 'install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );

		add_action( 'init', array( $this, 'avoori_base_load_textdomain' ) );

		add_action( 'init', array( $this, 'avoo_setup_avoori_extra' ) );
	}

	/**
	 * Main Avoori_Base_Class Instance
	 *
	 * Ensures only one instance of Avoori_Base_Class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see Avoori_Base_Class()
	 * @return Main Avoori_Base_Class instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	} // End instance()

	/**
	 * Cloning is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 *
	 * @since 1.0.0
	 */
	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation.
	 * Runs on activation. Logs the version number and assigns a notice message to a WordPress option.
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function install() {
		$this->_log_version_number();
	}

	/**
	 * Uninstallation.
	 * Use to clean any settings saved by the plugin
	 * @access  public
	 * @since   1.0.0
	 * @return  void
	 */
	public function uninstall() {
		// Your code here
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 * @return  void
	 */
	private function _log_version_number() {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

	public function avoo_setup_avoori_base() {

		// Include helper functions
		require_once( $this->plugin_path . 'helper.php' );

		// Combine any number of plugins or helper files
		require_once( $this->plugin_path . 'your-plugin/your-plugin.php' );

		// Enquque styles or scripts here
		add_action( 'wp_enqueue_scripts' , array( $this , 'avoo_base_load_styles_scripts' ) );

	}

	/**
	 * Load text domain
	 *
	 * @since 1.0.0
	 */
	public function avoori_base_load_textdomain() {

		// Register Translation Files
		load_plugin_textdomain( 'your-text-domain', false, dirname( plugin_basename( __FILE__ ) ) . '/language/' );
		
	}

	/**
	 * Register Scripts and Styles
	 *
	 * @since 1.0.0
	 */
	public function avoo_base_load_styles_scripts() {

		// Register CSS
		wp_enqueue_style( 'your-css-style', $this->plugin_url . 'assets/min/css/style.min.css', false, '1.0.0' );

		// Register JS
		wp_enqueue_script( 'your-js-style', $this->plugin_url . 'assets/min/js/style.min.js', false, '1.0.0' );
	
	}
	
}