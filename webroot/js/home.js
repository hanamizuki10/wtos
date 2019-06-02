$(function(){

    function radiolabelupdate(){
        $('.warekiradio-input-wrapper').children('label').each(function(){
            $(this).eq(0).removeClass('checked-radio');
        });


        // 選択されたラジオボタンのValue値取得
        var gengouname = $('input[name=gengou]:checked').val();
        //alert(gengouname);
        // ラジオボタンを囲っているlabelタグの取得
        var labeltag = $( '#gengou-' + gengouname ).parent();

        labeltag.addClass('checked-radio');
    }
    // ページロード時実行
    radiolabelupdate();

    // inputクリック時実行
    $('input[name=gengou]').on('click',function(e){
        radiolabelupdate();
    });


});
