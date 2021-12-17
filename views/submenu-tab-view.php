<!-- Additional Menu Items -->
<style>
.input-width {
    width: 180px;
    max-width: 180px;
}
i.icon-css::before {
  line-height: unset !important;
}
.select2-container .select2-selection--single {
  height: 38px !important;
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
  line-height: 38px !important;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 38px !important;
}
div.pre-selected-icon {
    border: 1px solid grey;
    min-width: 50px;
}
.pre-selected-icon .icon-css.dashicons-before::before {
    font-size: 30px;
}
.pre-selected-icon .icon-css.dashicons-before {
    padding-left: 8px;
    line-height: 1.3;
}

@media screen and (max-width: 1304px) {
  div.pre-selected-icon {
      min-width: 45px;
  }
}
@media screen and (max-width: 1250px) {
  div.pre-selected-icon {
      min-width: 40px;
  }
  .pre-selected-icon .icon-css.dashicons-before {
      padding-left: 4px;
  }
}
@media screen and (max-width: 1200px) {
  div.pre-selected-icon {
      min-width: 35px;
  }
  .pre-selected-icon .icon-css.dashicons-before {
      padding-left: 1px;
  }
}
</style>
<?php for ($i=1; $i <=30 ; $i++) {
  $get_name = get_site_option("menu_url_name_$i");
  $get_link = get_site_option("menu_url_link_$i");
  $get_icon = get_site_option("menu_url_icon_$i");
?>

<form  method="post" action="<?php echo $_SERVER['PHP_SELF'].'?page=custom-url'; ?>" style="width:100%">

  <!-- Menu Item Name Div Start -->
    <div class="col-md-8 d-flex align-items-center">

      <div class="input-group mb-8 mr-sm-8">
        <div class="input-group-prepend">
          <div class="input-group-text input-width">Menu Item Name : (<?= $i ?>)</div>
        </div>
        <input type="text" class="form-control" id="" placeholder="Add Menu Item Name" name="menu-url-name-<?=$i;?>" value="<?=($get_name) ? $get_name : ''?>">
      </div>
    </div>
  <!-- Menu Item Name Div End -->

  <!-- Custom URL Div Start -->
    <div class="col-md-8 d-flex align-items-center get-width">
      <div class="input-group mb-8 mr-sm-8">
        <div class="input-group-prepend">
          <div class="input-group-text input-width">Custom URL : (<?= $i ?>)</div>
        </div>
        <input type="url" class="form-control" id="" placeholder="Add Your Custom URL Link" name="menu-url-link-<?=$i;?>" value="<?=($get_link) ? $get_link : ''?>">
      </div>
    </div>
  <!-- Custom URL Div End -->

  <!-- Sidebar Icon Div Start -->
    <div class="col-md-8 d-flex align-items-center">
      <div class="input-group-prepend">
        <div class="input-group-text input-width">Sidebar Icon:</div>
      </div>
      <div class="input-group">
        <div class="pre-selected-icon" id="icon-<?=$i?>"><i class="icon-css dashicons-before dashicons-<?=($get_icon) ? $get_icon : ''?>"></i></div>
          <select style="max-width:33rem !important; font-size: 16px !important;" id="select" data-id="<?=$i?>" name="menu-url-icon-<?=$i;?>" class="form-control sidebar-icon">
              <option value="<?=($get_icon) ? $get_icon : ''?>" selected="selected"><?=($get_icon) ? 'Change' : 'Select'?> Your Sidebar Icon..!</option>
          </select>
      </div>
    </div>
  <!-- Sidebar Icon Div End -->

  <!-- Allowed User Roles Div Start -->
    <div class="col-md-8 d-flex align-items-center">
        <div class="input-group mb-8 mr-sm-8">
          <div class="col-md-12">
            <h3 style="margin:16px 0px;font-size:24px;">Allowed user roles</h3>
            <?php
              foreach(get_editable_roles() as $role_slug => $role){
                $get_roles = get_site_option( 'unify_dashboard_manage_roles_'.$i );
                if($get_roles && is_array($get_roles) && in_array($role_slug, $get_roles)){
                  $checked = 'checked';
                } else {
                  $checked = '';
                }
                ?>
                    <input type="checkbox"
                    class="regular-text ltr"
                    name="unify_dashboard_manage_roles_<?php echo $i; ?>[]"
                    value="<?php echo $role_slug; ?>" <?php echo $checked; ?>> <?php echo $role['name']; ?>
            <?php } ?>
          </div>
      </div>
    </div>
  <!-- Allowed User Roles Div End -->

<br>
<?php }  ?>
<input type="submit" name="menu-submit" class="btn btn-primary ml-4" value="Submit" onclick="">

<script>



// Sub Menu Tab JS

// Fetching the icons list and appending it using select2
var url = '<?= plugins_url().'/unify-dashboard/assets/json/codepoints.json';?>';

$.get(url, function(data) {
	var obj = data;
	var options = new Array();
	$.each(obj, function(key, value){
  		options.push({
  			id: key,
  			text: '<i class="icon-css dashicons-before dashicons-'+key+'"></i> ' + key
  		});
  });

	$('.sidebar-icon').select2({
    width: '90%',
		data: options,
		escapeMarkup: function(markup) {
			return markup;
		}
	});
});

// Get the clicked ID of dropdwon and append icon to div "#icon()"
$(".sidebar-icon").change(function(){
  var clickedID = $(this).data('id');
  var icono = $(this).val();
	$('#icon-'+clickedID).html('<i class="icon-css dashicons-before dashicons-'+icono+'"></i>');
});


var applyWidth = function(){
  var valueInString = $('.get-width').width();
  var num = parseFloat(valueInString);
  var val = num - (num * (.280));
  $(".selected-icon").width(val);
  }
$('.apply-js').click(function(){

  // setTimeout(applyWidth,100);

});
</script>
