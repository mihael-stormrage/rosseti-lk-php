<?php 
$user_id = get_current_user_id();

$args = array(
  'author'      => (string) $user_id,
  'posts_per_page'   => -1, // no limit
  'orderby'          => 'date',
  'order'            => 'DESC',
  // 'include'          => array(),
  // 'exclude'          => array(),
  'meta_key'         => '',
  'meta_value'       =>'',
  'post_status'      => 'publish, pending',
  // 'post_type'        => array( 'ideas', 'projects', 'catalogue' ),
  'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
);

$catalogue_posts = get_posts(array_merge( array('post_type' => 'catalogue'), $args));
$ideas_posts = get_posts(array_merge( array('post_type' => 'ideas'), $args));
$projects_posts = get_posts(array_merge( array('post_type' => 'projects'), $args));

$all_posts = array($catalogue_posts, $ideas_posts, $projects_posts);

?>


<div class="info-materials">
  <div class="info-materials__section">
    <h2 class="info-materials__title">Информация о материалах</h2>

    <!-- e:title -->
    <div class="info-materials__items">
      <div class="info-materials__item info-materials__item--post_types">
        <div class="info-materials__links">
          <a href="#" class="active-info js-user-posts-type" data-tab-index="0">Материалы в каталоге</a>
          <a href="#" class="js-user-posts-type" data-tab-index="1">Идеи</a>
          <a href="#" class="js-user-posts-type" data-tab-index="2">Проекты</a>
        </div>

        <!-- e:links -->
      </div>
      <!-- e:item -->



      <!-- Каталог- -->

      <?php foreach ($all_posts as $key => $posts): ?>

      <div class="info-materials__tab<?php if($key == 0): ?> active-info<?php endif; ?>" data-tab-index="<?php echo $key; ?>">
        <?php if(empty($posts)) : ?>
          <div class="info-materials__message">Нет публикаций.</div>
        <?php else: ?>
          <div class="info-materials__checkbox">
            <label class="info-materials__label js-user-posts-tag" data-tags="<?php echo rus_to_lat('Статья'); ?>">
              <span class="info-materials__name">Автор</span>
              <input type="checkbox" name="" id="">
            </label>

            <!-- e:label -->
            <label class="info-materials__label js-user-posts-tag" data-tags="<?php echo rus_to_lat('Рецензия'); ?>">
              <span class="info-materials__name">Рецензент</span>
              <input type="checkbox" name="" id="">
            </label>

            <!-- e:label -->
          </div>

          <!-- e:checkbox -->
          

          <div class="info-materials__item">
            <div class="info-materials__links">
              <a href="#" class="active-info js-user-posts-status" data-post-status="publish" class="">Опубликованные</a>
              <a href="#" class="js-user-posts-status" data-post-status="pending">Ожидающие публикации</a>
            </div>
            <!-- e:links -->

            <?php foreach ($posts as $key => $post): setup_postdata($post); ?>
            <?php
              $tags = wp_get_post_terms( get_the_ID(), array('categor', 'rubrics', 'tags') );            

              $tags_assoc = array();
              $term_id = false; 
              foreach ($tags as $key2 => $tag) {
                  $tags_assoc[$tag->taxonomy] = $tag->name;

                  if($tag->taxonomy == "rubrics")
                    $term_id = $tag->term_id;
              }

              $tags_str = "";
              // Каталог №
              if(!empty($tags_assoc['categor'])) {
                $tags_str = $tags_str . $tags_assoc['categor'] . ', ';
              }

              // раздел
              if(!empty($tags_assoc['rubrics'])) {
                $tags_str =  $tags_str . 'раздел ' . $tags_assoc['rubrics'] . ', ';
              }

              // дата
              $tags_str = $tags_str . get_the_date( 'd.m.Y' ) . ', ';

              // рецензия/статья
              if(!empty($tags_assoc['tags'])) {
                $tags_str = $tags_str . mb_strtolower($tags_assoc['tags'], 'UTF-8');
              }
            ?>
            
            <div class="info-materials__preview-post is-hidden" data-tags="<?php echo rus_to_lat($tags_assoc['tags']); ?>" data-post-status="<?php echo $post->post_status; ?>">
              <a href="<?php the_permalink(); ?>" class="info-materials__preview-post-link"><?php the_title(); ?></a>
              <div class="info-materials__preview-post-info">
                <?php if($term_id) : ?>
                <div class="info-materials__preview-post-icon">
                  <img src="<?php echo wp_get_attachment_image_url( carbon_get_term_meta( $term_id, 'rubric_icon' ), 'full'); ?>" alt="">
                </div>
                <?php endif; ?>
                <div class="info-materials__preview-post-text"><?php echo $tags_str; ?></div>
              </div>
              <!-- e:preview-post-info -->
            </div>
            <!-- e:preview-post -->
            <?php endforeach; wp_reset_postdata(); ?>

            <div class="info-materials__preview-post-status active-info" data-post-status="publish">
              <div class="info-materials__no-posts">Нет публикаций</div>
            </div>
            <div class="info-materials__preview-post-status" data-post-status="pending">
              <div class="info-materials__no-posts">Нет публикаций</div>
            </div>

          </div>

          <!-- e:item -->
        <?php endif; ?>
      </div>

      <?php endforeach; ?>

    </div>

    <!-- e:items -->
  </div>

  <!-- e:section -->
</div>

<!-- b:info-materials -->