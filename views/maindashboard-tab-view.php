<?php
  $get_link = get_site_option('custom_url_link');
  $screen = get_current_screen();
  // echo $screen;
      // var_dump( $screen );
       // echo $screen->base
       $current_url_1 = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
       $current_url_2 = $_SERVER['PHP_SELF'].'?page=custom-url';

$widget_val = get_site_option('check_widget_box');
?>
<input type="hidden" value="<?= $current_url_1 ?>" >
<input type="hidden" value="<?= $current_url_2 ?>" >
<style>
input.cst_widget_checkbox {
    transform: scale(1.4);
    -webkit-transform: scale(1.4);
}
</style>
<div >
  <form class="dbs_mains"  method="post" action="" style="width:100%">

  <div class="col-md-9 d-flex align-items-center">
      <label for="custom-url" class="control-label col-lg-2"><b>Custom URL</b></label>
      <input type="url" name="custom-url" class="form-control" id="custom-url" value="<?php if($get_link){echo $get_link;}?>">
      <input type="submit" name="submit" class="btn btn-primary ml-4" value="Submit" onclick="">

  </div>
  <div class="row">
      	<div class="col-md-12">
      	<h3 style="margin:16px 0px;font-size:24px;">Allowed user roles</h3>
      <?php
        foreach(get_editable_roles() as $role_slug => $role){
          $get_roles = get_site_option( 'custom_url_link_roles' );
          if($get_roles && is_array($get_roles) && in_array($role_slug, $get_roles)){
            $checked = 'checked';
          } else {
            $checked = '';
          }
          ?>
              <input type="checkbox"
              class="regular-text ltr"
              name="custom_url_link_roles[]"
              value="<?php echo $role_slug; ?>" <?php echo $checked; ?>> <?php echo $role['name']; ?>
      <?php } ?></div></div>
  </form>
</div>
<br>
<br>
<br>
<br>
<div class="col-md-9 d-flex align-items-center">
    <label for="custom-url" class="control-label col-lg-11"><h4>Turn on "Welcome Screen Widgets"</h4> </label>
    <div class="col-lg-1">
      <input type="checkbox"  <?= ($widget_val == "on") ? "checked" : '' ;?> class="cst_widget_checkbox"  name="cst_widget_checkbox" value="">
    </div>

</div>
<script>

$('.cst_widget_checkbox').click(function() {
  if (this.checked) {
    $('.dbs_mains').hide();
    $('.dbs_widget').css('display','block');
    jQuery.ajax({
          type:'POST',
          data:{
            action:'check_widget',
            val:'on'
            },
          url: ajaxurl,
          success: function() {
            console.log('success');
          }
    });

  } else {
    $('.dbs_mains').show();
    $('.dbs_widget').css('display','none');
    jQuery.ajax({
          type:'POST',
          data:{
            action:'check_widget',
            val:'off'
            },
          url: ajaxurl,
          success: function() {
            console.log('fail');
          },
        });
  }
});

if ($(".cst_widget_checkbox").is(':checked')){
    $('.dbs_widget').css('display','block');
    $('.dbs_mains').hide();
  }else {
    $('.dbs_widget').css('display','none');
  }
</script>
