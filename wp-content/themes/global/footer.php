
        </main>

        <!-- e:main -->
        <footer class="app-footer">
          <div class="app-footer__wrap site-width">
            <div class="app-footer__all-rights"><?php echo get_theme_mod( 'copyright_id' ); ?> <?php echo date("Y"); ?></div>
            <div class="soc">
              
              <?php if( $vk_id = get_theme_mod( 'vk_id' ) ): ?>
              <a target="_blank" href="<?php echo $vk_id; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/vk-icon.svg" alt="">
              </a>
              <?php endif; ?>

              <?php if( $facebook_id = get_theme_mod( 'facebook_id' ) ): ?>
              <a target="_blank" href="<?php echo $facebook_id; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/fk-icon.svg" alt="">
              </a>
              <?php endif; ?>

              <?php if( $twitter_id = get_theme_mod( 'twitter_id' ) ): ?>
              <a target="_blank" href="<?php echo $twitter_id; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/tw-icon.svg" alt="">
              </a>
              <?php endif; ?>

              <?php if( $pinterest_id = get_theme_mod( 'pinterest_id' ) ): ?>
              <a target="_blank" href="<?php echo $pinterest_id; ?>">
                <img src="<?php echo get_template_directory_uri(); ?>/img/p-icon.svg" alt="">
              </a>
              <?php endif; ?>

            </div>
          </div>
        </footer>

        <!-- b:app-footer -->
      </div>

      <!-- b:m-content -->
    </div>

    <!-- b:wrapper -->

    <?php wp_footer(); ?>
  </body>

  <!-- b:w-page -->
</html>