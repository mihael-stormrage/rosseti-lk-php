<?php
/*
  Template Name: Авторизация 
*/
if(get_current_user_id()) {
  wp_redirect(get_bloginfo( 'url' ) . '/account/');
}

get_header(); the_post(); ?>
<div class="login">
  <div class="login__section site-width">
    <div class="login__body">
      <div class="login__img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/icon-login.png" alt="">
      </div>

      <!-- e:img -->
      <div class="login__form">
        <div class="login__items">
          <?php the_content(); ?>
        </div>
      </div>

      <!-- e:form -->
    </div>

    <!-- e:body -->
  </div>

  <!-- e:section -->
</div>

<!-- b:login -->
  
<?php get_footer(); ?>