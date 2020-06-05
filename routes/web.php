<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//トップページのルート情報
Route::get ('/', 'CKenController@index')->name('index'); //index.blade.php

//お知らせ詳細ページのルート情報
Route::get ('/cken/newsdetail/{id}', 'CKenController@newsdetail')->name('newsdetail'); //newsdetail.blade.php

//お知らせをもっと見るページのルート情報
Route::get ('/cken/newsmore', 'CKenController@newsmore')->name('newsmore'); //newsmore.blade.php

//企業ユーザーマイページのルート情報(ログインした人しか入られない)
//Route::get ('/cken/mypage', 'CKenController@office') -> middleware('auth'); //mypage.blade.php

//一般ユーザーマイページのルート情報(ログインした人しか入られない)
Route::get ('/cken/mypage', 'CKenController@mypage') -> middleware('auth'); //mypage.blade.php

//お店登録のルート情報(登録ボタンを押した時)
Route::post ('/cken/mypage/shopreg', 'CKenController@shopreg') -> middleware('auth')->name('shopreg'); //mypage.blade.php

//お知らせ登録のルート情報(投稿ボタンを押した時)
Route::post ('/cken/mypage/newsreg', 'CKenController@newsreg') -> middleware('auth')->name('newsreg'); //mypage.blade.php

//クーポン登録のルート情報(投稿ボタンを押した時)
Route::post ('/cken/mypage/couponreg', 'CKenController@couponreg') -> middleware('auth')->name('couponreg'); //mypage.blade.php

//行きたいお店詳細のルート情報(詳細確認ボタンを押した時)
Route::get ('/cken/mypage/goshopinfo/{id}', 'CKenController@goshopinfo') -> middleware('auth')->name('goshopinfo'); //goshopinfo.blade.php

//行きたいお店リストのルート情報(行ったボタンを押した時)
Route::post ('/cken/mypage/shop/went/{id}', 'CKenController@wentbutton') -> middleware('auth')->name('wentbutton'); //mypage.blade.php

//行きたいお店詳細更新のルート情報(更新・削除ボタンを押した時)
Route::get ('/cken/mypage/retouch/{id}', 'CKenController@retouch') -> middleware('auth')->name('retouch'); //retouch.blade.php

//行きたいお店詳細更新のルート情報(実行するボタンを押した時)
Route::post ('/cken/mypage/retouch/{id}/update', 'CKenController@update') -> middleware('auth')->name('update'); //retouch.blade.php

//行ったお店詳細確認情報(詳細をみるボタンを押した時)
Route::get ('/cken/mypage/wentshopinfo/{id}', 'CKenController@wentshopinfo') -> middleware('auth')->name('wentshopinfo'); //wentshopinfo.blade.php

//行ったお店リストのルート情報(行っていないことにするボタンを押した時)
Route::post ('/cken/mypage/shop/notwent/{id}', 'CKenController@notwentbutton') -> middleware('auth')->name('notwentbutton'); //wentshopinfo.blade.php

//ゴミ箱ボタンを押した時
Route::get ('/cken/mypage/shop/delete/{id}', 'CKenController@deletebutton') -> middleware('auth')->name('deletebutton'); //wentshopinfo.blade.php

//一般ユーザークーポンのルート情報
//Route::get ('/cken/mypage/coupon', 'CKenController@coupon_user') -> middleware('auth'); //coupon_user.blade.php

//お店側の情報修正一覧ページのルート情報
Route::get ('/cken/mypage/edit', 'CKenController@edit') -> middleware('auth')->name('edit'); //edit.blade.php

//お店側のお知らせ情報修正ページのルート情報
Route::get ('/cken/mypage/editnewsretouch/{id}', 'CKenController@editnewsretouch') -> middleware('auth')->name('editnewsretouch'); //editnewsretouch.blade.php

//お店側のクーポン情報修正ページのルート情報
Route::get ('/cken/mypage/editcouponretouch/{id}', 'CKenController@editcouponretouch') -> middleware('auth')->name('editcouponretouch'); //editcouponretouch.blade.php

//お店側の情報修正ページ お知らせを削除するボタンを押した時
Route::post ('/cken/mypage/newsdelete', 'CKenController@newseditdelete') -> middleware('auth')->name('newseditdelete'); //edit.blade.php

//お店側の情報修正ページ クーポンを削除するボタンを押した時
Route::post ('/cken/mypage/coupondelete', 'CKenController@couponeditdelete') -> middleware('auth')->name('couponeditdelete'); //edit.blade.php

//お店側のお知らせの内容修正ページ 実行するボタンを押した時
Route::post ('/cken/mypage/editretouch/{id}/newsupdate', 'CKenController@editnewsupdate') -> middleware('auth')->name('editnewsupdate'); //editnewsretouch.blade.php

//お店側のクーポンの内容修正ページ 実行するボタンを押した時
Route::post ('/cken/mypage/editretouch/{id}/couponupdate', 'CKenController@editcouponupdate') -> middleware('auth')->name('editcouponupdate'); //editcouponretouch.blade.php

//クーポン詳細ページのルート情報
Route::get ('/cken/coupondetail/{id}', 'CKenController@coupondetail')->name('coupondetail'); //coupondetail.blade.php

//クーポンをもっと見るページのルート情報
Route::get ('/cken/couponmore', 'CKenController@couponmore')->name('couponmore'); //couponmore.blade.php

Auth::routes();
