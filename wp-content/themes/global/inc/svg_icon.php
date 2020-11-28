<?php

/**
 * Генератор HTML кода SVG-иконки используемой в SVG-спрайте
 */
function wepster_get_svg_icon( $args ) {

    $defaults = array(
        'tag'        => 'span',
        'block'      => 'svg-icon',
        'elem'       => 'link',
        'name'       => 'name key is required',
        'spinner'    => false,
        'dlmtr_elem' => '__',
        'dlmtr_mod'  => '_',
        'echo'       => false
    );

    $args = (object) array_merge( $defaults, $args );

    $classes = $args->block . ' ' . $args->block . $args->dlmtr_mod . $args->name;

    $spinner_start = $args->spinner ? '<' . $args->tag . ' class="' . $args->block . $args->dlmtr_elem . 'spinner">' : '';
    $spinner_end   = $args->spinner ? '</' . $args->tag . '>' : '';

    $svg_icon = join( '', array(
        '<' . $args->tag . ' class="' . $classes . '">',
            $spinner_start,
            '<svg class="' . $args->block . $args->dlmtr_elem . $args->elem . '">',
                '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#' . $args->name . '"></use>',
            '</svg>',
            $spinner_end,
        '</' . $args->tag . '>'
    ) );

    if ( $args->echo ) {
        echo ( $svg_icon );
    } else {
        return $svg_icon;
    }
}
