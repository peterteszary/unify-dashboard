<?php

$widget_val = get_site_option('check_widget_box');
if($widget_val == "on"){
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
}
function my_custom_dashboard_widgets() {
    global $wp_meta_boxes;
    $get_user_role = get_current_user_role();
    $user_see_pages = get_user_meta( get_current_user_id(), 'user_see_pages', true );

  //1st
    $get_name = get_site_option("widget_name_1");
    $get_link = get_site_option("widget_url_1");
    $roles = get_site_option("widget_user_roles_1");

    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_1', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_1");
          $get_height = get_site_option("widget_height_1");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
               echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

    //2nd
    $get_name = get_site_option("widget_name_2");
    $get_link = get_site_option("widget_url_2");
    $roles = get_site_option("widget_user_roles_2");

    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
          wp_add_dashboard_widget('custom_help_widget_2', $get_name, function( $arg ) use ( $values ){
            $get_link = get_site_option("widget_url_2");
            $get_height = get_site_option("widget_height_2");
            if(!empty($get_height)){
              $get_height = $get_height."px";
            }else{
              $get_height = "300px";
            }
            echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

      //3rd
    $get_name = get_site_option("widget_name_3");
    $get_link = get_site_option("widget_url_3");
    $roles = get_site_option("widget_user_roles_3");
    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_3', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_3");
          $get_height = get_site_option("widget_height_3");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

  //4th
    $get_name = get_site_option("widget_name_4");
    $get_link = get_site_option("widget_url_4");
    $roles = get_site_option("widget_user_roles_4");
    if(($get_name != null) && ($get_link != null)){
        if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
          wp_add_dashboard_widget('custom_help_widget_4', $get_name, function( $arg ) use ( $values ){
            $get_link = get_site_option("widget_url_4");
            $get_height = get_site_option("widget_height_4");
            if(!empty($get_height)){
              $get_height = $get_height."px";
            }else{
              $get_height = "300px";
            }
            echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
          });
        }
    }
  //5th
    $get_name = get_site_option("widget_name_5");
    $get_link = get_site_option("widget_url_5");
    $roles = get_site_option("widget_user_roles_5");
    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_5', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_5");
          $get_height = get_site_option("widget_height_5");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

  //6th
    $get_name = get_site_option("widget_name_6");
    $get_link = get_site_option("widget_url_6");
    $roles = get_site_option("widget_user_roles_6");

    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_6', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_6");
          $get_height = get_site_option("widget_height_6");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

    //7th
    $get_name = get_site_option("widget_name_7");
    $get_link = get_site_option("widget_url_7");
    $roles = get_site_option("widget_user_roles_7");
    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_7', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_7");
          $get_height = get_site_option("widget_height_7");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

  //8th
    $get_name = get_site_option("widget_name_8");
    $get_link = get_site_option("widget_url_8");
    $roles = get_site_option("widget_user_roles_8");

    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_8', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_8");
          $get_height = get_site_option("widget_height_8");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

  //9th
    $get_name = get_site_option("widget_name_9");
    $get_link = get_site_option("widget_url_9");
    $roles = get_site_option("widget_user_roles_9");
    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_9', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_9");
          $get_height = get_site_option("widget_height_9");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
        });
      }
    }

  //10th
    $get_name = get_site_option("widget_name_10");
    $get_link = get_site_option("widget_url_10");
    $roles = get_site_option("widget_user_roles_10");

    if(($get_name != null) && ($get_link != null)){
      if(!empty($roles) && in_array($get_user_role, $roles) && $user_see_pages==0){
        wp_add_dashboard_widget('custom_help_widget_10', $get_name, function( $arg ) use ( $values ){
          $get_link = get_site_option("widget_url_10");
          $get_height = get_site_option("widget_height_10");
          if(!empty($get_height)){
            $get_height = $get_height."px";
          }else{
            $get_height = "300px";
          }
          echo '<iframe frameborder="0" width="100%" height="'.$get_height.'" src="'.$get_link.'"></iframe>';
          });
        }
      }
}
