<div class="b-ideas site-width">
    <div class="b-ideas__b-wrap white-back">    
        <div class="b-ideas__items">
            <div class="b-ideas__item">
                <div class="b-ideas__item-img">
                    <img src="<?php echo wp_get_attachment_image_url( carbon_get_theme_option( 'catalogue_ideas_image' ), 'full'); ?>" alt="">
                </div>
                <div class="b-ideas__item-wrap">
                    <div class="b-ideas__item-detail">
                        <div class="b-ideas__item-title"><?php echo carbon_get_theme_option( 'catalogue_ideas_title' ); ?></div>
                        <div class="b-ideas__item-text"><?php echo carbon_get_theme_option( 'catalogue_ideas_content' ); ?></div>
                    </div>
                    <?php /*
                    <div class="b-ideas__main-area">
                        <div class="b-ideas__area-title">
                            Main areas
                        </div>
                        <div class="b-ideas__area-items">
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/industry_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Industry</span>
                            </a>
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/science_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Science</span>
                            </a>
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/biomed_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Biomed</span>
                            </a>
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/technology_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Technology</span>
                            </a>
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/design_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Design</span>
                            </a>
                            <a href="#" class="b-ideas__area-item">
                                <span class="b-ideas__area-item-img"><img src="img/vision_icon.png" alt=""></span>
                                <span class="b-ideas__area-item-title">Vision</span>
                            </a>
                        </div>
                    </div>
                    */ ?>
                </div>
            </div>
        </div>
        <?php if ( have_posts() ): ?>
        <div class="b-ideas__author">
          <?php while ( have_posts() ): the_post(); ?>
            <?php $author_id = $post->post_author; ?>
            <div class="b-ideas__author-item">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <div class="b-ideas__author-span"><span>Автор: </span><?php echo get_the_author_meta('_specialty') . ', ' ?><?php echo 'компания ' . get_the_author_meta('_company') . ', ' ?><?php echo get_the_author_meta('display_name'); ?></div>
            </div>
          <?php endwhile; ?>
        </div> 
        <?php endif; ?>   
    </div>
</div>