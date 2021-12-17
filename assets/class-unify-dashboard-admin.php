<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://peterteszary.com
 * @since      1.0.0
 *
 * @package    UnifyDashboard
 * @subpackage UnifyDashboard/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    UnifyDashboard
 * @subpackage UnifyDashboard/admin
 * @author     Peter Teszáry <peterteszary@gmail.com>
 */
class UnifyDashboard_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $UnifyDashboard    The ID of this plugin.
	 */
	private $UnifyDashboard;

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
	 * @param      string    $UnifyDashboard       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $UnifyDashboard, $version ) {

		$this->UnifyDashboard = $UnifyDashboard;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in UnifyDashboard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The UnifyDashboard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->UnifyDashboard, plugin_dir_url( __FILE__ ) . 'css/unify-dashboard-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'bootstrap.min', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in UnifyDashboard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The UnifyDashboard_Loader will then create the relationship 
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->UnifyDashboard, plugin_dir_url( __FILE__ ) . 'js/unify-dashboard-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'bootstrap.min', plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js', array( 'jquery' ), $this->version, false );

	}

		/**
	 * Add our cutom menu.
	 *
	 * @since    1.0.0
	 */

	public function my_admin_menu(){
		add_menu_page('New Plugin Settings', 'Unify Dashboard Settings', 'manage_options', 'unify-dashboard/mainsetting.php', array( $this , 'myplugin_admin_page') , 'dashicons-tickets', 250 );

				add_submenu_page('unify-dashboard/mainsettings.php', 'My SubMenu', 'Sub Level Menu', 'manage_options', 'unify-dashboard/importer.php', array( $this , 'myplugin_admin_sub_page')) ;
	
				
	}

	public function myplugin_admin_page(){
		// return views
		require_once 'partials/unify-dashboard-admin-display.php';
	}

	public function myplugin_admin_sub_page(){
		// return subpage views
		require_once 'partials/unify-dashboard-submenu-page.php';
	}
	
	

}