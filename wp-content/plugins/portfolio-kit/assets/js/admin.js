jQuery( document ).ready(function($) {
    $('.pk-meta-wp-editor textarea').each(function(){
        var fId = $(this).attr('id');
        var interval = setInterval(function () {
            if ( $('#' + fId).is(':visible') ) {
                window.wp.editor.initialize(fId, {
                    tinymce: {
                        wpautop: true,
                        formats  : {
                            alignleft  : [
                                { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: { textAlign: 'left' } },
                                { selector: 'img,table,dl.wp-caption', classes: 'alignleft' }
                            ],
                            aligncenter: [
                                { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: { textAlign: 'center' } },
                                { selector: 'img,table,dl.wp-caption', classes: 'aligncenter' }
                            ],
                            alignright : [
                                { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li', styles: { textAlign: 'right' } },
                                { selector: 'img,table,dl.wp-caption', classes: 'alignright' }
                            ],
                            strikethrough: { inline: 'del' }
                        },
                        relative_urls       : false,
                        remove_script_host  : false,
                        convert_urls        : false,
                        browser_spellcheck  : true,
                        fix_list_elements   : true,
                        entities            : '38,amp,60,lt,62,gt',
                        entity_encoding     : 'raw',
                        keep_styles         : false,
                        paste_webkit_styles : 'font-weight font-style color',
                        preview_styles      : 'font-family font-size font-weight font-style text-decoration text-transform',
                        tabfocus_elements   : ':prev,:next',
                        plugins    : 'charmap,hr,media,paste,tabfocus,textcolor,fullscreen,wordpress,wpeditimage,wpgallery,wplink,wpdialogs,wpview',
                        resize     : 'vertical',
                        menubar    : false,
                        indent     : false,
                        toolbar1   : 'bold,italic,strikethrough,bullist,numlist,blockquote,hr,alignleft,aligncenter,alignright,link,unlink,wp_more,spellchecker,fullscreen,wp_adv',
                        toolbar2   : 'formatselect,underline,alignjustify,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
                        toolbar3   : '',
                        toolbar4   : '',
                        body_class : 'id post-type-post post-status-publish post-format-standard',
                        wpeditimage_disable_captions: false,
                        wpeditimage_html5_captions  : true
                    },
                    quicktags: true,
                    mediaButtons: true
                });
                clearInterval(interval);
            }
        });
    });

    $('input.pk-meta-color-field').wpColorPicker();

    $('.pk-select2 select').select2();
    
    $('.pk-meta-option select, .pk-meta-option input[type="radio"], .pk-meta-option input[type="checkbox"]').on('change', function(){
        var _this = $(this);
        var v = $(this).val();
        var n = $(this).attr('name');
        $('.pk-meta-option[data-pkcond]').each(function(){
            var cond = $(this).attr('data-pkcond');
            var cond_arr = cond.split(";");
            for (i = 0; i < cond_arr.length; ++i) {
                var arrEl = cond_arr[i];
                var valV = arrEl.split("|")[1];
                var valName = arrEl.split("|")[0];
                if( n == valName && _this.attr('type') != 'checkbox' ){
                    $(this).addClass('pk-option-hide');
                    if( v == valV ){
                        $(this).removeClass('pk-option-hide');
                    }
                } else if( n == valName && _this.attr('type') == 'checkbox' ){
                    $(this).addClass('pk-option-hide');
                    if( _this.is(':checked') ){
                        $(this).removeClass('pk-option-hide');
                    }
                }
            }
        });
    });

    $('.pk-meta-option .pk-video-select').on('click', function(e){
        e.preventDefault();

        var $field = jQuery(this).parent().find('.pk-video-link-field');
        var $remove = jQuery(this).parent().find('.pk-video-remove');

        if ( meta_file_frame ) {
            meta_file_frame.open();
            return;
        }

        // Sets up the media library frame
        var meta_file_frame = wp.media.frames.meta_gallery_frame = wp.media({
            title: 'Select file',
            button: {
                text: 'Select'
            },
            library: { type: 'video' },
            multiple: false
        });

        meta_file_frame.on('select', function() {
            var files = meta_file_frame.state().get('selection');
            files.each(function(file_el) {
                $field.val(file_el.attributes.url);
            });
            if( files.length != 0 ){
                $remove.addClass('active');
            }
        });

        meta_file_frame.open();
    });

    $('.pk-meta-option .pk-video-remove').on('click', function(e){
        e.preventDefault();

        $(this).removeClass('active');
        jQuery(this).parent().find('.pk-video-link-field').val('');
    });

    $('.pk-meta-option .pk-select-gallery').on('click', function(e){
        e.preventDefault();

        var $field = jQuery(this).parent().find('.pk-meta-gallery-field');
        var $field_set = jQuery(this).parent().find('.pk-meta-gallery-images-cont');

        if ( meta_gallery_frame ) {
            meta_gallery_frame.open();
            return;
        }

        // Sets up the media library frame
        var meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
            library: { type: 'image' },
            multiple: true
        });

        meta_gallery_frame.states.add([
            new wp.media.controller.Library({
                title:      'Select Images for Gallery',
                priority:   20,
                toolbar:    'main-gallery',
                filterable: 'uploaded',
                library:    wp.media.query( meta_gallery_frame.options.library ),
                multiple:   meta_gallery_frame.options.multiple ? 'reset' : false,
                editable:   true,
                allowLocalEdits: true,
                displaySettings: true,
                displayUserSettings: true
             }),
        ]);

        meta_gallery_frame.on('open', function() {
            var selection = meta_gallery_frame.state().get('selection');
            var library = meta_gallery_frame.state('gallery-edit').get('library');
            var ids = $field.val();
            if (ids) {
                idsArray = ids.split(',');
                idsArray.forEach(function(id) {
                    attachment = wp.media.attachment(id);
                    attachment.fetch();
                    selection.add( attachment ? [ attachment ] : [] );
                });
            }
        });

        meta_gallery_frame.on('ready', function() {
            jQuery( '.media-modal' ).addClass( 'no-sidebar' );
        });

        meta_gallery_frame.on('select', function() {
            var imageIDArray = [];
            var imageHTML = '';
            var metadataString = '';
            images = meta_gallery_frame.state().get('selection');
            imageHTML += '<div class="pk-meta-gallery-images">';
            images.each(function(attachment) {
                imageIDArray.push(attachment.attributes.id);
                var img_url = ( attachment.attributes.sizes.thumbnail !== undefined ) ? attachment.attributes.sizes.thumbnail.url : attachment.attributes.url;
                imageHTML += '<div class="pk-meta-gallery-image"><img data-im="'+attachment.attributes.id+'" src="'+img_url+'"><span class="pk-remove-img">+</span></div>';
            });
            imageHTML += '</div>';
            metadataString = imageIDArray.join(",");
            if (metadataString) {
                $field.val(metadataString);
                $field_set.html(imageHTML);
            }
        });

        meta_gallery_frame.open();
    });

    $('.pk-meta-option .pk-meta-gallery-images-cont').on('click', '.pk-remove-img', function(e){
        e.preventDefault();
        var removedImage = $(this).parent().find('img').attr('data-im');
        var oldGallery = $(this).closest('.pk-meta-option').find('input').val();
        var newGallery = oldGallery.replace(','+removedImage,'').replace(removedImage+',','').replace(removedImage,'');
        $(this).closest('.pk-meta-option').find('input').val(newGallery);
        $(this).parent().remove();
    });

    // Image select
    $('.pk-meta-option .pk-select-image').on('click', function(e){
        e.preventDefault();

        var $par = jQuery(this).parent();
        var $field = jQuery(this).parent().find('.pk-meta-image-field');

        if ( meta_gallery_frame ) {
            meta_gallery_frame.open();
            return;
        }

        // Sets up the media library frame
        var meta_gallery_frame = wp.media.frames.meta_gallery_frame = wp.media({
            library: { type: 'image' },
            multiple: false
        });

        meta_gallery_frame.on('select', function() {
            var imageHTML = '';
            var images = meta_gallery_frame.state().get('selection').first().toJSON();
            if (images.id) {
                $field.val(images.id);
                var img_url = ( images.sizes.thumbnail !== undefined ) ? images.sizes.thumbnail.url : images.url;
                imageHTML += '<div class="pk-meta-gallery-images"><div class="pk-meta-gallery-image"><img src="'+img_url+'" /><span class="pk-remove-img">+</span></div></div>';
                $par.find('.pk-meta-gallery-images').remove();
                $par.prepend(imageHTML);
            }
        });

        meta_gallery_frame.open();
    });

    $('.pk-meta-option-image-select').on('click', '.pk-remove-img', function(e){
        e.preventDefault();

        $(this).closest('.pk-meta-option-fieldset').find('.pk-meta-image-field').val('');
        $(this).closest('.pk-meta-option-fieldset').find('.pk-meta-gallery-images').remove();
    });
});