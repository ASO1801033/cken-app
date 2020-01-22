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
Route::get ('/', 'CKenController@index'); //index.blade.php

//お知らせ詳細ページのルート情報
Route::get ('/cken/newsdetail/{id}', 'CKenController@newsdetail'); //newsdetail.blade.php

//お知らせをもっと見るページのルート情報
Route::get ('/cken/newsmore', 'CKenController@newsmore'); //newsdetail.blade.php

//企業ユーザーマイページのルート情報(ログインした人しか入られない)
Route::get ('/cken/mypage', 'CKenController@office') -> middleware('auth'); //mypage.blade.php

//一般ユーザーマイページのルート情報(ログインした人しか入られない)
Route::get ('/cken/mypage', 'CKenController@mypage') -> middleware('auth'); //mypage.blade.php

//お店登録のルート情報(登録ボタンを押した時)
Route::post ('/cken/mypage/shopreg', 'CKenController@shopreg') -> middleware('auth'); //mypage.blade.php

//お知らせ登録のルート情報(投稿ボタンを押した時)
Route::post ('/cken/mypage/newsreg', 'CKenController@newsreg') -> middleware('auth'); //mypage.blade.php

//行きたいお店詳細のルート情報(詳細確認ボタンを押した時)
Route::get ('/cken/mypage/goshopinfo/{id}', 'CKenController@goshopinfo') -> middleware('auth'); //goshopinfo.blade.php

//行きたいお店リストのルート情報(行ったボタンを押した時)
Route::post ('/cken/mypage/shop/went/{id}', 'CKenController@wentbutton') -> middleware('auth'); //mypage.blade.php

//行きたいお店詳細更新のルート情報(更新・削除ボタンを押した時)
Route::get ('/cken/mypage/retouch/{id}', 'CKenController@retouch') -> middleware('auth'); //retouch.blade.php

//行きたいお店詳細更新のルート情報(実行するボタンを押した時)
Route::post ('/cken/mypage/retouch/{id}/update', 'CKenController@update') -> middleware('auth'); //retouch.blade.php

//行ったお店詳細確認情報(詳細をみるボタンを押した時)
Route::get ('/cken/mypage/wentshopinfo/{id}', 'CKenController@wentshopinfo') -> middleware('auth'); //wentshopinfo.blade.php

//行ったお店リストのルート情報(行っていないことにするボタンを押した時)
Route::post ('/cken/mypage/shop/notwent/{id}', 'CKenController@notwentbutton') -> middleware('auth'); //wentshopinfo.blade.php

//ゴミ箱ボタンを押した時
Route::get ('/cken/mypage/shop/delete/{id}', 'CKenController@deletebutton') -> middleware('auth'); //wentshopinfo.blade.php

//一般ユーザークーポンのルート情報
Route::get ('/cken/mypage/coupon', 'CKenController@coupon_user') -> middleware('auth'); //coupon_user.blade.php

//お店側の情報修正一覧ページのルート情報
Route::get ('/cken/mypage/edit', 'CKenController@edit') -> middleware('auth'); //edit.blade.php

//お店側の情報修正ページのルート情報
Route::get ('/cken/mypage/editretouch/{id}', 'CKenController@editretouch') -> middleware('auth'); //editretouch.blade.php

//お店側の情報修正ページ 削除するボタンを押した時
Route::post ('/cken/mypage/delete', 'CKenController@newseditdelete') -> middleware('auth'); //edit.blade.php

//お店側のお知らせ・クーポンの内容修正ページ 実行するボタンを押した時
Route::post ('/cken/mypage/editretouch/{id}/update', 'CKenController@editupdate') -> middleware('auth'); //retouch.blade.php

Auth::routes();
