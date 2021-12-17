<!-- Additional Menu Items -->
<style>
  .input-label {
      width: 200px;
      max-width: 200px;
  }
</style>
<?php for ($i=1; $i <=10 ; $i++) {
  $get_name = get_site_option("widget_name_$i");
  $get_link = get_site_option("widget_url_$i");
  $get_height = get_site_option("widget_height_$i");
  ?>

<form  method="post" action="" style="width:100%">

  <!-- Widget Box Name Div Start -->
    <div class="col-md-8 d-flex align-items-center">

      <div class="input-group mb-8 mr-sm-8">
        <div class="input-group-prepend">
          <div class="input-group-text input-label">Widget Box Name : (<?= $i ?>)</div>
        </div>
        <input type="text" class="form-control" id="" placeholder="Add Widget Box Name" name="widget-name-<?=$i;?>" value="<?=($get_name) ? $get_name : ''?>">
      </div>
    </div>
  <!-- Widget Box Name Div End -->

  <!-- Widget URL Div Start -->
    <div class="col-md-8 d-flex align-items-center get-width">
      <div class="input-group mb-8 mr-sm-8">
        <div class="input-group-prepend">
          <div class="input-group-text input-label">Widget Custom URL : (<?= $i ?>) </div>
        </div>
        <input type="url" class="form-control" id="" placeholder="Add Your Widget Box URL" name="widget-link-<?=$i;?>" value="<?=($get_link) ? $get_link : ''?>">
      </div>
    </div>
  <!-- Widget URL Div End -->

  <!-- Custom Height Div Start -->
  <div class="col-md-8 d-flex align-items-center get-width">
    <div class="input-group mb-8 mr-sm-8">
      <div class="input-group-prepend">
        <div class="input-group-text input-label">Height of Widget Box : (<?= $i ?>) </div>
      </div>
      <input type="number" class="form-control" id="" placeholder="Add Your Widget Box Height" name="widget-height-<?=$i;?>" value="<?=($get_height) ? $get_height : ''?>">
    </div>
  </div>
  <!-- Custom Height Div End -->

  <!-- Allowed User Roles Div Start -->
    <div class="col-md-8 d-flex align-items-center">
        <div class="input-group mb-8 mr-sm-8">
          <div class="col-md-12">
            <h3 style="margin:16px 0px;font-size:24px;">Allowed user roles</h3>
            <?php
              foreach(get_editable_roles() as $role_slug => $role){
                $get_roles = get_site_option( 'widget_user_roles_'.$i );
                if($get_roles && is_array($get_roles) && in_array($role_slug, $get_roles)){
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                    <input type="checkbox"
                    class="regular-text ltr"
                    name="widget_user_roles_<?php echo $i; ?>[]"
                    value="<?php echo $role_slug; ?>" <?php echo $checked; ?>> <?php echo $role['name']; ?>
            <?php } ?>
          </div>
      </div>
    </div>
  <!-- Allowed User Roles Div End -->

  <div class="create-space"></div>

<br>
<?php }  ?>
<input type="submit" name="widget-submit" class="btn btn-primary ml-4" value="Submit" onclick="">

<script>

// Widgets Menu Tab JS

</script>
