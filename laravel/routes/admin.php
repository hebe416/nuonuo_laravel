<?php
use Illuminate\Http\Request;


Route::middleware('auth:admin')->get('/admin', function (Request $request) {
    return $request->user();
});

Auth::routes();

/*<!==用户显示页 ==!>*/
//Route::get('/'.env('ADMIN_URL'), 'HomeController@index')->name('home.index');
/*<!==修改用户信息页 ==!>*/
Route::get('/user/edit/{id}', 'HomeController@edit')->name('user.edit');

/*<!==修改用户信息动作 ==!>*/
Route::post('/user/update', 'HomeController@update')->name('user.update');


/*<!==ajaxcheck 手机号是否重复 邮箱是否重复 ==!>*/
Route::post('/ajax/check', 'HomeController@check')->name('ajax.check');
/*<!==用户显示页 ==!>*/
Route::get('', 'HomeController@index')->name('home.index');