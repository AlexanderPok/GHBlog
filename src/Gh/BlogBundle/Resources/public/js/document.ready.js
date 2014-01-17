$(document).ready(function(){
    $.fn.tagcloud.defaults = {
        size: {start: 12, end: 20, unit: 'px'},
        color: {start: '#ccc', end: '#000'}
    };

    $(function () {
        $('#tag-cloud a').tagcloud();
    });
});