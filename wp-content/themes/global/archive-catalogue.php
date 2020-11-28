<?php get_header(); ?>

<?php get_template_part('template-parts/news', 'archive'); ?>
<?php if($banners1 = carbon_get_theme_option( 'cataloguegi_ideas_banners1' )) : ?>
<div class="b-baner b-baner--type2">
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

<?php if($banners2 = carbon_get_theme_option( 'cataloguegi_ideas_banners2' )) : ?>
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

