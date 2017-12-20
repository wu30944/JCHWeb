<?php

/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider within a group which
 * | contains the "web" middleware group. Now create something great!
 * |
 */

// Route::get('/', function () {
// return view('welcome');
// });
Route::get ( '/', ['as' => 'index','uses' => 'IndexController@index']);

//Route::resource ( '/', ['as' => 'nav','uses' => 'HomeController@getNav']);

Route::get ( '/adultsunday', ['as' => 'inc.adultsunday',function () {
    return view ( 'fellowship.AdultSunday' );
} ]);

Route::resource('/article','ArticleController');

Route::resource ( '/MeetingInfo', 'MeetInfoController');

Route::get('/about',['as'=>'about','uses' => 'AboutController@show']);

Route::get('/debug',['as'=>'debug',function(){
    return view('debug.debug');
}]);

Route::get('/more_youtube',['as'=>'more_youtube','uses'=>'MoreYoutubeController@more_youtube']);
Route::get('/more_video/{video_type}',['as'=>'more_video','uses'=>'MoreYoutubeController@show']);

Route::get('/teens1',['as'=>'teens',
    //如果該Page必須要在登入後才能夠顯示，則需要加入下面這段程式
    // 'middleware'=>'auth',
    function()
    {
        return view('fellowship.teens');
    }
]);

Route::get('/fellowship/{id}',['as'=>'fellowship','uses'=>'FellowshipController@ShowFellowship']);

//行事曆測試
Route::get('/calendar',function()
{
    return view('calendar.calendar');
}
);

//最新消息
Route::get('/news',['as'=>'news','uses'=>'NewsController@show_news']);
Route::get('/{title}/news_d',['as'=>'news_d','uses'=>'NewsController@show_news_d']);
Route::post('/search',['as'=>'search','uses'=>'NewsController@search']);
Route::get('/news/{month}',['as'=>'month_news','uses'=>'NewsController@month_search']);


//cagegory route
Route::get('/category-tree-view',['uses'=>'CategoryController@manageCategory']);
Route::post('/add-category',['as'=>'add.category','uses'=>'CategoryController@addCategory']);


// //登入頁面的Route
// Route::get('/login',['as'=>'usr_login','uses'=>'LoginController@show']);
// Route::post('/login',['as'=>'post_login','uses'=>'LoginController@login']);
// Route::get('/logout',['as'=>'logout','uses'=>'LoginController@logout']);


// Route::get('/user_login',['as'=>'user_login',
// 					//如果該Page必須要在登入後才能夠顯示，則需要加入下面這段程式
// 					// 'middleware'=>'auth',
// 					function()
// 					{
// 					  return view('layouts.app');
// 					}
// ]);


Auth::routes();

Route::get('/home', 'HomeController@index');

//測試區塊
Route::get ( '/link', function () {
    return view ( 'link' );
} );

Route::post('/add_test',['as'=>'addtest','uses'=>'IndexController@addtest']);

Route::get('/datatables.data',['as'=>'datatables.data','uses'=>'MeetInfoController@test_']);


Route::post('/meeting_edit',['as'=>'meeting_edit','uses'=>'MeetInfoController@editItem']);

Route::post ( '/DeleteItem', 'MeetInfoController@DeleteItem' );

Route::post ( '/AddItem', 'MeetInfoController@AddItem' );

Route::get('/MeetingInfo_',['as'=>'MeetingInfo_','uses'=>'MeetInfoController@test_1']);

//測試區塊
Route::post('/search_test',['as'=>'search_test','uses'=>'NewsController@search_test']);
Route::get('/NewsSearch',['as'=>'News.Search','uses'=>'NewsController@search_test']);


// 維護的路由
Route::group(['middleware'=>'auth:admin'],function(){

    Route::get('/MA_MeetingInfo',['as'=>'MA_MeetingInfo','uses'=>'MeetInfoController@MA_MeetingInfo']);

    Route::get('/MA_Fellowship',['as'=>'MA_Fellowship','uses'=>'FellowshipController@MA_Fellowship']);

    Route::get('/MA_Fellowship_D',['as'=>'MA_Fellowship_D','uses'=>'FellowshipController@MA_Fellowship_D']);

    Route::post('/MA_Fellowship_D_Edit',['as'=>'MA_Fellowship_D_Edit','uses'=>'FellowshipController@editItem']);

    Route::post('/MA_Fellowship_Photo',['as'=>'MA_Fellowship_Photo','uses'=>'FellowshipController@PhotoUpload']);

    Route::get('/MA_News',['as'=>'MA_News','uses'=>'NewsController@MA_News']);

    Route::post('/MA_News_Edit',['as'=>'MA_News_Edit','uses'=>'NewsController@editItem']);

    Route::post('/MA_News_Save',['as'=>'MA_News_Save','uses'=>'NewsController@saveItem']);

    Route::post('/MA_News_Photo',['as'=>'MA_News_Photo','uses'=>'NewsController@PhotoUpload']);

    Route::post('/MA_News_Delete',['as'=>'MA_News_Delete','uses'=>'NewsController@DeleteItem']);

    Route::get('/MA_Category',['as'=>'MA_Category','uses'=>'CategoryController@MA_Category']);

    Route::get('/MA_MoreYoutube',['as'=>'MA_MoreYoutube','uses'=>'MoreYoutubeController@MA_MoreYoutube']);

    Route::post('/MA_Delete_Sunday_Video',['as'=>'MA_Delete_Sunday_Video','uses'=>'MoreYoutubeController@DeleteItem']);

    Route::post('/MA_Edit_Sunday_Video',['as'=>'MA_Edit_Sunday_Video','uses'=>'MoreYoutubeController@EditItem']);

    Route::post('/MA_Insert_Sunday_Video',['as'=>'MA_Insert_Sunday_Video','uses'=>'MoreYoutubeController@InsertItem']);

    Route::get('/MA_ActionPhoto',['as'=>'MA_ActionPhoto','uses'=>'ActionPhotoController@MA_ActionPhoto']);

    Route::post('/MA_Insert_ActionPhoto',['as'=>'MA_Insert_ActionPhoto','uses'=>'ActionPhotoController@InsertItem']);

    Route::post('/MA_Update_ActionPhoto',['as'=>'MA_Update_ActionPhoto','uses'=>'ActionPhotoController@UpdateItem']);

    Route::post('/MA_Delete_ActionPhoto',['as'=>'MA_Delete_ActionPhoto','uses'=>'ActionPhotoController@DeleteItem']);

    Route::get('/MA_Staff',['as'=>'MA_Staff','uses'=>'StaffController@MA_Staff']);

//    Route::post('/MA_Insert_Staff',['as'=>'MA_Insert_Staff','uses'=>'StaffController@InsertItem']);

    Route::post('/MA_Update_Staff',['as'=>'MA_Update_Staff','uses'=>'StaffController@UpdateItem']);

    Route::post('/MA_Delete_Staff',['as'=>'MA_Delete_Staff','uses'=>'StaffController@DeleteItem']);

    // Route::get('/MA_About',['as'=>'MA_About','uses'=>'AboutController@MA_About']);

    Route::post('/MA_Update_About',['as'=>'MA_Update_About','uses'=>'AboutController@UpdateItem']);


    Route::get ( '/MA_OurPastor', ['as' => 'MA_OurPastor','uses'=>'StaffController@MA_our_pastor' ]);
    /*
        2017/08/29. 建立職務明細 路由
    */
    Route::get ( '/MA_OurPastor_D', ['as' => 'MA_OurPastor_D','uses'=>'StaffController@MA_OurPastor_D' ]);

    Route::post ( '/MA_Update_Staff_D', ['as' => 'MA_Update_Staff_D','uses'=>'StaffController@UpdateItemD' ]);

    Route::post ( '/MADeleteFellowship', ['as' => 'MADeleteFellowship','uses'=>'FellowshipController@DeleteItem' ]);

    Route::post ( '/MACreateFellowship', ['as' => 'MACreateFellowship','uses'=>'FellowshipController@AddItem' ]);

    Route::post ( '/MACreateAlbum', ['as' => 'MACreateAlbum','uses'=>'AlbumController@AddItem' ]);
     Route::get ( '/MAAlbum', ['as' => 'MAAlbum','uses'=>'AlbumController@MAAlbum' ]);

    Route::post('/MA_SearchMoreYoutube',['as'=>'MA_SearchMoreYoutube','uses'=>'MoreYoutubeController@Search']);

//   Route::post('/MAVersesEdit',['as'=>'MAVersesEdit','uses'=>'VersesController@editItem']);
});

//維護的路由

//2017/06/02. 最新消息ajax 回資料庫撈資料
Route::post('/read_more',['as'=>'read_more','uses'=>'NewsController@ReadMore']);

// 2017/06/23.  將導覽列獨立出來一個框架，為了不要每次前往新頁面導要重撈資料庫
Route::post('/navigation',['as'=>'navigation','uses'=>'IndexController@GetNavigation']);
// Route::get('/navigation', function () {
// return view('inc.navigation');
// });

//2017/07/15. 新增與我們聯絡頁面
Route::get('/contact',['as'=>'contact',
    //如果該Page必須要在登入後才能夠顯示，則需要加入下面這段程式
    // 'middleware'=>'auth',
    function()
    {
        return view('about.contact');
    }
]);



Route::get('/staff/elder_deacon',['as'=>'elder_deacon','uses'=>'StaffController@show_elder_deacon']);


/*
    2017/08/21  建立我們的牧師 路由
*/
Route::get('/our_pastor',['as'=>'our_pastor','uses'=>'StaffController@show_our_pastor']);

/*
    2017/09/19. 主日信息預告 路由
*/
Route::get('/SundayPreview',['as'=>'SundayPreview','uses'=>'SundayPreviewController@index']);
/*
    2017/09/19. 會長
*/
Route::get('/Presidency',['as'=>'Presidency','uses'=>'StaffController@ShowPresidency']);


