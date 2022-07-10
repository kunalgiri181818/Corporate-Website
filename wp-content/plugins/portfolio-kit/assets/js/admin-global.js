jQuery( document ).ready(function($) {
    $('.pk-meta-option select, .pk-meta-option input[type="radio"], .pk-meta-option input[type="checkbox"]').on('change', function(){
        var _this = $(this);
        var v = $(this).val();
        var n = $(this).attr('name');
        console.log(n);
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
});