<?php

define( 'THEME_LANG', 'Global Ideas' );

require_once( 'vendor/autoload.php' );

require_once( 'inc/admin.php' );
require_once( 'inc/carbonfields.php' );
require_once( 'inc/svg_icon.php' );
require_once( 'inc/cyr2lat.php' );

if ( ! function_exists( 'glb2019_setup' ) ) :
    function glb2019_setup() {

        // Remove the version number of WP
        // Warning - this info is also available
        // in the readme.html file in your root directory - delete this file!
        remove_action( 'wp_head', 'wp_generator' );

        // removes EditURI/RSD (Really Simple Discovery) link
        remove_action( 'wp_head', 'rsd_link' );

        // removes wlwmanifest (Windows Live Writer) link
        remove_action( 'wp_head', 'wlwmanifest_link' );

        // removes shortlink
        remove_action( 'wp_head', 'wp_shortlink_wp_head' );

        // removes feed links
        remove_action( 'wp_head', 'feed_links', 2 );

        // removes comments feed
        remove_action( 'wp_head', 'feed_links_extra', 3 );

        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );

        remove_action( 'wp_head', 'rest_output_link_wp_head' );

        remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'customize-selective-refresh-widgets' );
        add_theme_support( 'widgets' );

        add_theme_support( 'custom-logo', array(
            'width'       => 140,
            'height'      => 315,
            'flex-height' => true,
            'flex-width'  => true,
            'header-text' => false,
        ));

        add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        // add_image_size('news-thumb', 380, 380, true);

        //Register Menus
        register_nav_menus( array(
            'main_menu' => __( 'Меню', THEME_LANG ),
            // 'main_menu2' => __( 'Меню2', THEME_LANG )
        ) );
    }
endif;
add_action( 'after_setup_theme', 'glb2019_setup' );

function glb2019_register_post_types() {

    ## Новости
    register_post_type('news2', array(
        'labels' => array(
            'name'            => 'Новости',
            'singular_name'   => 'Новость',
            'all_items'       => 'Все новости',
            'add_new'         => 'Добавить новую',
            'add_new_item'    => 'Добавить новую новость',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 2,
        'menu_icon'           => 'dashicons-format-aside',
        'hierarchical'        => false,
        'supports'            => array(  'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => array(
            'slug'       => 'news',
            'with_front' => false
        ),
        'query_var'           => true,
    ) );

    ## Каталог GI
    register_post_type('catalogue', array(
        'labels' => array(
            'name'            => 'Каталог GI',
            'singular_name'   => 'Каталог',
            'all_items'       => 'Весь каталог',
            'add_new'         => 'Добавить новую запись',
            'add_new_item'    => 'Добавить новую запись',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 3,
        'menu_icon'           => 'dashicons-star-filled',
        'hierarchical'        => false,
        'supports'            => array(  'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => array(
            'slug'       => 'catalogue',
            'with_front' => false
        ),
        'query_var'           => true,
    ) );


    ## Идеи и проекты
    ### Записи
    register_post_type('ideas', array(
        'labels' => array(
            'name'            => 'Идеи',
            'singular_name'   => 'Идея',
            'all_items'       => 'Все идеи',
            'add_new'         => 'Добавить новую',
            'add_new_item'    => 'Добавить новую идею',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 4,
        'menu_icon'           => 'dashicons-lightbulb',
        'hierarchical'        => false,
        'supports'            => array(  'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => array(
            'slug'       => 'ideas',
            'with_front' => false
        ),
        'query_var'           => true,
    ) );

    register_post_type('projects', array(
        'labels' => array(
            'name'            => 'Проекты',
            'singular_name'   => 'Проект',
            'all_items'       => 'Все проекты',
            'add_new'         => 'Добавить новый',
            'add_new_item'    => 'Добавить новый проекты',
        ),
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'exclude_from_search' => true,
        'show_ui'             => null,
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'show_in_admin_bar'   => null, // по умолчанию значение show_in_menu
        'show_in_nav_menus'   => true,
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-upload',
        'hierarchical'        => false,
        'supports'            => array(  'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
        'taxonomies'          => array(),
        'has_archive'         => true,
        'rewrite'             => array(
            'slug'       => 'projects',
            'with_front' => false
        ),
        'query_var'           => true,
    ) );

    ## Идеи и проекты
    ### Таксономии. Рубрики
    // список параметров: http://wp-kama.ru/function/get_taxonomy_labels
    register_taxonomy('rubrics', array('ideas', 'projects', 'catalogue'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Разделы',
            'singular_name'     => 'Раздел',
            'search_items'      => 'Поиск раздела',
            'all_items'         => 'Все разделы',
            'view_item '        => 'Просмотр раздела',
            'parent_item'       => 'Родительский раздел',
            'parent_item_colon' => 'Родительский раздел:',
            'edit_item'         => 'Редактировать раздел',
            'update_item'       => 'Обновить раздел',
            'add_new_item'      => 'Добавить новый раздел',
            'new_item_name'     => 'Название нового раздела',
            'menu_name'         => 'Разделы',
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
        'show_tagcloud'         => true, // равен аргументу show_ui
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        'hierarchical'          => true,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    ) );

    ## Идеи и проекты
    ### Таксономии. Метки
    register_taxonomy('tags', array('ideas', 'projects', 'catalogue'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Mетки',
            'singular_name'     => 'Mетка',
            'search_items'      => 'Поиск метки',
            'all_items'         => 'Все метки',
            'view_item '        => 'Просмотр метки',
            // 'parent_item'       => 'Родительский раздел',
            // 'parent_item_colon' => 'Родительский раздел:',
            'edit_item'         => 'Редактировать метку',
            'update_item'       => 'Обновить метку',
            'add_new_item'      => 'Добавить новую метку',
            'new_item_name'     => 'Название новой метки',
            'menu_name'         => 'Метки',
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
        'show_tagcloud'         => true, // равен аргументу show_ui
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        'hierarchical'          => false,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    ) );


    # Идеи и проекты
    ## Таксономии. Метки
    register_taxonomy('categor', array('ideas', 'projects', 'catalogue'), array(
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => array(
            'name'              => 'Каталоги',
            'singular_name'     => 'Каталог',
            'search_items'      => 'Поиск каталга',
            'all_items'         => 'Все каталоги',
            'view_item '        => 'Просмотр каталога',
            // 'parent_item'       => 'Родительский раздел',
            // 'parent_item_colon' => 'Родительский раздел:',
            'edit_item'         => 'Редактировать каталог',
            'update_item'       => 'Обновить каталог',
            'add_new_item'      => 'Добавить новый каталог',
            'new_item_name'     => 'Название нового каталога',
            'menu_name'         => 'Каталоги',
        ),
        'description'           => '', // описание таксономии
        'public'                => true,
        'publicly_queryable'    => null, // равен аргументу public
        'show_in_nav_menus'     => true, // равен аргументу public
        'show_ui'               => true, // равен аргументу public
        'show_in_menu'          => true, // равен аргументу show_ui
        'show_tagcloud'         => true, // равен аргументу show_ui
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        'hierarchical'          => false,
        'update_count_callback' => '',
        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // callback функция. Отвечает за html код метабокса (с версии 3.8): post_categories_meta_box или post_tags_meta_box. Если указать false, то метабокс будет отключен вообще
        'show_admin_column'     => false, // Позволить или нет авто-создание колонки таксономии в таблице ассоциированного типа записи. (с версии 3.5)
        '_builtin'              => false,
        'show_in_quick_edit'    => null, // по умолчанию значение show_ui
    ) );
}

add_action('init', 'glb2019_register_post_types');


function get_theme_logo( $attrs ) {

    $logo_id = get_theme_mod( 'custom_logo' );

    $logo_image = wp_get_attachment_image( $logo_id, 'full', false, $attrs );

    $default_logo = '<img class="' . $attrs['class'] . '" src="' . get_template_directory_uri() . '/images/img/app-logo.png' . '" itemprop="logo">';

    return !empty($logo_image) ? $logo_image : $default_logo;
}


function glb2019_body_class( $classes ){

    if( is_front_page() )
        $classes[] = 'app--main';

    if( is_page_template('page-contacts.php') )
        $classes[] = 'app--contacts';

    if( is_post_type_archive('catalogue') )
        $classes[] = 'app--catalog';

    if( is_post_type_archive('news2') )
        $classes[] = 'app--news';

    return $classes;
}
add_filter('body_class', 'glb2019_body_class');


//запрет доступа к админке start
// function wph_noadmin() {
//     if (is_admin() && !current_user_can('administrator')) {
//         wp_redirect(home_url());
//         exit;
//     } }
// add_action('init', 'wph_noadmin'); 
//запрет доступа к админке end


function prefix_customizer_register( $wp_customize ) {

    // vk url
    $wp_customize->add_setting( 'vk_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_url',
        'section' => 'title_tagline'
    ) );

    $wp_customize->add_control( 'vk_id', array(
        'type' => 'url',
        'priority' => 100,
        'section' => 'section_id',
        'label' => 'VK url',
        'description' => '',
        'section' => 'title_tagline'
    ) );

    // facebook url
    $wp_customize->add_setting( 'facebook_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_url',
        'section' => 'title_tagline'
    ) );

    $wp_customize->add_control( 'facebook_id', array(
        'type' => 'url',
        'priority' => 100,
        'section' => 'section_id',
        'label' => 'Facebook url',
        'description' => '',
        'section' => 'title_tagline'
    ) );

    // twitter url
    $wp_customize->add_setting( 'twitter_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_url',
        'section' => 'title_tagline'
    ) );

    $wp_customize->add_control( 'twitter_id', array(
        'type' => 'url',
        'priority' => 100,
        'section' => 'section_id',
        'label' => 'Twitter url',
        'description' => '',
        'section' => 'title_tagline'
    ) );

    // pinterest url
    $wp_customize->add_setting( 'pinterest_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_url',
        'section' => 'title_tagline'
    ) );

    $wp_customize->add_control( 'pinterest_id', array(
        'type' => 'url',
        'priority' => 100,
        'section' => 'section_id',
        'label' => 'Pinterest url',
        'description' => '',
        'section' => 'title_tagline'
    ) );

    // Copy
    $wp_customize->add_setting( 'copyright_id', array(
        'default' => '',
        'type' => 'theme_mod',
        'capability' => 'edit_theme_options',
        'transport' => '',
        'sanitize_callback' => 'esc_textarea',
        'section' => 'title_tagline'
    ) );

    $wp_customize->add_control( 'copyright_id', array(
        'type' => 'textarea',
        'priority' => 100,
        'section' => 'section_id',
        'label' => 'Копирайт',
        'description' => '',
        'section' => 'title_tagline'
    ) );


}
add_action( 'customize_register', 'prefix_customizer_register' );

## Удаляет "Рубрика: ", "Метка: " и т.д. из заголовка архива
function glb2019_remove_archive_prefix( $title ) {
    return preg_replace('~^[^:]+: ~', '', $title );
}
add_filter( 'get_the_archive_title', 'glb2019_remove_archive_prefix');

## Удаляет AUTOP в Contacts Form 7
add_filter('wpcf7_autop_or_not', '__return_false');

/**
 * Enqueue scripts and styles.
 */
function glb2019_scripts() {
    wp_register_style( 'OpenSans', 'https://fonts.googleapis.com/css?family=Open+Sans|Oswald:400,500,600,700', array(), '1.0.0' );
    wp_register_style( 'normalize', get_template_directory_uri() . '/css/normalize.css', array(), '1.0.0' );
    wp_register_style( 'plugins', get_template_directory_uri() . '/css/plugins.min.css', array(), '1.0.0' );
    wp_register_style( 'app', get_template_directory_uri() . '/css/style.css', array(), '1.0.0' );
    wp_register_style( 'dev', get_template_directory_uri() . '/css/dev.css', array(), '1.0.0' );

    wp_enqueue_style( 'OpenSans' );
    wp_enqueue_style( 'normalize' );
    wp_enqueue_style( 'plugins' );
    wp_enqueue_style( 'app' );
    wp_enqueue_style( 'dev' );

    wp_deregister_script( 'jquery' );

    wp_register_script( 'jquery', get_template_directory_uri() . '/js/vendors/jquery-3.2.1.min.js', array(), '3.2.1', true );
    wp_register_script( 'plugins', get_template_directory_uri() . '/js/plugins.min.js', array('jquery'), '1.0.0', true );
    wp_register_script( 'app', get_template_directory_uri() . '/js/app.js', array('jquery'), '1.0.0', true );
    wp_register_script( 'googlemap', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyA0HoTAdhItKayUeV3yP_SFVzHKCrE1d9E&callback=initMap', array(), '1.0.0', true );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'plugins' );
    wp_enqueue_script( 'app' );

    if( is_page_template('page-contacts.php') )
        wp_enqueue_script( 'googlemap' );

    wp_localize_script( 'app', 'globalids', 
        array(
            'url' => admin_url('admin-ajax.php'),
            'homeurl' => get_bloginfo('url')
        )
    );  


}
add_action( 'wp_enqueue_scripts', 'glb2019_scripts' );

// Разрешить пользователям добавлять файлы
add_action( 'admin_init', 'allow_customer_upload');
function allow_customer_upload() {
    
    $role = get_role( 'contributor' );

    $role->add_cap( 'upload_files' ); 
}

// function my_myme_types($mime_types){
//     $mime_types['svg'] = 'image/svg+xml'; // поддержка SVG
//     return $mime_types;
// }
// add_filter('upload_mimes', 'my_myme_types', 1, 1);

## Dynamic cf7 fields
// user
function cf7_add_current_user(){
    $user_id = get_current_user_id();
    $user_display_name = get_user_meta($user_id, 'display_name', true);
    $user_nickname = get_user_meta($user_id, 'nickname', true);

    return $user_display_name . ' (' . $user_nickname . ')';
}

// first_name 
function cf7_add_current_user_firt_name(){
    $user_id = get_current_user_id();
    $user_first_name = get_user_meta($user_id, 'first_name', true);

    return $user_first_name;
}

// company 
function cf7_add_current_user_company(){
    $user_id = get_current_user_id();
    $user_company = get_user_meta($user_id, '_company', true);

    return $user_company;
}

// user_email 
function cf7_add_current_user_email(){
    $user_id = get_current_user_id();
    $user_info = get_userdata($user_id);
    $user_user_email = $user_info->user_email;

    return $user_user_email;
}
 
add_shortcode('CF7_CURRENT_USER', 'cf7_add_current_user'); 
add_shortcode('CF7_CURRENT_USER_FIRST_NAME', 'cf7_add_current_user_firt_name'); 
add_shortcode('CF7_CURRENT_USER_COMPANY', 'cf7_add_current_user_company'); 
add_shortcode('CF7_CURRENT_USER_EMAIL', 'cf7_add_current_user_email'); 

         
// add the filter 
add_filter( 'wpcf7_default_template', 'filter_wpcf7_default_template', 10, 2 ); 

// add_action('wp_ajax_nopriv_my_action', 'my_action_callback');
add_action('wp_ajax_update_user', 'update_user_callback');
function update_user_callback() {

    if(isset($_POST['options'])) {

        $user_id = get_current_user_id();
        $options = $_POST['options'];

        foreach ($options as $key => $option) {
            if($key == 'user_email' || $key == 'display_name') {

                $args = array_merge( array('ID' => $user_id), array( $key => $option ) );
                $user = wp_update_user( $args );
                
                if ( is_wp_error( $user ) ) {
                    echo $user->get_error_message();
                } else {
                    echo 'Данные успешно обновлены!';
                }

            } else {
                update_user_meta($user_id, $key, $option);
                echo 'Данные успешно обновлены!';
            }
        }

    }

    // выход нужен для того, чтобы в ответе не было ничего лишнего, только то что возвращает функция
    wp_die();
}

