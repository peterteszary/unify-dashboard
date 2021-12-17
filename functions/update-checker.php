<?php
/*
 * Module:      Update Checker
 * Description: Checks for plugin updates. 
 * Version:     1.0
 * Author:      Matthias Altmann
 * Author URI:  https://www.altmann.de

HISTORY
Date		Version		Description
----------------------------------------------------------------------------------------------------------------------
2021-09-20	1.0			Initial release
 */


defined( 'ABSPATH' ) || exit;
if( ! class_exists( 'UnifyDashboardUpdateChecker' ) ) :


//===================================================================================================================
class UnifyDashboardUpdateChecker {

	private $plugin_slug	= 'unify-dashboard';
	private $plugin_file	= 'unify-dashboard/unify-dashboard.php';
	private $plugin_version	= UNIFY-DASHBOARD_PLUGIN_VERSION;
	private $json_url		= 'https://www.dashboardswitcher.com/plugin-repository/dashboard-switcher-x/info.php'; 

	//-------------------------------------------------------------------------------------------------------------------
	public function __construct() {

		// only for admin requests
		if ( ! is_admin() ) {return;}

		/*
		// retrieve plugin version from plugin info header
		if( ! function_exists('get_plugin_data') ){
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}
		$plugin_file_path = WP_PLUGIN_DIR . '/'.$this->plugin_file ;
		$plugin_data = get_plugin_data($plugin_file_path );
		$this->plugin_version = $plugin_data['Version'];
		*/

		// hook update check
		add_filter( 'pre_set_site_transient_update_plugins', [$this, 'check_for_update'] );
		
		// hook info handler
		add_filter( 'plugins_api', [$this, 'info' ], 20, 3 );

	}
	//-------------------------------------------------------------------------------------------------------------------
	public function request() {

		// execute remote request for current version
		$response = wp_remote_get(
			$this->json_url,
			[
				'timeout' => 10,
				'headers' => [
					'Accept' => 'application/json'
				]
			]
		);
		// Check status of remote request 
		if ( wp_remote_retrieve_response_code( $response ) !== 200 ) {
			return null;
		}

		// decode JSON response
		$response = json_decode( wp_remote_retrieve_body( $response ), false);
		// adaptions
		$response->download_url		= $response->download_link;
		$response->package			= $response->download_link;
		$response->trunk			= $response->download_link;
		$response->new_version		= $response->version;
		$response->url				= $response->homepage;

		$response->sections 		= (array) $response->sections;
		$response->banners 			= (array) $response->banners;
		$response->icons 			= (array) $response->icons;
			
		return $response;
	}
	//-------------------------------------------------------------------------------------------------------------------
	public function check_for_update( $transient ) {

		// already checked positively?
		if ( ! empty( $transient->response[$this->plugin_file] ) ) {return $transient;}


		// execute remote request for current version
		$response = $this->request();

		// Check status of remote request 
		if ( ! $response ) {
			return $transient;
		}

		// new version available?
		if (version_compare( $this->plugin_version, $response->new_version, '<' )
			&& version_compare( $response->requires, get_bloginfo( 'version' ), '<' )
			&& version_compare( $response->requires_php, PHP_VERSION, '<' ) ) {

			// adaptions
			$response->slug			= $this->plugin_slug;
			$response->plugin		= $this->plugin_file;
			

			// Save update data in transient
			$transient->response[$this->plugin_file] = (object) $response;
		} else {
			// no update available. populate 
			$transient->new_version	= $this->plugin_version;
			$transient->no_update[$this->plugin_file] = $response;
		} 
		return $transient;
		
	}

	

	//-------------------------------------------------------------------------------------------------------------------
	function info( $res, $action, $args ) {

		// skip if not called to retrieve info
		if ($action !== 'plugin_information') {
			return false;
		}

		// skip if not called for our plugin
		if ( $args->slug !== $this->plugin_slug ) {
			return false;
		}

		// get updates
		$response = $this->request();

		// Check status of remote request 
		if ( ! $response ) {
			return false;
		}

		return $response;

	}

}

new UnifyDashboardUpdateChecker();

endif;
