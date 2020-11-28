'use strict';

/**
 * Подключение JS файлов которые начинаются с подчеркивания
 */
/**
 * Возвращает функцию, которая не будет срабатывать, пока продолжает вызываться.
 * Она сработает только один раз через N миллисекунд после последнего вызова.
 * Если ей передан аргумент `immediate`, то она будет вызвана один раз сразу после
 * первого запуска.
 */
function debounce(func, wait, immediate) {

    var timeout = null,
        context = null,
        args = null,
        later = null,
        callNow = null;

    return function () {

        context = this;
        args = arguments;

        later = function later() {

            timeout = null;
            if (!immediate) {
                func.apply(context, args);
            }
        };
        callNow = immediate && !timeout;

        clearTimeout(timeout);
        timeout = setTimeout(later, wait);

        if (callNow) {
            func.apply(context, args);
        }
    };
}

// http://paulirish.com/2011/requestanimationframe-for-smart-animating/
// http://my.opera.com/emoller/blog/2011/12/20/requestanimationframe-for-smart-er-animating
// requestAnimationFrame polyfill by Erik Möller. fixes from Paul Irish and Tino Zijdel
// MIT license

;(function () {
    var lastTime = 0,
        vendors = ['ms', 'moz', 'webkit', 'o'],
        x = void 0,
        currTime = void 0,
        timeToCall = void 0,
        id = void 0;

    for (x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame) {

        window.requestAnimationFrame = function (callback) {

            currTime = new Date().getTime();
            timeToCall = Math.max(0, 16 - (currTime - lastTime));
            id = window.setTimeout(function () {
                callback(currTime + timeToCall);
            }, timeToCall);

            lastTime = currTime + timeToCall;

            return id;
        };
    }

    if (!window.cancelAnimationFrame) {

        window.cancelAnimationFrame = function (id) {
            clearTimeout(id);
        };
    }
})();
;(function () {

    // Test via a getter in the options object to see if the passive property is accessed

    var supportsPassiveOpts = null;

    try {
        supportsPassiveOpts = Object.defineProperty({}, 'passive', {
            get: function get() {
                window.supportsPassive = true;
            }
        });
        window.addEventListener('est', null, supportsPassiveOpts);
    } catch (e) {}

    // Use our detect's results. passive applied if supported, capture will be false either way.
    //elem.addEventListener('touchstart', fn, supportsPassive ? { passive: true } : false);
})();
function getSVGIconHTML(name, tag, attrs) {

    if (typeof name === 'undefined') {
        console.error('name is required');
        return false;
    }

    if (typeof tag === 'undefined') {
        tag = 'div';
    }

    var classes = 'svg-icon svg-icon--<%= name %>';

    var iconHTML = ['<<%= tag %> <%= classes %>>', '<svg class="svg-icon__link">', '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#<%= name %>"></use>', '</svg>', '</<%= tag %>>'].join('').replace(/<%= classes %>/g, 'class="' + classes + '"').replace(/<%= tag %>/g, tag).replace(/<%= name %>/g, name);

    return iconHTML;
}

/* ^^^
 * JQUERY Actions
 * ========================================================================== */
$(function () {

    'use strict';

    /**
     * определение существования элемента на странице
     */

    $.exists = function (selector) {
        return $(selector).length > 0;
    };

    /**
     * [^_]*.js - выборка всех файлов, которые не начинаются с подчеркивания
     */
    $(".app-header__hasChild").hover(function () {
        $(this).children().toggleClass("hovertop");
        // $("app-header__hasChild a").addClass("afe");
    });
    $('.b-cabinet-info__modify').each(function () {
        var $this = $(this),
            userDate = $this.find('.b-cabinet-info__user-date'),
            editBtn = $this.find('.b-cabinet-info__editBtn');

        editBtn.on('click', function () {
            userDate.removeAttr('disabled').select();
        });
    });

    $('.b-cabinet-info__edit span');

    // var map;
    //     function initMap() {
    //       map = new google.maps.Map(document.querySelector('#map'), {
    //         center: {lat: -34.397, lng: 150.644},
    //         zoom: 8,
    //         disableDefaultUI: true,
    //       });

    //       initZoomControl(map);
    //       initMapTypeControl(map);
    //       initFullscreenControl(map);
    //     }

    //     function initZoomControl(map) {
    //       document.querySelector('.zoom-control-in').onclick = function() {
    //         map.setZoom(map.getZoom() + 1);
    //       };
    //       document.querySelector('.zoom-control-out').onclick = function() {
    //         map.setZoom(map.getZoom() - 1);
    //       };
    //       map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(
    //           document.querySelector('.zoom-control'));
    //     }

    //     function initMapTypeControl(map) {
    //       var mapTypeControlDiv = document.querySelector('.maptype-control');
    //       document.querySelector('.maptype-control-map').onclick = function() {
    //         mapTypeControlDiv.classList.add('maptype-control-is-map');
    //         mapTypeControlDiv.classList.remove('maptype-control-is-satellite');
    //         map.setMapTypeId('roadmap');
    //       };
    //       document.querySelector('.maptype-control-satellite').onclick =
    //           function() {
    //         mapTypeControlDiv.classList.remove('maptype-control-is-map');
    //         mapTypeControlDiv.classList.add('maptype-control-is-satellite');
    //         map.setMapTypeId('hybrid');
    //       };

    //       map.controls[google.maps.ControlPosition.LEFT_TOP].push(
    //           mapTypeControlDiv);
    //     }

    //     function initFullscreenControl(map) {
    //       var elementToSendFullscreen = map.getDiv().firstChild;
    //       var fullscreenControl = document.querySelector('.fullscreen-control');
    //       map.controls[google.maps.ControlPosition.RIGHT_TOP].push(
    //           fullscreenControl);


    //       fullscreenControl.onclick = function() {
    //         if (isFullscreen(elementToSendFullscreen)) {
    //           exitFullscreen();
    //         } else {
    //           requestFullscreen(elementToSendFullscreen);
    //         }
    //       };

    //       document.onwebkitfullscreenchange =
    //       document.onmsfullscreenchange =
    //       document.onmozfullscreenchange =
    //       document.onfullscreenchange = function() {
    //         if (isFullscreen(elementToSendFullscreen)) {
    //           fullscreenControl.classList.add('is-fullscreen');
    //         } else {
    //           fullscreenControl.classList.remove('is-fullscreen');
    //         }
    //       };
    //     }

    //     function isFullscreen(element) {
    //       return (document.fullscreenElement ||
    //               document.webkitFullscreenElement ||
    //               document.mozFullScreenElement ||
    //               document.msFullscreenElement) == element;
    //     }
    //     function requestFullscreen(element) {
    //       if (element.requestFullscreen) {
    //         element.requestFullscreen();
    //       } else if (element.webkitRequestFullScreen) {
    //         element.webkitRequestFullScreen();
    //       } else if (element.mozRequestFullScreen) {
    //         element.mozRequestFullScreen();
    //       } else if (element.msRequestFullScreen) {
    //         element.msRequestFullScreen();
    //       }
    //     }
    //     function exitFullscreen() {
    //       if (document.exitFullscreen) {
    //         document.exitFullscreen();
    //       } else if (document.webkitExitFullscreen) {
    //         document.webkitExitFullscreen();
    //       } else if (document.mozCancelFullScreen) {
    //         document.mozCancelFullScreen();
    //       } else if (document.msCancelFullScreen) {
    //         document.msCancelFullScreen();
    //       }
    //     }
    $.uploadPreview({
        input_field: "#image-upload",
        preview_box: "#image-preview",
        label_field: "#image-label",
        label_default: "Choose File",
        label_selected: "Change File",
        no_label: false,
        success_callback: null
    });

    $.uploadPreview({
        input_field: "#image-upload-2",
        preview_box: "#image-preview-2",
        label_field: "#image-label-2",
        label_default: "Choose File",
        label_selected: "Change File",
        no_label: false,
        success_callback: null
    });

    $('input[name=image]').change(function (ev) {
        $('.download-pic__image-preview').addClass('show-preview');
    });
    // Test via a getter in the options object to see if the passive property is accessed
    var supportsPassive = false;

    try {
        var opts = Object.defineProperty({}, 'passive', {
            get: function get() {
                supportsPassive = true;
            }
        });
        window.addEventListener("test", null, opts);
    } catch (e) {}
    // Use our detect's results. passive applied if supported, capture will be false either way.
    // elem.addEventListener('touchstart', fn, supportsPassive ? { passive: true } : false);

    // http://www.paulirish.com/2011/requestanimationframe-for-smart-animating/
    window.requestAnimFrame = function () {
        return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function (callback) {
            window.setTimeout(callback, 1000 / 60);
        };
    }();
    /**
     * Simple menu
     * @version 1.0.0-beta.1
     */
    ;(function ($) {

        $.fn.simpleMenu = function (options) {

            var settings = $.extend(true, {
                timing: 300,
                topMargin: 0,
                menu: {
                    list: 'ul',
                    item: 'li',
                    trigger: 'a'
                },
                classes: {
                    opened: 'opened',
                    active: 'active',
                    used: 'used'
                },
                attrs: {
                    opened: {
                        key: 'opened',
                        true: 'true',
                        false: 'false'
                    }
                }
            }, options);

            var $this = this;
            var $trigers = $this.find(settings.menu.list).parent(settings.menu.item).find('> ' + settings.menu.trigger);

            $trigers.on('click', function (event) {

                event.preventDefault();

                var $list = $(this).parent(settings.menu.item).find('> ' + settings.menu.list);

                $list.css({
                    display: 'block'
                });

                if ($list.parent(settings.menu.item).hasClass(settings.classes.opened)) {

                    $list.stop().animate({
                        marginTop: -($list.outerHeight(true) - settings.topMargin)
                    }, settings.timing, function () {
                        $list.attr(settings.attrs.opened.key, settings.attrs.opened.false).addClass(settings.classes.used).parent(settings.menu.item).removeClass(settings.classes.opened);
                    });
                } else {

                    if (!$list.hasClass(settings.classes.used)) {
                        $list.css({
                            marginTop: -($list.outerHeight(true) - settings.topMargin)
                        }).addClass(settings.classes.used);
                    }

                    $list.parent(settings.menu.item).addClass('opening').end().stop().animate({
                        marginTop: 0 + settings.topMargin
                    }, settings.timing, function () {
                        $list.attr(settings.attrs.opened.key, settings.attrs.opened.true).parent(settings.menu.item).removeClass('opening').end().addClass(settings.classes.used).parent(settings.menu.item).addClass(settings.classes.opened);
                    });
                }
            });
        };
    })(jQuery);
    (function () {

        $.preventScrolling = function (selector, options) {

            // запрещаем прокрутку страницы при прокрутке элемента
            var defaults = {

                classes: {
                    scrolled: 'is-scrolled',
                    onTop: 'is-onTop',
                    onBottom: 'is-onBottom'
                },
                onTop: function onTop() {},
                onBottom: function onBottom() {}
            };

            var options = $.extend({}, defaults, options);

            var scroller = $(selector);

            scroller.on('scroll', function () {

                if (scroller.scrollTop() == 0) {
                    scroller.addClass(options.classes.onTop).removeClass(options.classes.onBottom);
                }

                if (scroller.scrollTop() == scroller[0].scrollHeight - scroller.height()) {
                    scroller.removeClass(options.classes.onTop).addClass(options.classes.onBottom);
                }
            });

            if (scroller[0].scrollHeight > scroller.height()) {
                scroller.addClass('with-scroll');
            } else {
                scroller.removeClass('with-scroll');
            }

            $(window).on('resize', function () {

                if (scroller[0].scrollHeight > scroller.height()) {
                    scroller.addClass('with-scroll');
                } else {
                    scroller.removeClass('with-scroll');
                }
            });

            scroller.off('mousewheel DOMMouseScroll').on('mousewheel DOMMouseScroll', function (e) {

                var scrollTo = null;

                if (e.type == 'mousewheel') {
                    scrollTo = e.originalEvent.wheelDelta * -1;
                } else if (e.type == 'DOMMouseScroll') {
                    scrollTo = 40 * e.originalEvent.detail;
                }

                if (scrollTo && scroller[0].scrollHeight > scroller.height()) {
                    e.stopPropagation();
                    e.preventDefault();
                    $(this).scrollTop(scrollTo + $(this).scrollTop());
                }
            });
        };
    })();

    var mobileHeader = $('.mobile-header');

    // внутренние классы
    var mobile_classes = {
        opened: 'is-opened',
        closed: 'is-closed'
    };

    var target_toolbar_buttons = $('.me-schedule-trigger, .me-share-trigger, .me-search-trigger, .me-feedback-trigger');

    // выпадалки
    var toolbar_button_dropdowns = $('.toolbar-button-dropdown');

    /**
     * закрываем все выпадалки
     */
    function close_toolbar_button_dropdowns() {
        toolbar_button_dropdowns.removeClass(mobile_classes.opened);
        target_toolbar_buttons.removeClass(mobile_classes.opened);
    }

    /**
     * предотвращаем всплытие кликов на документе от .toolbar-button-dropdown
     */
    toolbar_button_dropdowns.on('click', function (event) {
        event.stopPropagation();
    });

    /**
     * кнопки у которых есть выпадалки
     */
    target_toolbar_buttons.on('click', function (event) {

        event.stopPropagation();
        event.preventDefault();

        var $self = $(this);

        if ($self.hasClass(mobile_classes.opened)) {

            $self.removeClass(mobile_classes.opened);
            close_toolbar_button_dropdowns();
        } else {

            close_toolbar_button_dropdowns();

            if ($self.hasClass('me-search-trigger')) {
                $('.mobile-search-form__input').focus();
            }

            $self.addClass(mobile_classes.opened);
        }
    });

    /**
     * нажатие на ESC
     */
    $(document).on('keydown', function (event) {

        if (event.keyCode === 27) {
            close_toolbar_button_dropdowns();
        }
    });

    /*!
     * клик по документу
     */
    $(document).on('click', function (event) {

        close_toolbar_button_dropdowns();
    });

    /*!
     * Remodal actions
     */

    // расширенный поиск


    /**
     * Таблицы со скроллом
     */
    $('.scroll-table, .shop2-table-order:not(.shop2-table-order--summary)').wrap("<div class='scroll-table_enabled'/>");

    /**
     * Мобильное меню сайта
     */
    var asideMenuBtn = $('.b-aside-menu-btn');
    var asideMenu = $('.b-aside-menu');
    var asideHead = $('.b-aside-menu__head');
    var asideMenuContent = $('.b-aside-menu__content');
    var asideMenuScroller = $('.b-aside-menu__scroller-content');
    var asideMenuFoot = $('.b-aside-menu__foot');

    function openAsideMenu() {
        asideMenu.addClass('js-animate js-opening');
    }

    function closeAsideMenu() {

        asideMenu.removeClass('js-animate');

        setTimeout(function () {
            asideMenu.removeClass('js-opening');
        }, 150);
    }

    var pxScroller = document.querySelector('.b-aside-menu__scroller');

    function pxAsideHead(event) {
        asideHead.css({
            transform: 'translateY(' + event.target.scrollTop / 1.8 + 'px)'
        });
    }

    pxScroller.addEventListener('scroll', pxAsideHead, supportsPassive ? { passive: true } : false);

    asideMenuBtn.on('pointerup click', function (event) {
        event.preventDefault();
        event.stopPropagation();
        openAsideMenu();
    });

    $('.b-aside-menu__close').on('pointerup click', function (event) {
        event.preventDefault();
        closeAsideMenu();
    });

    $('.b-aside-menu__overlay').on('pointerup', function (event) {
        event.preventDefault();
        closeAsideMenu();
    });

    /**
     * запрещаем прокрутку страницы при прокрутке бокового-мобильного
     */
    $.preventScrolling($('.b-aside-menu__scroller'));

    /**
     * Клонирование верхнего-левого меню в боковое-мобильное
     */
    if ($.exists('.app-header__menu')) {

        var newAsideNav = $('.app-header__menu').clone();

        newAsideNav.removeClass('app-header__menu').addClass('aside-nav-list aside-nav-list_bottom-line__top-menu').appendTo(asideMenuScroller);
    }
    if ($.exists('.app-leftbar')) {

        var newLeftBar = $('.app-leftbar').clone();

        newLeftBar.removeClass('app-leftbar').addClass('aside-nav-list aside-nav-list_app-leftbar').appendTo(asideMenuScroller);
    }

    $.each(asideMenuScroller.find('li'), function (index, element) {

        if ($(element).find('ul').length) {

            var triggerIcon = ['<div class="svg-icon svg-icon--angle-down">', '<svg class="svg-icon__link" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">', '<path d="M7 10l5 5 5-5z"/> <path d="M0 0h24v24H0z" fill="none"/>', '</svg>', '</div>'].join('');

            var subMenuTrigger = $('<div class="sub-menu-trigger">' + triggerIcon + '</div>');

            $(element).addClass('is-has-child').append(subMenuTrigger);
        }
    });
    if ($.exists('.b-aside-menu')) {
        /*$('.sub-menu-trigger').on('click', function(){
            $(this).parent().toggleClass('active');
            $(this).toggleClass('active');
        });*/
        $('.aside-nav-list').simpleMenu({
            timing: 500,
            menu: {
                trigger: '.sub-menu-trigger'
            }
        });
    }
    ;$(function () {
        /**
         * Прокрутка страницы вверх
         */
        // main function
        function scrollToY(scrollTargetY, speed, easing) {
            // scrollTargetY: the target scrollY property of the window
            // speed: time in pixels per second
            // easing: easing equation to use

            var scrollY = window.scrollY || document.documentElement.scrollTop,
                scrollTargetY = scrollTargetY || 0,
                speed = speed || 2000,
                easing = easing || 'easeOutSine',
                currentTime = 0;

            // min time .1, max time .8 seconds
            var time = Math.max(.1, Math.min(Math.abs(scrollY - scrollTargetY) / speed, .8));

            // easing equations from https://github.com/danro/easing-js/blob/master/easing.js
            var easingEquations = {
                easeOutSine: function easeOutSine(pos) {
                    return Math.sin(pos * (Math.PI / 2));
                },
                easeInOutSine: function easeInOutSine(pos) {
                    return -0.5 * (Math.cos(Math.PI * pos) - 1);
                },
                easeInOutQuint: function easeInOutQuint(pos) {
                    if ((pos /= 0.5) < 1) {
                        return 0.5 * Math.pow(pos, 5);
                    }
                    return 0.5 * (Math.pow(pos - 2, 5) + 2);
                }
            };
            // add animation loop
            function tick() {
                currentTime += 1 / 60;

                var p = currentTime / time;
                var t = easingEquations[easing](p);

                if (p < 1) {
                    requestAnimFrame(tick);

                    window.scrollTo(0, scrollY + (scrollTargetY - scrollY) * t);
                } else {
                    //console.log('scroll done');
                    window.scrollTo(0, scrollTargetY);
                }
            }

            // call it once to get started
            tick();
        }

        /** ===========================================================================
         * Mobile scripts
         * ============================================================================ */
        /**
         * определение существования элемента на странице
         */
    });

    ;(function ($) {

        'use strict';

        var PAGE = $('html, body');
        var pageScroller = $('.page-scroller'),
            pageYOffset = 0,
            inMemory = false,
            inMemoryClass = 'page-scroller--memorized',
            isVisibleClass = 'page-scroller--visible',
            enabledOffset = 60;

        function resetPageScroller() {

            setTimeout(function () {

                if (window.pageYOffset > enabledOffset) {
                    pageScroller.addClass(isVisibleClass);
                } else if (!pageScroller.hasClass(inMemoryClass)) {
                    pageScroller.removeClass(isVisibleClass);
                }
            }, 150);

            if (!inMemory) {

                pageYOffset = 0;
                pageScroller.removeClass(inMemoryClass);
            }

            inMemory = false;
        }

        if (pageScroller.length > 0) {

            window.addEventListener('scroll', resetPageScroller, window.supportsPassive ? { passive: true } : false);

            pageScroller.on('click', function (event) {

                event.preventDefault();

                window.removeEventListener('scroll', resetPageScroller);

                if (window.pageYOffset > 0 && pageYOffset === 0) {

                    inMemory = true;
                    pageYOffset = window.pageYOffset;

                    pageScroller.addClass(inMemoryClass);

                    PAGE.stop().animate({ scrollTop: 0 }, 500, 'swing', function () {
                        window.addEventListener('scroll', resetPageScroller, window.supportsPassive ? { passive: true } : false);
                    });
                } else {

                    pageScroller.removeClass(inMemoryClass);

                    PAGE.stop().animate({ scrollTop: pageYOffset }, 500, 'swing', function () {

                        pageYOffset = 0;
                        window.addEventListener('scroll', resetPageScroller, window.supportsPassive ? { passive: true } : false);
                    });
                }
            });
        }
    })(jQuery);

    $('input[type="checkbox"], select, .attach-docs__file-set').not('.image-preview').styler({
        filePlaceholder: 'Присоедините текстовый документ с описанием',
        fileBrowse: ''
    });

});