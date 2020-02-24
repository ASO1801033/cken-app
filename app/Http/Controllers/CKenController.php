<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\RegRequest;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\UpdateRequest;
use App\Http\Requests\CouponRequest;
use App\Shop;
use App\User;
use App\News;
use App\Coupon;

class CkenController extends Controller
{
  //トップページのアクション
  public function index() {
    $newsdata = News::orderBy('updated_at', 'desc')->get();
    $newsdata_5 = News::orderBy('updated_at', 'desc')->limit(5)->get();

    $coupondata = Coupon::orderBy('updated_at', 'desc')->get();
    $coupondata_5 = Coupon::orderBy('updated_at', 'desc')->limit(5)->get();

    // テンプレートへ渡す情報を作成する。
    $newsdata = [
        'news' => $newsdata,
        'news_5' => $newsdata_5
    ];

    // テンプレートへ渡す情報を作成する。
    $coupondata = [
        'coupon' => $coupondata,
        'coupon_5' => $coupondata_5
    ];
    \Log::info('トップページ表示'); //ログにメッセージを反映させる
    return view('index', $newsdata, $coupondata);
  }

  //お知らせ詳細ページのアクション
  public function newsdetail($id) {
    $detaildata = News::find($id);

    // テンプレートへ渡す情報を作成する。
    $detaildata = [
        'detail' => $detaildata
    ];
    \Log::info('お知らせ詳細ページ表示'); //ログにメッセージを反映させる
    return view('cken.newsdetail', $detaildata);
  }

  //お知らせをもっとみるページのアクション
  public function newsmore() {
    $newsdata = News::orderBy('updated_at', 'desc')->get();

    // テンプレートへ渡す情報を作成する。
    $newsdata = [
        'news' => $newsdata
    ];
    \Log::info('お知らせをもっと見るページ表示'); //ログにメッセージを反映させる
    return view('cken.newsmore', $newsdata);
  }

  //クーポン詳細ページのアクション
  public function coupondetail($id) {
    $detaildata = Coupon::find($id);

    // テンプレートへ渡す情報を作成する。
    $detaildata = [
        'detail' => $detaildata
    ];
    \Log::info('クーポン詳細ページ表示'); //ログにメッセージを反映させる
    return view('cken.coupondetail', $detaildata);
  }

  //企業ページのアクション
  /*public function office() {
    // テンプレート(resources/views/cken/mypage.blade.php)を表示
    return view('cken.mypage');
  }*/

  //一般ユーザーマイページのアクション
  public function mypage(Request $req) {
    //行っていないお店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::where('user_id', $req->user()->id)->where('flg', 0)->get();

    // テンプレートへ渡す情報を作成する。
    $godata = [
        'goshops' => $shopdata
    ];

    //行ったお店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::where('user_id', $req->user()->id)->where('flg', 1)->get();

    // テンプレートへ渡す情報を作成する。
    $wentdata = [
        'wentshops' => $shopdata
    ];

    \Log::info('マイページ表示'); //ログにメッセージを反映させる
    // テンプレート(resources/views/cken/mypage.blade.php)を表示
    return view('cken.mypage', $godata, $wentdata);
  }

  //一般ユーザーお店登録ボタンを押した時の処理
  public function shopreg(RegRequest $req) {
      // DBにお店情報を登録
      $shop = new Shop;
      $form = $req->all();
      $shop->user_id = $req->user()->id;
      $shop->timestamps = false; //登録時にupdated_atカラムへのタイムスタンプを無効にする
      $shop->fill($form)->save();

      \Log::info('一般ユーザー：行きたいお店登録ボタン押下→登録実行'); //ログにメッセージを反映させる
      // テンプレート(resources/views/cken/mypage.blade.php)を表示
      return redirect('/cken/mypage')->with('flashmessage1', '行きたいお店の登録が出来ました！');
  }

  //企業ユーザーお知らせ投稿ボタンを押した時の処理
  public function newsreg(NewsRequest $req) {
      // DBにお知らせ情報を登録
      $news = new News;
      $form = $req->all();
      $news->user_id = $req->user()->id;
      $news->timestamps;
      $news->fill($form)->save();

      \Log::info('企業ユーザー：お知らせ投稿ボタン押下→登録実行'); //ログにメッセージを反映させる
      // テンプレート(resources/views/cken/mypage.blade.php)を表示
      return redirect('/cken/mypage')->with('flash_message1', 'お知らせの投稿が出来ました！');
  }

  //企業ユーザークーポン投稿ボタンを押した時の処理
  public function couponreg(CouponRequest $req) {
      // DBにクーポン情報を登録
      $coupon = new Coupon;
      $form = $req->all();
      $coupon->user_id = $req->user()->id;
      $coupon->timestamps;
      $coupon->fill($form)->save();

      \Log::info('企業ユーザー：クーポン投稿ボタン押下→登録実行'); //ログにメッセージを反映させる
      // テンプレート(resources/views/cken/mypage.blade.php)を表示
      return redirect('/cken/mypage')->with('flash_message2', 'クーポンの投稿が出来ました！');
  }

  //行きたいお店リストの詳細ボタンを押した時の処理
  public function goshopinfo($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::find($id);

    // テンプレートへ渡す情報を作成する。
    $godata = [
        'goshops' => $shopdata
    ];

    \Log::info('一般ユーザー：行きたいお店リストの詳細ページ表示'); //ログにメッセージを反映させる
    // テンプレート(resources/views/cken/goshopinfo.blade.php)を表示
    return view('cken.goshopinfo', $godata);
  }

  //お店詳細の更新ボタンを押した時の処理
  public function retouch($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::find($id);

    // テンプレートへ渡す情報を作成する。
    $godata = [
        'goshops' => $shopdata
    ];

    \Log::info('一般ユーザー：お店情報修正ページ表示'); //ログにメッセージを反映させる
    // テンプレート(resources/views/cken/retouch.blade.php)を表示
    return view('cken.retouch', $godata);
  }

  //お店情報修正ページの実行するボタンを押した時の処理
  public function update(UpdateRequest $req, $id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shop = Shop::find($id);

      if(isset($req->shopname)) {
        //shopnameに入力があれば更新
        $shop->shopname = $req->shopname;
      }

      if(isset($req->homepage)) {
        //homepageに入力があれば更新
        $shop->homepage = $req->homepage;
      }else{
        $shop->homepage = $req->homepage;
      }

      if(isset($req->address)) {
        //addressに入力があれば更新
        $shop->address = $req->address;
      }else{
        $shop->address = $req->address;
      }

      if(isset($req->memo)) {
        //memoに入力があれば更新
        $shop->memo = $req->memo;
      }else{
        $shop->memo = $req->memo;
      }
      /*
      $shop->homepage = $req->homepage;
      $shop->address = $req->address;
      $shop->memo = $req->memo;
      */
      $shop->save();

    \Log::info('一般ユーザー：お店情報修正実行するボタン押下→更新実行'); //ログにメッセージを反映させる
    //mypageへリダイレクトする
    return redirect('/cken/mypage');
  }

  //行きたいお店リストの行ったボタンを押した時の処理
  public function wentbutton($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shop = Shop::find($id);

    //flgを1に更新して行ったことにする
    $shop->flg = 1;
    $shop->save();

    \Log::info('一般ユーザー：行った！ボタン押下→flgを0から1に変更'); //ログにメッセージを反映させる
    //mypageへリダイレクトする
    return redirect('/cken/mypage');
  }

  //行ったお店リストの詳細ボタンを押した時の処理
  public function wentshopinfo($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::find($id);

    // テンプレートへ渡す情報を作成する。
    $wentdata = [
        'goshops' => $shopdata
    ];

    \Log::info('一般ユーザー：行ったお店リストの詳細ページ表示'); //ログにメッセージを反映させる
    // テンプレート(resources/views/cken/wentshopinfo.blade.php)を表示
    return view('cken.wentshopinfo', $wentdata);
  }

  //行ったお店リストの詳細で行っていないことにするボタンを押した時の処理
  public function notwentbutton($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shop = Shop::find($id);

    //flgを0に更新して行っていないことにする
    $shop->flg = 0;
    $shop->save();

    \Log::info('一般ユーザー：行っとらんボタン押下→flgを1から0に変更'); //ログにメッセージを反映させる
    //mypageへリダイレクトする
    return redirect('/cken/mypage');
  }

  //ゴミ箱ボタンを押した時の処理
  public function deletebutton($id) {
    $shop = Shop::find($id);
    $shop->delete();

    \Log::info('一般ユーザー：ゴミ箱ボタン押下→削除実行'); //ログにメッセージを反映させる
    //mypageへリダイレクトする
    return redirect('/cken/mypage');
  }

  //一般ユーザークーポン
  public function coupon_user() {
    // テンプレート(resources/views/cken/coupon_user.blade.php)を表示
    return view('cken.coupon_user');
  }

  //お店側の情報修正一覧のページ
  public function edit(Request $req) {
    $editnewsdata = News::orderBy('updated_at', 'desc')->where('user_id', $req->user()->id)->get();
    $editcoupondata = Coupon::orderBy('updated_at', 'desc')->where('user_id', $req->user()->id)->get();

    // テンプレートへ渡す情報を作成する。
    $editdata = [
        'editnews' => $editnewsdata,
        'editcoupon' => $editcoupondata
    ];

    \Log::info('企業ユーザー：情報修正一覧ページ表示'); //ログにメッセージを反映させる
    return view('cken.edit', $editdata);
  }

  //お知らせ修正ページのアクション
  public function editnewsretouch($id) {
    $newseditdata = News::find($id);

    // テンプレートへ渡す情報を作成する。
    $newseditdata = [
        'editdata' => $newseditdata
    ];

    \Log::info('企業ユーザー：お知らせ情報修正ページ表示'); //ログにメッセージを反映させる
    return view('cken.editnewsretouch', $newseditdata);
  }

  //クーポン修正ページのアクション
  public function editcouponretouch($id) {
    $couponeditdata = Coupon::find($id);

    // テンプレートへ渡す情報を作成する。
    $couponeditdata = [
        'editdata' => $couponeditdata
    ];

    \Log::info('企業ユーザー：クーポン情報修正ページ表示'); //ログにメッセージを反映させる
    return view('cken.editcouponretouch', $couponeditdata);
  }

  //お知らせを削除するボタンを押した時の処理
  public function newseditdelete(Request $req) {
    News::destroy($req->chknewsDelete);

    \Log::info('企業ユーザー：お知らせを削除するボタン押下→削除実行'); //ログにメッセージを反映させる
    //mypage/editへリダイレクトする
    return redirect('cken/mypage/edit');
  }

  //クーポンを削除するボタンを押した時の処理
  public function couponeditdelete(Request $req) {
    Coupon::destroy($req->chkcouponDelete);

    \Log::info('企業ユーザー：クーポンを削除するボタン押下→削除実行'); //ログにメッセージを反映させる
    //mypage/editへリダイレクトする
    return redirect('cken/mypage/edit');
  }

  //お店側のお知らせの内容修正ページ 実行するボタンを押した時
  public function editnewsupdate(UpdateRequest $req, $id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $newsdata = News::find($id);

    if(isset($req->newstitle)) {
      //newstitleに入力があれば更新
      $newsdata->newstitle = $req->newstitle;
    }

    if(isset($req->news)) {
      //newsに入力があれば更新
      $newsdata->news = $req->news;
    }
    $newsdata->save();

    \Log::info('企業ユーザー：お知らせ情報修正実行するボタン押下→更新実行'); //ログにメッセージを反映させる
    //mypage/editへリダイレクトする
    return redirect('/cken/mypage/edit');
  }

  //お店側のお知らせの内容修正ページ 実行するボタンを押した時
  public function editcouponupdate(UpdateRequest $req, $id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $coupondata = Coupon::find($id);

    if(isset($req->coupontitle)) {
      //coupontitleに入力があれば更新
      $coupondata->coupontitle = $req->coupontitle;
    }

    if(isset($req->contents)) {
      //contentsに入力があれば更新
      $coupondata->contents = $req->contents;
    }

    if(isset($req->startdate)) {
      //startdateに入力があれば更新
      $coupondata->startdate = $req->startdate;
    }

    if(isset($req->starttime)) {
      //starttimeに入力があれば更新
      $coupondata->starttime = $req->starttime;
    }

    if(isset($req->finishdate)) {
      //finishdateに入力があれば更新
      $coupondata->finishdate = $req->finishdate;
    }

    if(isset($req->finishtime)) {
      //finishtimeに入力があれば更新
      $coupondata->finishtime = $req->finishtime;
    }
    $coupondata->save();

    \Log::info('企業ユーザー：クーポン情報修正実行するボタン押下→更新実行'); //ログにメッセージを反映させる
    //mypage/editへリダイレクトする
    return redirect('/cken/mypage/edit');
  }

  //クーポンをもっとみるページのアクション
  public function couponmore() {
    $couponsdata = Coupon::orderBy('updated_at', 'desc')->get();

    // テンプレートへ渡す情報を作成する。
    $couponsdata = [
        'coupon' => $couponsdata
    ];
    \Log::info('クーポンをもっと見るページ表示'); //ログにメッセージを反映させる
    return view('cken.couponmore', $couponsdata);
  }

}
