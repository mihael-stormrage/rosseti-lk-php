<?php 

/*
Template Name: Контакты
*/

get_header(); the_post(); ?>

  <div class="b-contacts site-width">
    <div class="b-contacts__wrap white-back">
      <div class="b-contacts__detail-wrap">
        <div class="b-contacts__detail">
          <a class="b-contacts__detail-item">
            <span class="b-contacts__item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/adress_icon.svg" alt=""></span>
            <span class="b-contacts__item-text"><?php echo carbon_get_post_meta( get_the_ID(), 'address_text' ); ?></span>
          </a>
          <a href="tel:+74958957921" class="b-contacts__detail-item">
            <span class="b-contacts__item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/telephone_icon.svg" alt=""></span>
            <span class="b-contacts__item-text"><?php echo carbon_get_post_meta( get_the_ID(), 'phone_text' ); ?></span>
          </a>
          <a href="email:info@global-ideas.world" class="b-contacts__detail-item">
            <span class="b-contacts__item-img"><img src="<?php echo get_template_directory_uri(); ?>/img/e-mai_icon.svg" alt=""></span>
            <span class="b-contacts__item-text"><?php echo carbon_get_post_meta( get_the_ID(), 'email_text' ); ?></span>
          </a>
        </div>

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
      <div class="b-contacts__map-wrap">
        <div id="map" class="b-contacts__map">
        </div>
        <div class="b-contacts__mapzoom">
          <button class="b-contacts__mapzoom-in">+</button>
          <button class="b-contacts__mapzoom-out">–</button>
        </div>
      </div>
      <?php $map = carbon_get_post_meta( get_the_ID(), 'crb_company_location' ); ?>
      <script>
        var map;
        function initMap() {
          map = new google.maps.Map(document.querySelector('#map'), {
            center: {
              lat: <?php echo $map['lat']; ?>,
              lng: <?php echo $map['lng']; ?>
            },
            zoom: 8,
            disableDefaultUI: true,
          });
          initZoomControl(map);
          initMapTypeControl(map);
          initFullscreenControl(map);
        }
        // function initZoomControl(map) {
        //   document.querySelector('.zoom-control-in').onclick = function() {
        //     map.setZoom(map.getZoom() + 1);
        //   };
        //   document.querySelector('.zoom-control-out').onclick = function() {
        //     map.setZoom(map.getZoom() - 1);
        //   };
        //   map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
        //       document.querySelector('.zoom-control'));
        // }
        function initZoomControl(map) {
          document.querySelector('.b-contacts__mapzoom-in').onclick = function() {
            map.setZoom(map.getZoom() + 1);
          };
          document.querySelector('.b-contacts__mapzoom-out').onclick = function() {
            map.setZoom(map.getZoom() - 1);
          };
          map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
            document.querySelector('.zoom-control'));
        }
        function initMapTypeControl(map) {
          var mapTypeControlDiv = document.querySelector('.maptype-control');
          document.querySelector('.maptype-control-map').onclick = function() {
            mapTypeControlDiv.classList.add('maptype-control-is-map');
            mapTypeControlDiv.classList.remove('maptype-control-is-satellite');
            map.setMapTypeId('roadmap');
          };
          document.querySelector('.maptype-control-satellite').onclick =
            function() {
              mapTypeControlDiv.classList.remove('maptype-control-is-map');
              mapTypeControlDiv.classList.add('maptype-control-is-satellite');
              map.setMapTypeId('hybrid');
            };
          map.controls[google.maps.ControlPosition.LEFT_TOP].push(
            mapTypeControlDiv);
        }
        function initFullscreenControl(map) {
          var elementToSendFullscreen = map.getDiv().firstChild;
          var fullscreenControl = document.querySelector('.fullscreen-control');
          map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
            fullscreenControl);
          fullscreenControl.onclick = function() {
            if (isFullscreen(elementToSendFullscreen)) {
              exitFullscreen();
            } else {
              requestFullscreen(elementToSendFullscreen);
            }
          };
          document.onwebkitfullscreenchange =
            document.onmsfullscreenchange =
            document.onmozfullscreenchange =
            document.onfullscreenchange = function() {
              if (isFullscreen(elementToSendFullscreen)) {
                fullscreenControl.classList.add('is-fullscreen');
              } else {
                fullscreenControl.classList.remove('is-fullscreen');
              }
            };
        }
        function isFullscreen(element) {
          return (document.fullscreenElement ||
            document.webkitFullscreenElement ||
            document.mozFullScreenElement ||
            document.msFullscreenElement) == element;
        }
        function requestFullscreen(element) {
          if (element.requestFullscreen) {
            element.requestFullscreen();
          } else if (element.webkitRequestFullScreen) {
            element.webkitRequestFullScreen();
          } else if (element.mozRequestFullScreen) {
            element.mozRequestFullScreen();
          } else if (element.msRequestFullScreen) {
            element.msRequestFullScreen();
          }
        }
        function exitFullscreen() {
          if (document.exitFullscreen) {
            document.exitFullscreen();
          } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
          } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
          } else if (document.msCancelFullScreen) {
            document.msCancelFullScreen();
          }
        }
      </script>
      <div style="display:none;">
        <div class="controls zoom-control">
          <button class="zoom-control-in" title="Zoom In">+</button>
          <button class="zoom-control-out" title="Zoom Out">−</button>
        </div>
        <div class="controls maptype-control maptype-control-is-map">
          <button class="maptype-control-map" title="Show road map">Map</button>
          <button class="maptype-control-satellite" title="Show satellite imagery">Satellite</button>
        </div>
        <div class="controls fullscreen-control">
          <button title="Toggle Fullscreen">
            <div class="fullscreen-control-icon fullscreen-control-top-left"></div>
            <div class="fullscreen-control-icon fullscreen-control-top-right"></div>
            <div class="fullscreen-control-icon fullscreen-control-bottom-left"></div>
            <div class="fullscreen-control-icon fullscreen-control-bottom-right"></div>
          </button>
        </div>
      </div>
    </div>
  </div>

  <?php the_content(); ?>

  <?php if($banners2 = carbon_get_post_meta( get_the_ID(), 'contacts_banners' )) : ?>
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
