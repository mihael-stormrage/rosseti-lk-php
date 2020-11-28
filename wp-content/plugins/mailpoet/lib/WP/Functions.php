<?php
namespace MailPoet\WP;

use MailPoet\Config\Env;

class Functions {
  function wpRemotePost() {
    return call_user_func_array('wp_remote_post', func_get_args());
  }

  function wpRemoteGet() {
    return call_user_func_array('wp_remote_get', func_get_args());
  }

  function wpRemoteRetrieveBody() {
    return call_user_func_array('wp_remote_retrieve_body', func_get_args());
  }

  function wpRemoteRetrieveResponseCode() {
    return call_user_func_array('wp_remote_retrieve_response_code', func_get_args());
  }

  function wpRemoteRetrieveResponseMessage() {
    return call_user_func_array('wp_remote_retrieve_response_message', func_get_args());
  }

  function currentTime() {
    return call_user_func_array('current_time', func_get_args());
  }

  function getImageInfo($id) {
    /*
     * In some cases wp_get_attachment_image_src ignore the second parameter
     * and use global variable $content_width value instead.
     * By overriding it ourselves when ensure a constant behaviour regardless
     * of the user setup.
     *
     * https://mailpoet.atlassian.net/browse/MAILPOET-1365
     */
    global $content_width; // default is NULL

    $content_width_copy = $content_width;
    $content_width = Env::NEWSLETTER_CONTENT_WIDTH;
    $image_info = wp_get_attachment_image_src($id, 'mailpoet_newsletter_max');
    $content_width = $content_width_copy;

    return $image_info;
  }
}
