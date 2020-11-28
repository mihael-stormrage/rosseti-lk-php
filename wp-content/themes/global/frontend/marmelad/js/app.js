/**
 * Подключение JS файлов которые начинаются с подчеркивания
 */
//=require ../_blocks/**/_*.js


/* ^^^
 * JQUERY Actions
 * ========================================================================== */
$(function() {

    'use strict';

    /**
     * определение существования элемента на странице
     */
    $.exists = (selector) => $(selector).length > 0;

    /**
     * [^_]*.js - выборка всех файлов, которые не начинаются с подчеркивания
     */
    //=require ../_blocks/**/[^_]*.jquery.js

    $('input[type="checkbox"], select, .attach-docs__file-set').not('.image-preview').styler({
        filePlaceholder : 'Присоедините текстовый документ с описанием',
        fileBrowse : ''
    });
    
    
});
