<?php
use Illuminate\Http\Request;


Route::middleware('auth:admin')->get('/admin', function (Request $request) {
    return $request->user();
});



/*<!==用户显示页 ==!>*/
Route::get('login', 'Admin\\AuthController@showLoginForm')->name('login');

Route::group(['middleware' => 'auth.check.login'], function () {
    Route::get('', 'HomeController@index')->name('home.index');
});
/*<!==用户登录 ==!>*/
Route::post('login', 'Admin\\AuthController@login');

/*<!==用户注销 ==!>*/
Route::post('logout', 'Admin\\AuthController@logout')->name('logout');




/*<!==修改用户信息页 ==!>*/
Route::get('/user/edit/{id}', 'HomeController@edit')->name('user.edit');

/*<!==修改用户信息动作 ==!>*/
Route::post('/user/update', 'HomeController@update')->name('user.update');


/*<!==ajaxcheck 手机号是否重复 邮箱是否重复 ==!>*/
Route::post('/ajax/check', 'HomeController@check')->name('ajax.check');
