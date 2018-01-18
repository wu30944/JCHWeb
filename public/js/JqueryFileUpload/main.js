$(function () {
    var $DeletePhotoId;
    var $DeleteAlbumId;
    // alert(upload_url);
    'use strict';
    $('#post-form').fileupload({
        url: upload_url,
        autoUpload: false,
        previewMaxWidth: 120,
        previewMaxHeight: 90,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|bmp)$/i,
        maxFileSize: 10240000,
        minFileSize: undefined,
        maxNumberOfFiles: 20
    });

    $(document).on('click', '.delete-modal', function() {


        //$(window).scrollTop(0);
        $.ajax({
            type: 'post',
            url: destory_url,
            data: {
                '_token': $('input[name=_token]').val(),
                'DeletePhotoId':$DeletePhotoId,
                'DeleteAlbumId':$DeleteAlbumId
            },
            success: function(data) {
                $('#collapseTwo').load(location.href+" #collapseTwo>*","");
                $('#DeleteModel').modal('hide');
            },error:function(e)
            {
                var errors=e.responseJSON;

                // $('#FailAlter').removeClass('hide');
                // $('#FailAlter').show();
//                $('#FailMsg').val(errors.Message);
//                 $('#FailAlter span').text(errors.Message);
//                 $(window).scrollTop(0);
//                 $('#myModal').modal('show');
            }
        });
    });

    $(document).on('click', '.delete', function() {

        $DeleteAlbumId=$('#AlbumId').val();
        var $stuff = $(this).data('info');
        var $selected=[];
        if($stuff==''){

            $("[name=delete]:checkbox:checked").each(function(){
                $selected.push($(this).val());
            });
            $DeletePhotoId=$selected;
        }else{
            $selected.push($stuff);
            $DeletePhotoId=$selected;
        }
        if($DeletePhotoId==''){
            alert('未選擇刪除的圖片');
        }else{
            $('#DeleteModel').modal('show');
        }


    });

    $(document).on('click', '.start', function() {
        // alert('test');
    });
    // $('button.delete').live('click', function () {
    //     // var row = $(this).parent().parent();
    //     // row.fadeOut('fast');
    //     alert('test');
    // });
    $('#Post_is_all_city').click(function(){
        alert('ac');
    });
    // Load existing files:
    $('#post-form').addClass('fileupload-processing');
    $.ajax({
        url: $('#post-form').fileupload('option', 'url'),
        dataType: 'json',
        context: $('#post-form')[0]
    }).always(function () {
        $(this).removeClass('fileupload-processing');
    }).done(function (result) {
        $(this).fileupload('option', 'done').call(this, $.Event('done'), {result: result});
        alert('test');
    });

    // set is_cover to cookie
    // $('input[name="is_cover"]').live('click', function () {
    //     $.cookie('post_img_cover', $(this).val(), { path: '/' });
    // });

    // $('.add_to_content').live('click', function (e) {
    //     e.preventDefault();
    //     tinyMCE.execCommand('mceInsertRawHTML', false, '<img src="' + $(this).attr('url') + '" />');
    // });


    // $("#upload-grid").mCustomScrollbar({
    //     scrollInertia: 300,
    //     horizontalScroll: true,
    //     advanced: {
    //         updateOnBrowserResize: true, /*update scrollbars on browser resize (for layouts based on percentages): boolean*/
    //         updateOnContentResize: true, /*auto-update scrollbars on content resize (for dynamic content): boolean*/
    //         autoExpandHorizontalScroll: false, /*auto-expand width for horizontal scrolling: boolean*/
    //         autoScrollOnFocus: true, /*auto-scroll on focused elements: boolean*/
    //         normalizeMouseWheelDelta: false /*normalize mouse-wheel delta (-1/1)*/
    //     },
    //     scrollButtons: {
    //         enable: true
    //     },
    //     theme: "dark-thick"
    // });
    //load map
    // if ($('#Post_latlng').val() != '') {
    //     google_map($('#Post_latlng').val());
    // }
    // else if ($('#Post_city_id').val() != '') {
    //     $('#Post_city_id').change();
    // }

});