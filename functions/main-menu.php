<?php

/* Adding Sub Menu */

function get_current_user_role(){
  if(is_user_logged_in()){
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;
    $user_role = $roles[0]<>"" ? $roles[0] : 'administrator';
    return $user_role;
  }
}

add_action('admin_menu', 'add_url_pages');
function add_url_pages() {
  $get_user_role = get_current_user_role();
  $user_see_pages = get_user_meta( get_current_user_id(), 'user_see_pages', true );
  for ($i=1; $i <=30 ; $i++) {
    // $role_cap = get_role( $get_user_role );
    // $role_cap->add_cap('cus_menu_cap');
    $get_name = get_site_option("menu_url_name_$i");
    $get_link = get_site_option("menu_url_link_$i");
    $get_icon = get_site_option("menu_url_icon_$i");
    // If icon is not selected then by default icon megaphone is selected
    if(empty($get_icon)){
      $get_icon = 'megaphone';
    }
    $roles = get_site_option("unify_dashboard_manage_roles_$i");
    if( ($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
       add_menu_page("$get_name", "$get_name", "read", "custom-url-$i", "append_iframe_function","dashicons-$get_icon");
      }
  	}
  }
}
function main_menu_function() {
	include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH.'/views/main-menu-view.php';
}

function append_iframe_function2(){
  $string = $_GET['page'];
  $prefix = "custom-url-";
  $index = strpos($string, $prefix) + strlen($prefix);
  $id = substr($string, $index);

  $get_link = get_site_option("menu_url_link_$id");
  echo file_get_contents($get_link);
}
function append_iframe_function(){

$string = $_GET['page'];
$prefix = "custom-url-";
$index = strpos($string, $prefix) + strlen($prefix);
$id = substr($string, $index);

$get_link = get_site_option("menu_url_link_$id");


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

if($security_options == 'true'){
  wp_enqueue_script('load-url-script', plugins_url().'/unify-dashboard/assets/js/custom-link.js', '', DASHBOARD_SWITCHER_X_PLUGIN_VERSION, true );
  wp_localize_script('load-url-script', 'pw_script_vars', array(
       'var' => __($get_link, 'my_var'),
       'sandbox' => __($sandbox, 'sandbox'),
       )
      );
  }else{
    wp_enqueue_script('load-url-script', plugins_url().'/unify-dashboard/assets/js/sub-menu.js', '', DASHBOARD_SWITCHER_X_PLUGIN_VERSION, true );
    wp_localize_script('load-url-script', 'pw_script_vars', array(
         'var' => __($get_link, 'my_var')
         )
        );
  }

}
