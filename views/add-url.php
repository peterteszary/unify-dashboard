<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<?php

if(isset($_REQUEST['submit'])){

  if(isset($_REQUEST['custom-url'])){
      $val = $_REQUEST['custom-url'];
      $roles = $_REQUEST['custom_url_link_roles'];
      update_site_option('custom_url_link',$val);
      update_site_option('custom_url_link_roles',$roles);

    }
}

if(isset($_REQUEST['menu-submit'])){
  for ($i=1; $i <=30 ; $i++) {
    if(isset($_REQUEST["menu-url-name-$i"]) && isset($_REQUEST["menu-url-link-$i"])){
        $name = $_REQUEST["menu-url-name-$i"];
        $link = $_REQUEST["menu-url-link-$i"];
        $icon = $_REQUEST["menu-url-icon-$i"];
        $roles = $_REQUEST["dashboard_switcher_manage_roles_$i"];

        update_site_option("menu_url_name_$i",$name);
        update_site_option("menu_url_link_$i",$link);
        update_site_option("menu_url_icon_$i",$icon);
        update_site_option("dashboard_switcher_manage_roles_$i",$roles);

      }
  }
  echo "<script>location.reload();</script>";
}

if(isset($_REQUEST['security-submit'])){


  $security_options= $_REQUEST['security-options'];
  if(isset($_REQUEST['security-submit']) && ($security_options == true) ){


    $allow_forms     = $_REQUEST['allow-forms'];
    $allow_pointer   = $_REQUEST['allow-pointer'];
    $allow_popups    = $_REQUEST['allow-popups'];
    $allow_same      = $_REQUEST['allow-same'];
    $allow_scripts   = $_REQUEST['allow-scripts'];
    $allow_top       = $_REQUEST['allow-top'];

    update_site_option('security-options',$security_options);
    update_site_option('allow-forms',$allow_forms);
    update_site_option('allow-pointer-lock',$allow_pointer);
    update_site_option('allow-popups',$allow_popups);
    update_site_option('allow-same-origin',$allow_same);
    update_site_option('allow-scripts',$allow_scripts);
    update_site_option('allow-top-navigation',$allow_top);
  }else{
    update_site_option('security-options',$security_options);
  }

}

/*Widget Tab Request*/

if(isset($_REQUEST['widget-submit'])){

  for ($i=1; $i <=20 ; $i++) {
    if(isset($_REQUEST["widget-name-$i"]) && isset($_REQUEST["widget-link-$i"])){
        $name = $_REQUEST["widget-name-$i"];
        $link = $_REQUEST["widget-link-$i"];
        $height = $_REQUEST["widget-height-$i"];
        $roles = $_REQUEST["widget_user_roles_$i"];

        update_site_option("widget_name_$i",$name);
        update_site_option("widget_url_$i",$link);
        update_site_option("widget_height_$i",$height);
        update_site_option("widget_user_roles_$i",$roles);

      }
  }
  echo "<script>location.reload();</script>";
}
?>
<div class="container">
  <br>
  <br>
  <h2 class="text-center">Dashboard Switcher</h2>
  <br>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Welcome Screen</a>
    </li>
    <li class="nav-item">
      <a class="nav-link apply-js" data-toggle="tab" href="#menu1">Additional Menu Items</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#menu2">Security</a>
    </li>
    <li class="nav-item dbs_widget" style="display:none">
      <a class="nav-link" data-toggle="tab" href="#widgets">Home Screen Widgets</a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <?php include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH.'/views/maindashboard-tab-view.php'; ?>
    </div>
    <div id="menu1" class="container tab-pane fade"><br>
      <?php include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH.'/views/submenu-tab-view.php'; ?>
    </div>
    <div id="menu2" class="container tab-pane fade"><br>
      <?php include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH.'/views/security-tab-view.php'; ?>
    </div>
    <div id="widgets" class="container tab-pane fade"><br>
      <?php include_once UNIFY_DASHBOARD_PLUGIN_DIR_PATH.'/views/widgets-tab-view.php'; ?>
    </div>
  </div>
</div>
<div class="container mt-5">
  <div class="row">

  </div>
</div>


<script>
function update(){

}
</script>
