// function loadingScreen() {
//     var opts = {
//         lines: 13 // The number of lines to draw
//             ,
//         length: 28 // The length of each line
//             ,
//         width: 14 // The line thickness
//             ,
//         radius: 42 // The radius of the inner circle
//             ,
//         scale: 1 // Scales overall size of the spinner
//             ,
//         corners: 1 // Corner roundness (0..1)
//             ,
//         color: '#f0f3f6' // #rgb or #rrggbb or array of colors
//             ,
//         opacity: 0.25 // Opacity of the lines
//             ,
//         rotate: 0 // The rotation offset
//             ,
//         direction: 1 // 1: clockwise, -1: counterclockwise
//             ,
//         speed: 2 // Rounds per second
//             ,
//         trail: 60 // Afterglow percentage
//             ,
//         fps: 20 // Frames per second when using setTimeout() as a fallback for CSS
//             ,
//         zIndex: 2e9 // The z-index (defaults to 2000000000)
//             ,
//         className: 'spinner' // The CSS class to assign to the spinner
//             ,
//         top: '50%' // Top position relative to parent
//             ,
//         left: '50%' // Left position relative to parent
//             ,
//         shadow: false // Whether to render a shadow
//             ,
//         hwaccel: false // Whether to use hardware acceleration
//             ,
//         position: 'absolute' // Element positioning
//     };

//     var target = document.getElementById('Loading'); //loading為自定義ID要和HTML中的ID相同
//     var spinner = new Spinner(opts).spin(target);
// };


/*
    2017/09/20 原來載入畫面轉轉轉，寫法是利用spin這隻js
    但現在將維護功能都併入AdminLTE這個模板當中，
    與該模板中的載入畫面衝到，導致原來載入畫面會變得沒有作用，
    所以將入畫面都改為AdminLTE的方法
*/
$(window).load(function() {
    // alert('load');
    loadFadeOut();

    // $('#Loading').hide();
    // $('#LoadingScreen').modal('hide');
});

$(document).ready(function() {
    loadShow();
    // alert('test');
    // alert('ready');
    // loadingScreen();
    // $('#LoadingScreen').modal('show');
    // $('#Loading').show();


});


$(document).ajaxStart(function() {
    loadShow();
    //your code here
    // $('#LoadingScreen').modal('show');
    // $('#Loading').show();

});

$(document).ajaxStop(function() {
    loadFadeOut();
    //your code here
    // $('#Loading').hide();
    // $('#LoadingScreen').modal('hide');

});
