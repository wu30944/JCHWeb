<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('login', 'LoginController@showLoginForm')->name('admin.login');
Route::post('login', 'LoginController@login');
Route::get('logout', 'LoginController@logout');
Route::post('logout', 'LoginController@logout');

Route::get('/', 'IndexController@index');


Route::get('index', ['as' => 'admin.index', 'uses' => function () {
    return redirect('/admin/log-viewer');
}]);


Route::group(['middleware' => ['auth:admin', 'menu', 'authAdmin']], function () {

    //权限管理路由
    Route::get('permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
    Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('permission', 'PermissionController', ['names' => ['update' => 'admin.permission.edit', 'store' => 'admin.permission.create']]);


    //角色管理路由
    Route::get('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);


    //用户管理路由
    Route::get('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::resource('user', 'UserController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);

    /*
     * 功能表管理
     * 2017/09/10  建立
     * */
    Route::get('function/index', ['as' => 'admin.function.index', 'uses' => 'PermissionController@create']);



    /*
        2017/09/19.  影片維護相關Route
    */
    Route::get('/MA_MoreYoutube',['as'=>'Videos.Show','uses'=>'VideosController@MA_MoreYoutube']);
    Route::post('/MA_Delete_Sunday_Video',['as'=>'Videos.Destory','uses'=>'VideosController@DeleteItem']);
    Route::post('/MA_Edit_Sunday_Video',['as'=>'Videos.Update','uses'=>'VideosController@EditItem']);
    Route::post('/MA_Insert_Sunday_Video',['as'=>'Videos.Create','uses'=>'VideosController@InsertItem']);
    Route::any('/MA_SearchMoreYoutube',['as'=>'Videos.Search','uses'=>'VideosController@Search']);

    /*
        2017/09/19  關於建成資料維護 Route 
    */
    Route::get('/MA_About',['as'=>'MA_About','uses'=>'AboutController@MA_About']);    
    Route::post('/MA_Update_About',['as'=>'MA_Update_About','uses'=>'AboutController@UpdateItem']);

    /*
        2017/09/19. 活照照片維護 Route
    */
    Route::get('/MA_ActionPhoto',['as'=>'MA_ActionPhoto','uses'=>'ActionPhotoController@MA_ActionPhoto']);
    Route::post('/MA_Insert_ActionPhoto',['as'=>'MA_Insert_ActionPhoto','uses'=>'ActionPhotoController@InsertItem']);
    Route::post('/MA_Update_ActionPhoto',['as'=>'MA_Update_ActionPhoto','uses'=>'ActionPhotoController@UpdateItem']);
    Route::post('/MA_Delete_ActionPhoto',['as'=>'MA_Delete_ActionPhoto','uses'=>'ActionPhotoController@DeleteItem']);
    
    /*
        2017/09/19 消息分類維護 Route
    */
    Route::get('/MA_Category',['as'=>'MA_Category','uses'=>'CategoryController@MA_Category']);

    /*
        2017/09/20. 團契資料維護 Route
    */
    Route::get('/MA_Fellowship',['as'=>'Fellowship.Show','uses'=>'FellowshipController@MA_Fellowship']);
    Route::post('/MA_Fellowship_D',['as'=>'Fellowship.Edit','uses'=>'FellowshipController@EditItem']);
    Route::post('/MA_Fellowship_D_Edit',['as'=>'Fellowship.Update','uses'=>'FellowshipController@UpdateItem']);
    Route::post('/MA_Fellowship_Photo',['as'=>'MA_Fellowship_Photo','uses'=>'FellowshipController@PhotoUpload']);
    Route::post ( '/MADeleteFellowship', ['as' => 'Fellowship.Destory','uses'=>'FellowshipController@DeleteItem' ]);
    Route::post ( '/MACreateFellowship', ['as' => 'Fellowship.Create','uses'=>'FellowshipController@AddItem' ]);

    /*
        2017/09/20  聚會時間資料維護 Route
    */
    Route::get('/MA_MeetingInfo',['as'=>'MeetingInfo.Show','uses'=>'MeetInfoController@MA_MeetingInfo']);
    Route::post('/meeting_edit',['as'=>'MeetingInfo.Edit','uses'=>'MeetInfoController@EditItem']);
    Route::post('/MeetingInfoUpdate',['as'=>'MeetingInfo.Update','uses'=>'MeetInfoController@UpdateItem']);
    Route::post ( '/DeleteItem', ['as'=>'MeetingInfo.Destory','uses'=>'MeetInfoController@DeleteItem' ]);
    Route::post ( '/AddItem', 'MeetInfoController@AddItem' );

    /*
        2017/09/20  消息資料維護 Route
    */      
    Route::get('/MA_News',['as'=>'News.Show','uses'=>'NewsController@MA_News']);
    Route::post('/MA_News_Edit',['as'=>'News.Edit','uses'=>'NewsController@editItem']);
    Route::post('/MANewsUpdate',['as'=>'News.Update','uses'=>'NewsController@UpdateItem']);
    Route::post('/MA_News_Insert',['as'=>'News.Create','uses'=>'NewsController@InsertItem']);
    Route::post('/MA_News_Photo',['as'=>'MA_News_Photo','uses'=>'NewsController@PhotoUpload']);
    Route::post('/MA_News_Delete',['as'=>'News.Destory','uses'=>'NewsController@DeleteItem']);

    /*
        2017/09/20  職務相關資料維護 Route
    */
    Route::get('/MA_Staff',['as'=>'Staff.Show','uses'=>'StaffController@MA_Staff']);
    Route::post('/MA_Insert_Staff',['as'=>'Staff.Create','uses'=>'StaffController@InsertItem']);
    Route::post('/MA_Update_Staff',['as'=>'Staff.Update','uses'=>'StaffController@UpdateItem']);
    Route::post('/MA_Delete_Staff',['as'=>'Staff.Destory','uses'=>'StaffController@DeleteItem']);
    Route::get ( '/MA_OurPastor', ['as' => 'StaffD.Show','uses'=>'StaffController@MA_our_pastor' ]);
    Route::post ( '/MA_OurPastor_D', ['as' => 'StaffD.Edit','uses'=>'StaffController@MA_OurPastor_D' ]);
    Route::post ( '/MA_Update_Staff_D', ['as' => 'StaffD.Update','uses'=>'StaffController@UpdateItemD' ]);
    Route::any ( '/MA_SearchStaff', ['as' => 'Staff.Search','uses'=>'StaffController@Search' ]);


    /*
     * 2017/09/29   金句資料維護 Route
     * */
    Route::get('/MA_Verses',['as'=>'Verses.Show','uses'=>'VersesController@MAVerses']);
    Route::post('/MAVersesEdit',['as'=>'Verses.Update','uses'=>'VersesController@editItem']);
    Route::post('/MAVersesAdd',['as'=>'Verses.Create','uses'=>'VersesController@InsertItem']);
    Route::post('/MAVersesShow',['as'=>'Verses.IsShow','uses'=>'VersesController@ChangeShow']);
    Route::post('/MAVersesDelete',['as'=>'Verses.Destory','uses'=>'VersesController@DeleteItem']);

    /*
     * 2017/10/04   輪播圖片資料維護 Route
     * */
    Route::get('MA_Carousel',['as'=>'Carousel.Show','uses'=>'CarouselController@MACarousel']);
    Route::post('MACreateCarousel',['as'=>'Carousel.Create','uses'=>'CarouselController@InsertItem']);
//    Route::get('MACarouselShow',['as'=>'MACarouselShow','uses'=>'CarouselController@CarouselShow']);
    Route::post('MAUpdateCarousel',['as'=>'Carousel.Update','uses'=>'CarouselController@UpdateItem']);
    Route::post('MADeleteCarousel',['as'=>'Carousel.Destory','uses'=>'CarouselController@DeleteItem']);
    Route::post('MACarouselIsShow',['as'=>'Carousel.IsShow','uses'=>'CarouselController@IsShowItem']);
    Route::post('MAEditCarousel',['as'=>'Carousel.Edit','uses'=>'CarouselController@EditItem']);



});

Route::get('/', function () {
    return redirect('/admin/index');
});

