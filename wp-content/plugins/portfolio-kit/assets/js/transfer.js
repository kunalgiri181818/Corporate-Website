jQuery( document ).ready(function($) {

    $('.pk-transfer-post-type').on('click', function(e){
        e.preventDefault();
        const _this = $(this);
        const act = _this.attr('data-action');
        $.ajax( {
            type: 'POST',
            url: ajax_pk.ajaxurl,
            data: {
                action: 'pk_post_transfer_action',
                act: act
            },
            beforeSend: function() {
                if(act != 'scratch'){
                    _this.find('span').addClass('loading');
                }
            },
            success: function(data){
                if(act == 'transfer_backward'){
                    _this.find('span').removeClass('loading');
                    _this.before('<p class="pk-saved-data">Data saved!</p>');

                    setTimeout(function(){
                        _this.parent().find('.pk-saved-data').fadeOut('slow');
                    }, 2000);
                } else {
                    window.location.replace(data.data.url);
                }
            }
        });
    });

});