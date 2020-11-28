<?php
/*
  Template Name: Регистрация 
*/

get_header(); the_post(); ?>
<div class="to-register">
  <div class="to-register__section site-width">
    <div class="to-register__body">
      <div class="to-register__img">
        <img src="<?php echo get_template_directory_uri(); ?>/img/to-reg-icon.png" alt="">
      </div>

      <!-- e:img -->
      <div class="to-register__form">
        <div class="to-register__items">
          <?php the_content(); ?>
          <!-- e:label -->
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
