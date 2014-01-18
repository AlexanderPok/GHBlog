$(document).ready(function(){
    $.fn.tagcloud.defaults = {
        size: {start: 12, end: 20, unit: 'px'},
        color: {start: '#ccc', end: '#000'}
    };

    $(function () {
        $('#tag-cloud a').tagcloud();
    });

    $("body").on( "click", ".showmore", function(){
        var me = this,
            url = $(this).attr('data-url');
        $.ajax({
            url: url
        }).done(function(data) {
            var $container = $(me).parents('.showmore-container');
            if (!$container.length) {
                $container = $(me);
            }
            $container.replaceWith(data);
        });
    });
});