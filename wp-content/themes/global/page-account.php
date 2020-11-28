<?php 

/* Template Name: Личный кабинет */

$user_id = get_current_user_id();
$user = get_userdata($user_id);

if(!$user_id) {
  wp_redirect(get_bloginfo( 'url' ) . '/avtorizaciya/');
}

get_header(); ?>

<div class="wrp-content wrp-content--mod-user">
  <div class="b-cabinet-info">
    <div class="b-cabinet-info__section">
      <form action="#" class="b-cabinet-info__form js-update-user-form" method="POST" enctype="multipart/form-data">

        <script type="text/javascript">
          function upload(callback){
            var fileInputElement = document.getElementById("image-upload");
            if(!fileInputElement.files.length){
              callback();
              return;
            }
            
            var formData = new FormData();
            formData.append("action", "upload-attachment");

            formData.append("async-upload", fileInputElement.files[0]);
            formData.append("name", fileInputElement.files[0].name);

            //also available on page from _wpPluploadSettings.defaults.multipart_params._wpnonce
            <?php $my_nonce = wp_create_nonce('media-form'); ?>
            formData.append("_wpnonce", "<?php echo $my_nonce; ?>");
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange=function(){
              if (xhr.readyState==4 && xhr.status==200){
                var response = JSON.parse(xhr.responseText);                
                var id       = response.data.id;
                var url      = response.data.url;

                var newAjax  = new XMLHttpRequest();
                newAjax.open("POST","<?php echo get_template_directory_uri();?>/inc/changeimage.php?imageid=" + id,true);
                newAjax.send('test');

                callback();
              }
            }

            xhr.open("POST", globalids.homeurl + "/wp-admin/async-upload.php",true);
            xhr.send(formData);
          }
          </script>
        <div class="b-cabinet-info__body">
          <div class="b-cabinet-info__items">
            <div class="b-cabinet-info__item">
              <div class="b-cabinet-info__title">Имя/Псевдоним</div>

              <!-- e:title -->
              <div class="b-cabinet-info__modify">
                <div class="b-cabinet-info__text b-cabinet-info__text--border-bot">
                  <input type="text" disabled="" required name="display_name" value="<?php echo $user->get('display_name'); ?>" class="b-cabinet-info__user-date">
                </div>
                <div class="b-cabinet-info__edit">
                  <span class="b-cabinet-info__editBtn"><i class="svg-icon svg-icon--edit-01"><svg class="svg-icon__link"><use xlink:href="#edit-01"></use></svg></i></span>
                  <button type="submit" class="js-update-user-field">
                    <i class="svg-icon svg-icon--save-01"><svg class="svg-icon__link"><use xlink:href="#save-01"></use></svg></i>
                  </button> 
                </div>

                <!-- e:edit -->
              </div>

              <!-- e:modify -->
            </div>

            <!-- e:item -->
            <div class="b-cabinet-info__item">
              <div class="b-cabinet-info__title">Специальность</div>

              <!-- e:title -->
              <?php /*<div class="b-cabinet-info__modify">
                <div class="b-cabinet-info__text"><?php echo $user->has_prop('_specialty') ? $user->get('_specialty') : 'Не задано'; ?></div>
              </div> */ ?>

              <div class="b-cabinet-info__modify">
                <div class="b-cabinet-info__text b-cabinet-info__text--border-bot">
                  <input type="text" disabled="" name="_specialty" placeholder="Не задано" value="<?php echo $user->get('_specialty'); ?>" class="b-cabinet-info__user-date">
                </div>
                <div class="b-cabinet-info__edit">
                  <span class="b-cabinet-info__editBtn"><i class="svg-icon svg-icon--edit-01"><svg class="svg-icon__link"><use xlink:href="#edit-01"></use></svg></i></span>
                  <button type="submit" class="js-update-user-field">
                    <i class="svg-icon svg-icon--save-01"><svg class="svg-icon__link"><use xlink:href="#save-01"></use></svg></i>
                  </button> 
                </div>

                <!-- e:edit -->
              </div>

              <!-- e:modify -->

              <!-- e:modify -->
            </div>

            <!-- e:item -->
            <div class="b-cabinet-info__item">
              <div class="b-cabinet-info__title">Компания</div>

              <!-- e:title -->
              <div class="b-cabinet-info__modify">
                <div class="b-cabinet-info__text b-cabinet-info__text--border-bot">
                  <input type="text" disabled="" name="_company" placeholder="Не задано" value="<?php echo $user->get('_company'); ?>" class="b-cabinet-info__user-date">
                </div>
                <div class="b-cabinet-info__edit">
                  <span class="b-cabinet-info__editBtn"><i class="svg-icon svg-icon--edit-01"><svg class="svg-icon__link"><use xlink:href="#edit-01"></use></svg></i></span>
                  <button type="submit" class="js-update-user-field">
                    <i class="svg-icon svg-icon--save-01"><svg class="svg-icon__link"><use xlink:href="#save-01"></use></svg></i>
                  </button>
                </div>

                <!-- e:edit -->
              </div>

              <!-- e:modify -->
            </div>

            <!-- e:item -->
            <div class="b-cabinet-info__item">
              <div class="b-cabinet-info__title">E-mail</div>

              <!-- e:title -->
              <div class="b-cabinet-info__modify">
                <div class="b-cabinet-info__text b-cabinet-info__text--border-bot">
                  <input type="email" required disabled="" name="user_email" value="<?php echo $user->get('user_email'); ?>" class="b-cabinet-info__user-date">
                </div>
                <div class="b-cabinet-info__edit">
                  <span class="b-cabinet-info__editBtn"><i class="svg-icon svg-icon--edit-01"><svg class="svg-icon__link"><use xlink:href="#edit-01"></use></svg></i></span>
                  <button type="submit" class="js-update-user-field">
                    <i class="svg-icon svg-icon--save-01"><svg class="svg-icon__link"><use xlink:href="#save-01"></use></svg></i>
                  </button>
                </div>

                <!-- e:edit -->
              </div>

              <!-- e:modify -->
            </div>

            <?php /*
            <div class="b-cabinet-save">
              <button type="submit" class="site-btn">Сохранить</button>
            </div>
            */ ?>

            <!-- e:item -->

            <?php get_template_part('template-parts/user', 'posts'); ?>

          </div>

          <!-- e:items -->
          <div class="b-cabinet-info__user-info">
            <div class="download-pic download-pic--user">
              <div class="download-pic__section">
                <div class="download-pic__items">
                  <div class="download-pic__item">
                    <div class="download-pic__title">Фото автора</div>

                    <!-- e:title -->
                    <div class="download-pic__img-aria">
                      <?php echo get_avatar( $user_id, $size = 298, $default = '', $alt = '', $args = null ); ?>
                      <div id="image-preview" class="download-pic__image-preview">
                        <label for="image-upload" id="image-label"></label>
                        <input type="file" name="uploadavatar" id="image-upload" class="download-pic__image-file">
                      </div>
                    </div>
                    <?php /*<button type="submit" class="download-pic__btn-download">DOWNLOAD PICTURE</button>*/ ?>
                  </div>

                  <!-- e:item -->
                </div>

                <!-- e:items -->
              </div>

              <!-- e:section -->
            </div>

            <!-- b:download-pic -->

          </div>

          <!-- e:user-info -->
        </div>

        <!-- e:body -->
      </form>

      <!-- e:form -->
    </div>

    <!-- e:section -->
  </div>

  <!-- b:b-cabinet-info -->
</div>

<!-- b:wrp-content -->
    
    
 
<?php get_footer(); ?>
