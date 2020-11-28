<?php 

/* Template Name: Форма */

$user_id = get_current_user_id();

if(!$user_id) {
  wp_redirect(get_bloginfo( 'url' ) . '/avtorizaciya/');
}

get_header(); the_post(); ?>
  <div class="wrp-content wrp-content--mod">
    <?php the_content(); ?>
  </div>
<?php get_footer(); ?>
