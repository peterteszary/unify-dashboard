<?php

  $get_option = get_site_option('security-options');

  $security_options  = get_site_option('security-options');

  $allow_forms   = get_site_option('allow-forms');
  $allow_pointer   = get_site_option('allow-pointer-lock');
  $allow_popups  = get_site_option('allow-popups');
  $allow_same  = get_site_option('allow-same-origin');
  $allow_scripts   = get_site_option('allow-scripts');
  $allow_top   = get_site_option('allow-top-navigation');

 ?>

<div class="checkbox">
  <label><input type="checkbox" id="sandbox" name="security-options" value="<?= $get_option; ?>" <?= ($get_option == true ? 'checked' : '');?> >Active Sandbox Mode for Dashboard Iframe</label>
</div>
<br>
<br>
  <form  method="post" action="<?php echo $_SERVER['PHP_SELF'].'?page=custom-url'; ?>" style="width:100%" >
    <div class="sandbox-options">
    <div class="checkbox">
      <label><input type="checkbox" value="<?= $allow_forms; ?> " class="checkbox-val" name="allow-forms" <?= ($allow_forms == true ? 'checked' : '');?>>allow-forms (Re-enables form submission)</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="<?= $allow_pointer; ?> " class="checkbox-val" name="allow-pointer" <?= ($allow_pointer == true ? 'checked' : '');?>>allow-pointer-lock (Re-enables APIs)</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="<?= $allow_popups; ?> " class="checkbox-val" name="allow-popups" <?= ($allow_popups == true ? 'checked' : '');?>>allow-popups (Re-enables popups)</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value=<?= $allow_same; ?> "" class="checkbox-val" name="allow-same" <?= ($allow_same == true ? 'checked' : '');?>>allow-same-origin (Allows the iframe content to be treated as being from the same origin)</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="<?= $allow_scripts; ?> " class="checkbox-val" name="allow-scripts" <?= ($allow_scripts == true ? 'checked' : '');?>>allow-scripts (Re-enables scripts)</label>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" value="<?= $allow_top; ?> " class="checkbox-val" name="allow-top" <?= ($allow_top == true ? 'checked' : '');?>>allow-top-navigation (Allows the iframe content to navigate its top-level browsing context)</label>
    </div>
    <div class="checkbox">
      <p style="color:red;">Please be careful if using the iframe sandbox feature and attributes. Use it if you know what you do. Check this article to get some further informations about the iframe sandbox mode (<a style="color:red;" href="https://www.html5rocks.com/en/tutorials/security/sandboxed-iframes/">https://www.html5rocks.com/en/tutorials/security/sandboxed-iframes/</a>).</p>
    </div>
  </div>
  <input type="submit" name="security-submit" class="btn btn-primary ml-4" value="Submit" onclick="">
  </form>
<script>
var sandbox = '';
sandbox = jQuery('#sandbox').val();
if(sandbox == false){
  jQuery('.sandbox-options').hide();
  jQuery('.checkbox-val').prop('checked', false);
  jQuery('.checkbox-val').val(false);
}

jQuery('#sandbox').change(function() {
  if (jQuery('#sandbox').is(":checked")){
    console.log('2nd');
      jQuery(this).val(true);
      jQuery('.sandbox-options').show();
    }else{
      console.log('3rd');
      jQuery(this).val(false);
      jQuery('.sandbox-options').hide();
      jQuery('.checkbox-val').prop('checked', false);
      jQuery('.checkbox-val').val(false);
    }
  });
  jQuery('.checkbox-val').change(function() {
    if (jQuery(this).is(":checked")){
    jQuery(this).val(true);
    console.log('4th');
  }else{
    console.log('5th');
    jQuery(this).val(false);
  }
});

</script>
