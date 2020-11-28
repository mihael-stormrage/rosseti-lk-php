<div class="b-news site-width">
  <div class="b-news__items">
  <?php if ( have_posts() ): ?>
    <?php while ( have_posts() ): the_post(); ?>
    <div class="b-news__item white-back">
      <div class="b-news__item-img">
        <img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="">
      </div>
      <div class="b-news__item-detail">
        <div class="b-news__item-data"><?php echo get_the_date( 'd.m.Y' ); ?></div>
        <div class="b-news__item-title"><?php the_title(); ?></div>
        <div class="b-news__item-text"><?php the_excerpt(); ?></div>
        <?php if(is_post_type_archive( 'news2' )) : ?>
        <div class="b-news__item-read-more">
          <a href="<?php the_permalink(); ?>">Подробнее</a>
        </div>
        <?php endif; ?>
      </div>
    </div>
    <?php endwhile; ?>
  <?php else: ?>
    <div class="b-news__item white-back">
      <?php echo wpautop( 'Новостей для вывода не найдено.' ); ?>
    </div>
  <?php endif; ?>
  </div>
</div>
