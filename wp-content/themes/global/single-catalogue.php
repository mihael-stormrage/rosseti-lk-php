<?php get_header(); the_post(); ?>
<div class="b-news site-width">
    <div class="b-news__items">
        <div class="b-news__item white-back">
            <div class="b-news__item-detail">
                <div class="b-news__item-data"><?php echo get_the_date( 'd.m.Y' ); ?></div>
                <div class="b-news__item-img"><?php the_post_thumbnail(); ?></div>
                <br>
                <div class="b-news__item-content"><?php the_content(); ?></div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>