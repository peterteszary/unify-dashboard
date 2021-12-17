<?php
/*Add option*/
add_site_option('custom_url_link', '', '', 'yes');

/*Add option*/
add_site_option('security-options', '', '', 'yes');

add_site_option('allow-forms', '', '', 'yes');
add_site_option('allow-pointer-lock', '', '', 'yes');
add_site_option('allow-popups', '', '', 'yes');
add_site_option('allow-same-origin', '', '', 'yes');
add_site_option('allow-scripts', '', '', 'yes');
add_site_option('allow-top-navigation', '', '', 'yes');

/* Adding options for main menu*/
for ($i=1; $i <=30 ; $i++) {
  add_site_option("menu_url_name_$i", "", "", "");
  add_site_option("menu_url_link_$i", "", "", "");
  add_site_option("menu_url_icon_$i", "", "", "");
}

/* Chceck Widget Option*/
add_site_option("check_widget_box", "", "", "");

/* Adding options for widget menu*/
for ($i=1; $i <=10 ; $i++) {
  add_site_option("widget_name_$i", "", "", "");
  add_site_option("widget_url_$i", "", "", "");
  add_site_option("widget_height_$i", "", "", "");
  add_site_option("widget_user_roles_$i", "", "", "");
}
