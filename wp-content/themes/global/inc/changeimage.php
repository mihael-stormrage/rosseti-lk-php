<?php 
  include_once('../../../../wp-config.php');
  include_once('../../../../wp-load.php');
  include_once('../../../../wp-includes/wp-db.php');


  if(is_user_logged_in() && $_GET['imageid']){
    $imageId = preg_replace("/[^,.0-9]/", '', $_GET['imageid']);
    update_user_meta(get_current_user_id(), 'gb2019_user_avatar', $imageId);
  } else {
    wp_redirect( home_url() . '/404'); 
  }
  die();
 ?> 