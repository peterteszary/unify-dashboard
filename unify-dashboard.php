<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           UnifyDashboard
 *
 * @wordpress-plugin
 * Plugin Name:       Unify Dashboard
 * Plugin URI:        http://peterteszary.com
 * Description:       This plugin make you able to add extra stuff to the admin area
 * Version:           1.0.0
 * Author:            Peter Teszáry
 * Author URI:        http://peterteszary.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       unify-dashboard
 * Domain Path:       /languages
 */

define('UNIFY_DASHBOARD_PLUGIN_DIR_PATH',plugin_dir_path(__FILE__));
require_once(UNIFY_DASHBOARD_PLUGIN_DIR_PATH . '/functions/update-checker.php');



require_once(ABSPATH . 'wp-admin/includes/screen.php');
$check_link = get_site_option('custom_url_link');




function add_custom_menu(){

  $admin_url = get_admin_url();
  $network_site = network_site_url();
  $network_site = $network_site.'wp-admin/';
  $network_admin = network_admin_url();

  // echo $admin_url.'<br>';
  // echo $network_site.'<br>';
  // echo $network_admin.'<br>'; exit;
if($admin_url == $network_site || $admin_url == $network_admin ){
      add_options_page(
        'Dashboard Switcher', //page title
        'Dashboard Switcher', // menu title
        'manage_options', //admin level
        'custom-url', //page slug ~parenet slug
        'add_new_link' // call back function
      );
    }
 }
 add_action('admin_menu','add_custom_menu');

//Custom URL Page View
function add_new_link(){
  include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH . '/views/add-url.php';
}

//Action Hook to Load All Scripts
function custom_url_assests(){
  wp_enqueue_style(
    'custom-url-stylesheet', // unique name for css file
     plugins_url().'/unify-dashboard/assets/css/style.css',// css file path
     '', // dependency on other files
     UNIFY_DASHBOARD_PLUGIN_VERSION, // plugin version number
      false // add to header
    );
    wp_enqueue_script(
      'custom-url-script', // unique name for js file
       plugins_url().'/unify-dashboard/assets/js/script.js',// js file path
       '', // dependency on other files
       UNIFY_DASHBOARD_PLUGIN_VERSION, // plugin version number
        true // add to footer
      );
 
      // wp_enqueue_style('admin-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), false);
      // wp_deregister_script('jquery');
      // wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"), false);
      // wp_enqueue_script('jquery');
      // wp_enqueue_script( 'admin-popper-min', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '', true );
      // wp_enqueue_script( 'admin-bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), 'bootstrap', true );

}
add_action('init','custom_url_assests');

if($check_link != ""){
  //Action Hook to Remove all Dashboard Meta Boxes
  function remove_all_dashboard_meta_boxes()
  {
      global $wp_meta_boxes;
      $wp_meta_boxes['dashboard']['normal']['core'] = array();
      $wp_meta_boxes['dashboard']['side']['core'] = array();
  }
  add_action('wp_dashboard_setup', 'remove_all_dashboard_meta_boxes', 9999 );

  // //Action Hook to Disbale drag metabox
  // function disable_drag_metabox() {
  //     wp_deregister_script('postbox');
  // }
  // add_action( 'admin_init', 'disable_drag_metabox' );



  //Filter to Remove Help Tab
  function remove_dashboard_help_tab( $old_help, $screen_id, $screen )
  {
      if( 'dashboard' != $screen->base )
          return $old_help;

      $screen->remove_help_tabs();
      return $old_help;
  }
  add_filter( 'contextual_help', 'remove_dashboard_help_tab', 999, 3 );

  //Filter to Remove Help Tab
  function remove_help_tab( $visible )
  {
      global $current_screen;
      if( 'dashboard' == $current_screen->base )
          return false;
      return $visible;
    }
  add_filter( 'screen_options_show_screen', 'remove_help_tab' );

  //Action Hook to Remove Welcome Panel
  remove_action('welcome_panel', 'wp_welcome_panel');

  // if(get_current_screen()->base === 'dashboard'){
  //   exit;
  // }
}

$link_one = admin_url();
$link_two = $link_one.'index.php';

$url_http = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$url_https = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];


// include_once(ABSPATH . 'wp-includes/pluggable.php');


//Get link value and update it

  if($url_http == $link_one || $url_http == $link_two || $url_https == $link_one || $url_https == $link_two ){

    if($check_link != ""){
      function get_custom_url(){
        $get_link = get_site_option('custom_url_link');

        $security_options = get_site_option('security-options');
        $snadbox = '';

        if($security_options == 'true'){

          if( get_site_option('allow-forms') == true ){ $arr[] = 'allow-forms'; };
          if( get_site_option('allow-pointer-lock') == true ){ $arr[] = 'allow-pointer-lock'; };
          if( get_site_option('allow-popups') == true ){ $arr[] = 'allow-popups'; };
          if( get_site_option('allow-same-origin') == true ){ $arr[] = 'allow-same-origin'; };
          if( get_site_option('allow-scripts') == true ){ $arr[] = 'allow-scripts '; };
          if( get_site_option('allow-top-navigation') == true ){ $arr[] = 'allow-top-navigation'; };
          $sandbox = implode(' ', $arr);
        }

        $user_role = '';
        if(is_user_logged_in()){
          $user = wp_get_current_user();
          $roles = ( array ) $user->roles;
          $user_role = $roles[0]<>"" ? $roles[0] : 'administrator';
        }
        $roles = get_site_option( 'custom_url_link_roles' );
          if(!empty($roles) && in_array($user_role, $roles)){
            if($security_options == 'true'){
              wp_enqueue_script('load-url-script',  plugins_url().'/unify-dashboard/assets/js/custom-link.js', '', DASHBOARD_SWITCHER_X_PLUGIN_VERSION, true );
              // }
        	    wp_localize_script('load-url-script', 'pw_script_vars', array(
        			     'var' => __($get_link, 'my_var'),
                   'sandbox' => __($sandbox, 'sandbox'),
        		       )
        	        );
              }else{
                wp_enqueue_script('load-url-script',  plugins_url().'/unify-dashboard/assets/js/sub-menu.js', '', DASHBOARD_SWITCHER_X_PLUGIN_VERSION, true );
                wp_localize_script('load-url-script', 'pw_script_vars', array(
                		 'var' => __($get_link, 'my_var')
                		 )
                		);
              }
            }
        }
      add_action('init','get_custom_url');
    }
  }


include_once('functions/add-site-options.php');
include_once('functions/main-menu.php');
include_once('functions/widgets-box.php'); 



add_action(
    'edit_user_profile',
    'user_will_able_to_see_pages'
);

// add the field to user profile editing screen
add_action(
    'show_user_profile',
    'user_will_able_to_see_pages'
);

add_action(
    'user_new_form',
    'user_will_able_to_see_pages'
);

// add the save action to user's own profile editing screen update
add_action(
    'personal_options_update',
    'user_will_able_to_see_pages_update'
);

// add the save action to user profile editing screen update
add_action(
    'edit_user_profile_update',
    'user_will_able_to_see_pages_update'
);

function user_will_able_to_see_pages($user)
{
  $user_role = is_user_logged_in() ? wp_get_current_user()->roles[0] : ''; if($user_role=='administrator'): ?>
    <h3>Dashboard Switcher - Manage user</h3>
    <table class="form-table">
        <tr>
            <th>
                <label for="user_see_pages">Disable dashboard switcher menus</label>
            </th>
            <td>
                <input type="checkbox"
                       class="regular-text ltr"
                       id="user_see_pages"
                       name="user_see_pages"
                       value="1" <?php echo get_user_meta( $user->ID, 'user_see_pages', true ) ? 'checked' : ''; ?>>
            </td>
        </tr>
    </table>
    <?php
endif;
}

/**
 * The save action.
 *
 * @param $user_id int the ID of the current user.
 *
 * @return bool Meta ID if the key didn't exist, true on successful update, false on failure.
 */
function user_will_able_to_see_pages_update($user_id)
{
    // check that the current user have the capability to edit the $user_id
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // create/update user meta for the $user_id
    return update_user_meta(
        $user_id,
        'user_see_pages',
        $_POST['user_see_pages']
    );
}



add_action('wp_ajax_check_widget', 'check_widget_status');
function check_widget_status(){
  $val = $_REQUEST[val];
  if($val == 'on'){
    update_site_option("check_widget_box",$val);
  }elseif($val == 'off'){
    update_site_option("check_widget_box",$val);
  }
exit();
}

