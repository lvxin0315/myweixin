$(function(){
    setInterval(changeLogo,5000);
    function changeLogo(){
        $('#logo').addClass('my-logo-change');
        setTimeout("$('#logo').removeClass('my-logo-change')",1000)
    }
    $('.dimenu').click(function(){
        var obj = $(this);
        var url = obj.attr('data-url');
        if('undefined'== url.toString() || '' == url.toString()){
            return 0;
        }
        window.location.href = url;
    });
});
