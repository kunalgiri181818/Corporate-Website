jQuery(document).ready(function ($) {

    $('.pk-list-cont .pk-posts-loop-masonry').each(function () {
        const $portfolioGrid = $(this);

        $portfolioGrid.isotope({
            itemSelector: '.pk-post-cont',
        });
    });
    if ($('.pk-swiper-container').length) {
        const swiper = new Swiper('.pk-swiper-container', {
            parallax: true,
            breakpoints: false,
            keyboardControl: true,
            setWrapperSize: true,
            preloadImages: false,
            lazy: true,
            updateOnImagesReady: true,
            autoHeight: true,
            loop: true,
            effect: 'fade',
            direction: 'horizontal',
            autoplay: true,
            delay: 4000,
            mousewheel: false,
            pagination: {
                el: '.pk-swiper-pagination',
                type: 'bullets',
                clickable: true
            },
            coverflow: {
                stretch: 0,
                depth: 0,
                slideShadows: false,
                rotate: 0,
                modifier: 2
            },
            fade: {
                crossFade: true
            }
        });
    }
    $('.pk-list-cont').on('click', '.pk-filter-btn, .pk-pagination-ajax a', function (e) {
        e.preventDefault();
        const $el = $(this);
        let cat = $el.attr('data-cat');
        let page = 1;
        let nextUrl = '';
        let append = false;
        let $posts = $('.pk-list-cont .pk-posts-loop-masonry').find('.pk-post-cont');
        const $grid = $('.pk-list-cont .pk-posts-loop-masonry');

        const settings = $el.closest('.pk-list-cont').attr('data-settings');

        if (cat !== undefined) {
            $el.closest('.pk-list-nav').find('li').removeClass('active');
            $el.parent().addClass('active');
            nextUrl = $el.attr('href');
        } else {
            cat = $el.closest('.pk-list-cont').find('.pk-list-nav li.active a').attr('data-cat');
            const hr = $el.attr('href').split("?").pop();
            page = parseInt(PKGetUrlParameter('pkpage', hr));
            nextUrl = $el.attr('href');
        }

        $.ajax({
            url: pk_vars.ajax_url,
            dataType: 'json',
            type: 'POST',
            data: {
                action: 'pk_ajax_portfolio_get_posts',
                category: cat,
                page: page,
                settings: settings
            },
            beforeSend: function () {
                if (!append) {
                    if (!$el.hasClass('pk-load-more')) {
                        $grid.isotope('remove', $posts);
                    }
                }
            },
            success: function (response) {
                if (!response.success) {
                    alert(response.data.message);
                    return;
                }

                append = true;

                if (append) {
                    $posts = $(response.data.grid).filter('.pk-post-cont');

                    $posts.imagesLoaded(function () {
                        if (!$el.hasClass('pk-load-more')) {
                            $grid.isotope('insert', $posts);
                        } else {
                            $grid.append($posts).isotope('appended', $posts);
                        }
                    });

                    $el.closest('.pk-list-cont').find('.navigation-pages').html(response.data.nav);
                    // if(nextUrl != ''){
                    //     window.history.replaceState(null, null, nextUrl);
                    // } else {
                    //     window.history.replaceState(null, null, pk_vars.req + '/');
                    // }

                    if ($el.closest('.pk-list-cont').find('.pk-pagination-loadmore').length != 0) {
                        if (response.data.enable_ajax == '0') {
                            $el.closest('.pk-list-cont').find('.pk-pagination-loadmore').addClass('hidden');
                        } else {
                            $el.closest('.pk-list-cont').find('.pk-pagination-loadmore').removeClass('hidden');
                            const hrAjax = $el.closest('.pk-list-cont').find('.pk-load-more').attr('href').split("?").shift();
                            $el.closest('.pk-list-cont').find('.pk-load-more').attr('href', hrAjax + response.data.page_link_format);
                        }
                    }
                }
            },
            error: function (jqXHR, textStatus) {
                alert(textStatus);
            },
            complete: function () {
                append = false;
            }
        });
    });

    function PKGetUrlParameter(sParam, sPageURL) {
        var sURLVariables = sPageURL.split('&'),
            sParameterName,
            i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return typeof sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
        return false;
    };

    $('.pk-list-cont').on('click', '.pk-popup-image', function (e) {
        if ($(this).closest('.elementor-widget-container').length == 0) {
            e.preventDefault();
            $(this).closest('.pk-post-image-gallery').magnificPopup({
                delegate: 'a',
                type: 'image',
                closeOnContentClick: true,
                // zoom: {
                //     enabled: true,
                //     duration: 300
                // },
                gallery: {
                    enabled: true
                }
            }).magnificPopup('open');
        }
        return false;
    });

    // Likes
    $('.pk-single-cont .pk-like-wrap').on('click', function (e) {
        e.preventDefault();
        const postId = $(this).attr('data-post');
        const nonce = $(this).attr('data-nonce');
        $.ajax({
            url: pk_vars.ajax_url,
            dataType: 'json',
            type: 'POST',
            data: {
                action: 'process_pk_like',
                postId: postId,
                nonce: nonce,
            },
            success: function (response) {
                if (response.count !== undefined) {
                    $('.pk-single-cont .pk-like-wrap span').html(response.count);
                }
                if (response.status !== undefined) {
                    if (response.status == 'liked') {
                        $('.pk-single-cont .pk-like-wrap').addClass('liked');
                    }
                    if (response.status == 'unliked') {
                        $('.pk-single-cont .pk-like-wrap').removeClass('liked');
                    }
                }
            }
        });
    });
});