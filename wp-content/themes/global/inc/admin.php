<?php

## удаляет сообщение о новой версии WordPress у всех пользователей кроме администратора
if( is_admin() && ! current_user_can('manage_options') ) {
    add_action('init', function() {
        remove_action( 'init', 'wp_version_check' );
    }, 2 );

    add_filter('pre_option_update_core', '__return_null');
}

## Удаление табов "Все рубрики" и "Часто используемые" из метабоксов рубрик (таксономий) на странице редактирования записи.
function hide_tax_metabox_tabs_admin_styles(){
    $cs = get_current_screen();
    if( $cs->base !== 'post' || empty($cs->post_type) ) return; // не страница редактирования записи
    ?>
    <style>
        .postbox div.tabs-panel{ max-height:1200px; border:0; }
        .category-tabs{ display:none; }
    </style>
    <?php
}
add_action('admin_print_footer_scripts', 'hide_tax_metabox_tabs_admin_styles', 99);

##  отменим показ выбранного термина наверху в checkbox списке терминов
function set_checked_ontop_default( $args ) {
    // изменим параметр по умолчанию на false
    if( ! isset($args['checked_ontop']) )
        $args['checked_ontop'] = false;

    return $args;
}
add_filter( 'wp_terms_checklist_args', 'set_checked_ontop_default', 10 );

## Фильтр элементо втаксономии для метабокса таксономий в админке.
## Позволяет удобно фильтровать (искать) элементы таксономии по назанию, когда их очень много
add_action( 'admin_print_scripts', 'my_admin_term_filter', 99 );
function my_admin_term_filter() {
    $screen = get_current_screen();

    if( 'post' !== $screen->base ) return; // только для страницы редактирвоания любой записи
    ?>
    <script>
    jQuery(document).ready(function($){
        var $categoryDivs = $('.categorydiv');

        $categoryDivs.prepend('<input type="search" class="fc-search-field" placeholder="фильтр..." style="width:100%" />');

        $categoryDivs.on('keyup search', '.fc-search-field', function (event) {

            var searchTerm = event.target.value,
                $listItems = $(this).parent().find('.categorychecklist li');

            if( $.trim(searchTerm) ){
                $listItems.hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf(searchTerm.toLowerCase()) !== -1;
                }).show();
            }
            else {
                $listItems.show();
            }
        });
    });
    </script>
    <?php
}

## Отключаем пинги на свои же посты
function dip_disable_inner_ping( &$links ){
    foreach( $links as $k => $val )
        if( false !== strpos( $val, str_replace('www.', '', $_SERVER['HTTP_HOST']) ) )
            unset( $links[$k] );
}
add_action('pre_ping', 'dip_disable_inner_ping');

## Удаление файлов license.txt и readme.html для защиты
if( is_admin() && ! defined('DOING_AJAX') ){
    $license_file = ABSPATH .'/license.txt';
    $readme_file = ABSPATH .'/readme.html';

    if( file_exists($license_file) && current_user_can('manage_options') ){
        $deleted = unlink($license_file) && unlink($readme_file);

        if( ! $deleted  )
            $GLOBALS['readmedel'] = 'Не удалось удалить файлы: license.txt и readme.html из папки `'. ABSPATH .'`. Удалите их вручную!';
        else
            $GLOBALS['readmedel'] = 'Файлы: license.txt и readme.html удалены из из папки `'. ABSPATH .'`.';

        add_action( 'admin_notices', function(){  echo '<div class="error is-dismissible"><p>'. $GLOBALS['readmedel'] .'</p></div>'; } );
    }
}


## Добавляет миниатюры записи в таблицу записей в админке
add_action('init', 'add_post_thumbs_in_post_list_table', 20 );
function add_post_thumbs_in_post_list_table(){
    // проверим какие записи поддерживают миниатюры
    $supports = get_theme_support('post-thumbnails');

    // $ptype_names = array('post','page'); // указывает типы для которых нужна колонка отдельно

    // Определяем типы записей автоматически
    if( ! isset($ptype_names) ){
        if( $supports === true ){
            $ptype_names = get_post_types(array( 'public'=>true ), 'names');
            $ptype_names = array_diff( $ptype_names, array('attachment') );
        }
        // для отдельных типов записей
        elseif( is_array($supports) ){
            $ptype_names = $supports[0];
        }
    }

    // добавляем фильтры для всех найденных типов записей
    foreach( $ptype_names as $ptype ){
        add_filter( "manage_{$ptype}_posts_columns", 'add_thumb_column' );
        add_action( "manage_{$ptype}_posts_custom_column", 'add_thumb_value', 10, 2 );
    }
}

// добавим колонку
function add_thumb_column( $columns ){
    // подправим ширину колонки через css
    add_action('admin_notices', function(){
        echo '
            <style>
                .column-thumbnail{ width:80px; text-align:center; }
            </style>';
    });

    $num = 1; // после какой по счету колонки вставлять новые

    $new_columns = array( 'thumbnail' => __('Thumbnail') );

    return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
}

// заполним колонку
function add_thumb_value( $colname, $post_id ){
    if( 'thumbnail' == $colname ){
        $width  = $height = 45;

        // миниатюра
        if( $thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true ) ){
            $thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
        }
        // из галереи...
        elseif( $attachments = get_children( array(
            'post_parent'    => $post_id,
            'post_mime_type' => 'image',
            'post_type'      => 'attachment',
            'numberposts'    => 1,
            'order'          => 'DESC',
        ) ) ){
            $attach = array_shift( $attachments );
            $thumb = wp_get_attachment_image( $attach->ID, array($width, $height), true );
        }

        echo empty($thumb) ? ' ' : $thumb;
    }
}

## Подсказки (счетчики) в меню админ-панели
function add_user_menu_bubble() {
    global $menu;

    // записи
    $count = wp_count_posts()->pending; // на утверждении
    if( $count ){
        foreach( $menu as $key => $value ){
            if( $menu[$key][2] == 'edit.php' ){
                $menu[$key][0] .= ' <span class="awaiting-mod"><span class="pending-count">' . $count . '</span></span>';
                break;
            }
        }
    }
}
add_action( 'admin_menu', 'add_user_menu_bubble' );

## Произвольный порядок пунктов в главном меню админки
if( is_admin() ) {

    add_filter('custom_menu_order', '__return_true'); // включаем ручную сортировку

    add_filter('menu_order', 'custom_menu_order'); // ручная сортировка

    function custom_menu_order( $menu_order ){
        /*
        $menu_order - массив где элементы меню выставлены в нужном порядке.
        Array(
            [0] => index.php
            [1] => separator1
            [2] => edit.php
            [3] => upload.php
            [4] => edit.php?post_type=page
            [5] => edit-comments.php
            [6] => edit.php?post_type=events
            [7] => separator2
            [8] => themes.php
            [9] => plugins.php
            [10] => snippets
            [11] => users.php
            [12] => tools.php
            [13] => options-general.php
            [14] => separator-last
            [15] => edit.php?post_type=cfs
        )
        */
        if( ! $menu_order ) return true;

        return array(
            'index.php', // консоль
            'separator1',
            'edit.php?post_type=news2', // news2
            'edit.php?post_type=catalogue', // catalogue
            'edit.php?post_type=ideas', // ideas
            'edit.php?post_type=projects', // projects
            'edit.php?post_type=catalogue_options', // catalogue_options
            'separator2',   
            // 'edit.php', // посты 
        );
    }
}

// Customise the footer in admin area
function solvers_footer_admin () {
    _e('Разработано в <a href="https://solvers.group" target="_blank" rel="noreferrer">solvers.group</a>. Работает на <a href="https://wordpress.org" target="_blank" rel="noreferrer">Wordpress</a>.', 'SolversGroup');
}
add_filter('admin_footer_text', 'solvers_footer_admin');
