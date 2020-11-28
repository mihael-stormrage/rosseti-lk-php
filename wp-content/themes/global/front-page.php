<?php get_header(); the_post(); ?>

<div class="wrp-content">
    <div class="we-work">
      <div class="we-work__section">
        <div class="we-work__icon">
          <img src="<?php echo wp_get_attachment_image_url( carbon_get_post_meta( get_the_ID(), 'work_image' ) , 'full'); ?>" alt="">
        </div>

        <!-- e:icon -->
        <div class="we-work__body">
          <div class="we-work__title"><?php echo carbon_get_post_meta( get_the_ID(), 'work_title' ); ?></div>
          <div class="we-work__desc">
            <p><?php echo carbon_get_post_meta( get_the_ID(), 'work_text' ); ?></p>
          </div>

          <!-- e:desc -->
        </div>

        <!-- e:body -->
      </div>

      <!-- e:section -->
    </div>

    <!-- b:we-work -->
    <div class="main-projects">
      <div class="main-projects__section">
        <div class="main-projects__icons">
          <?php foreach (carbon_get_post_meta( get_the_ID(), 'project_items' ) as $key => $project) : ?>
          <div class="main-projects__icon">
            <div class="main-projects__img">
              <img src="<?php echo wp_get_attachment_image_url( $project['icon'], 'full'); ?>" alt="">
            </div>
            <div class="main-projects__name"><?php echo $project['title']; ?></div>
          </div>
          <?php endforeach; ?>
        </div>

        <!-- e:icons -->
        <div class="main-projects__body">
          <div class="main-projects__title"><?php echo carbon_get_post_meta( get_the_ID(), 'project_title' ); ?></div>
          <div class="main-projects__desc">
            <p><?php echo carbon_get_post_meta( get_the_ID(), 'project_text' ); ?></p>
          </div>

          <!-- e:desc -->
        </div>

        <!-- e:body -->
      </div>

      <!-- e:section -->
    </div>

    <!-- b:main-projects -->
    <div class="ideas-main">
      <div class="ideas-main__section">
        <div class="ideas-main__icon">
          <img src="<?php echo wp_get_attachment_image_url( carbon_get_post_meta( get_the_ID(), 'idea_image' ) , 'full'); ?>" alt="">
        </div>

        <!-- e:icon -->
        <div class="ideas-main__body">
          <div class="ideas-main__title"><?php echo carbon_get_post_meta( get_the_ID(), 'idea_title' ); ?></div>
          <div class="ideas-main__desc">
            <p><?php echo carbon_get_post_meta( get_the_ID(), 'idea_text' ); ?></p>
          </div>

          <!-- e:desc -->
        </div>

        <!-- e:body -->
      </div>

      <!-- e:section -->
    </div>

    <!-- b:ideas-main -->
</div>


<?php if($banners1 = carbon_get_post_meta( get_the_ID(), 'main_banners1' )): ?>
<div class="b-baner b-baner--negative-indent">
    <div class="b-baner__section site-width">
        <div class="b-baner__items">
          <?php foreach ($banners1 as $key => $banner): ?>
            <a href="<?php echo $banner['title']; ?>" target="_blank" class="b-baner__item">
                <img src="<?php echo wp_get_attachment_image_url($banner['image'], 'full'); ?>" alt="">
            </a><!-- e:item -->
          <?php endforeach ?>
        </div><!-- e:items -->
    </div><!-- e:section -->
</div><!-- b:b-baner -->
<?php endif; ?>

<?php get_template_part('template-parts/form', 'subscribe'); ?>

<?php if($banners2 = carbon_get_post_meta( get_the_ID(), 'main_banners2' )) : ?>
<div class="b-baner b-baner--type2 negative-indent-type2">
    <div class="b-baner__section site-width">
        <div class="b-baner__items">
          <?php foreach ($banners2 as $key => $banner): ?>
            <a href="<?php echo $banner['title']; ?>" target="_blank" class="b-baner__item">
                <img src="<?php echo wp_get_attachment_image_url($banner['image'], 'full'); ?>" alt="">
            </a><!-- e:item -->
          <?php endforeach ?>
        </div><!-- e:items -->
    </div><!-- e:section -->
</div><!-- b:b-baner -->
<?php endif; ?>
  
<?php get_footer(); ?>
