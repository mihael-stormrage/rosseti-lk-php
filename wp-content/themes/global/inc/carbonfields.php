<?php

use Carbon_Fields\Container;
use Carbon_Fields\Field;
use Carbon_Fields\Block;

function crb_load() {
    \Carbon_Fields\Carbon_Fields::boot();
}
add_action( 'after_setup_theme', 'crb_load' );


function crb_get_gmaps_api_key( $current_key ) {
    return 'AIzaSyA0HoTAdhItKayUeV3yP_SFVzHKCrE1d9E';
}
add_filter( 'carbon_fields_map_field_api_key', 'crb_get_gmaps_api_key' );


function crb_attach_theme_options() {
    
    Container::make( 'post_meta', 'main_content', __( 'Блоки', THEME_LANG ) )
        // ->show_on_post_type( array( 'personal' ) )
        ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->add_fields( [
            // Мы работаем
            Field::make( 'separator', 'work_header', __( 'Мы работаем', THEME_LANG ) ),
            Field::make( 'text', 'work_title', __( 'Заголовок', THEME_LANG ) ),
            Field::make( 'textarea', 'work_text', __( 'Описание', THEME_LANG ) )
                ->set_width(100),
            Field::make( 'image', 'work_image', __( 'Изображение', THEME_LANG ) )
                ->set_width(100),

            // Основные проекты
            Field::make( 'separator', 'project_header', __( 'Основные проекты', THEME_LANG ) ),
            Field::make( 'text', 'project_title', __( 'Заголовок', THEME_LANG ) ),
            Field::make( 'textarea', 'project_text', __( 'Описание', THEME_LANG ) )
                ->set_width(100),
            Field::make( 'complex', 'project_items', __( 'Направления', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Заголовок', THEME_LANG ) ),
                    Field::make( 'image', 'icon', __( 'Иконка', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                ->set_header_template('<%- title %>')
                ->set_width(100),

            // Мы работаем
            Field::make( 'separator', 'idea_header', __( 'Идеи', THEME_LANG ) ),
            Field::make( 'text', 'idea_title', __( 'Заголовок', THEME_LANG ) ),
            Field::make( 'textarea', 'idea_text', __( 'Описание', THEME_LANG ) )
                ->set_width(100),
            Field::make( 'image', 'idea_image', __( 'Изображение', THEME_LANG ) )
                ->set_width(100),

            Field::make( 'separator', 'banners_header', __( 'Банеры', THEME_LANG ) ),
            Field::make( 'complex', 'main_banners1', __( 'Банеры 1', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                    Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                // ->set_header_template('<%- title %>')
                ->set_width(100),
            Field::make( 'complex', 'main_banners2', __( 'Банеры 2', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                    Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                // ->set_header_template('<%- title %>')
                ->set_width(100),
        ] );
        

    Container::make( 'post_meta', 'main_content', __( 'Блоки', THEME_LANG ) )
        ->show_on_template( 'page-contacts.php' )
        // ->where( 'post_id', '=', get_option( 'page_on_front' ) )
        ->add_fields( [
            // Мы работаем

            Field::make( 'text', 'address_text', __( 'Адрес', THEME_LANG ) )
                ->set_width(80),

            Field::make( 'text', 'phone_text', __( 'Телефон', THEME_LANG ) )
                ->set_width(80),

            Field::make( 'text', 'email_text', __( 'Email', THEME_LANG ) )
                ->set_width(80),

            Field::make( 'map', 'crb_company_location', __( 'Местоположения', THEME_LANG ) )
                ->set_help_text( 'Перетащите балун, чтобы выбрать местоположение' ),

            Field::make( 'complex', 'contacts_banners', __( 'Банеры', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                    Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                // ->set_header_template('<%- title %>')
                ->set_width(100),

        ] );


    Container::make( 'user_meta', 'Дополнительные данные' )
        ->add_fields( array(
            Field::make( 'text', 'specialty', __( 'Специальность', THEME_LANG ) )
                ->set_default_value(''),
            Field::make( 'text', 'company', __( 'Компания', THEME_LANG ) )
                ->set_default_value(''),
        ) );


    Container::make( 'term_meta', __( 'Category Properties' ) )
        ->where( 'term_taxonomy', '=', 'rubrics' )
        ->add_fields( array(
            Field::make( 'image', 'rubric_icon', __( 'Иконка', THEME_LANG ) ),
        ) );


    Container::make( 'theme_options', 'catalogue_options', __( 'Дополнения каталога', THEME_LANG ) )
        ->add_fields( [ 
            Field::make( 'separator', 'catalogue_header_ideas', __( 'Галавная Идей', THEME_LANG ) ),
            Field::make( 'text', 'catalogue_ideas_title', __( 'Заголовок', THEME_LANG ) ),
            Field::make( 'image', 'catalogue_ideas_image', __( 'Изображение', THEME_LANG ) )
                ->set_width(25),
            Field::make( 'rich_text', 'catalogue_ideas_content', __( 'Текст', THEME_LANG ) )
                ->set_width(75),
            Field::make( 'complex', 'catalogue_ideas_banners', __( 'Банеры', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                    Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                // ->set_header_template('<%- title %>')
                ->set_width(100),


            Field::make( 'separator', 'catalogue_header_projects', __( 'Галавная Проектов', THEME_LANG ) ),
            Field::make( 'text', 'catalogue_projects_title', __( 'Заголовок', THEME_LANG ) ),
            Field::make( 'image', 'catalogue_projects_image', __( 'Изображение', THEME_LANG ) )
                ->set_width(25),
            Field::make( 'rich_text', 'catalogue_projects_content', __( 'Текст', THEME_LANG ) )
                ->set_width(75),
            Field::make( 'complex', 'catalogue_projects_banners', __( 'Банеры', THEME_LANG ) )
                ->add_fields( [
                    Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                    Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                    // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                ] )
                ->set_layout( 'tabbed-vertical' )
                // ->set_header_template('<%- title %>')
                ->set_width(100),


            Field::make( 'separator', 'cataloguegi_header_ideas', __( 'Галавная Каталога GI', THEME_LANG ) ),
                Field::make( 'complex', 'cataloguegi_ideas_banners1', __( 'Банеры 1', THEME_LANG ) )
                    ->add_fields( [
                        Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                        Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                        // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                    ] )
                    ->set_layout( 'tabbed-vertical' )
                    // ->set_header_template('<%- title %>')
                    ->set_width(100),
                Field::make( 'complex', 'cataloguegi_ideas_banners2', __( 'Банеры 2', THEME_LANG ) )
                    ->add_fields( [
                        Field::make( 'text', 'title', __( 'Адрес ссылки', THEME_LANG ) ),
                        Field::make( 'image', 'image', __( 'Изображение', THEME_LANG ) ),
                        // Field::make( 'text', 'url', __( 'Заголовок', THEME_LANG ) ),
                    ] )
                    ->set_layout( 'tabbed-vertical' )
                    // ->set_header_template('<%- title %>')
                    ->set_width(100)
    
        ] )
        ->set_page_menu_position(3);

}
add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );