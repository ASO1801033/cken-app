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

    // テンプレートへ渡す情報を作成する。
    $newsdata = [
        'news' => $newsdata,
        'news_5' => $newsdata_5
    ];
    return view('index', $newsdata);
  }

  //お知らせ詳細ページのアクション
  public function newsdetail($id) {
    $detaildata = News::find($id);

    // テンプレートへ渡す情報を作成する。
    $detaildata = [
        'detail' => $detaildata
    ];
    return view('cken.newsdetail', $detaildata);
  }

  //お知らせをもっとみるページのアクション
  public function newsmore() {
    $newsdata = News::orderBy('updated_at', 'desc')->get();

    // テンプレートへ渡す情報を作成する。
    $newsdata = [
        'news' => $newsdata
    ];
    return view('cken.newsmore', $newsdata);
  }

  //企業ページのアクション
  public function office() {
    // テンプレート(resources/views/cken/mypage.blade.php)を表示
    return view('cken.mypage');
  }

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

      // テンプレート(resources/views/cken/mypage.blade.php)を表示
      return redirect('/cken/mypage')->with('flashmessage', '行きたいお店の登録が出来ました！');
  }

  //企業ユーザーお知らせ投稿ボタンを押した時の処理
  public function newsreg(NewsRequest $req) {
      // DBにお知らせ情報を登録
      $news = new News;
      $form = $req->all();
      $news->user_id = $req->user()->id;
      $news->timestamps;
      $news->fill($form)->save();

      // テンプレート(resources/views/cken/mypage.blade.php)を表示
      return redirect('/cken/mypage')->with('flashmessage', 'お知らせの投稿が出来ました！');
  }

  //行きたいお店リストの詳細ボタンを押した時の処理
  public function goshopinfo($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::find($id);

    // テンプレートへ渡す情報を作成する。
    $godata = [
        'goshops' => $shopdata
    ];

    // テンプレート(resources/views/cken/goshopinfo.blade.php)を表示
    return view('cken.goshopinfo', $godata);
  }

  //お店詳細の更新・削除ボタンを押した時の処理
  public function retouch($id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shopdata = Shop::find($id);

    // テンプレートへ渡す情報を作成する。
    $godata = [
        'goshops' => $shopdata
    ];

    // テンプレート(resources/views/cken/retouch.blade.php)を表示
    return view('cken.retouch', $godata);
  }

  //お店詳細の更新・削除実行ボタンを押した時の処理
  public function update(UpdateRequest $req, $id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $shop = Shop::find($id);

      if(isset($req->shopname)) {
        //shopnameに入力があれば更新
        $shop->shopname = $req->shopname;
      }
      $shop->homepage = $req->homepage;
      $shop->adress = $req->adress;
      $shop->memo = $req->memo;
      $shop->save();

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

    //mypageへリダイレクトする
    return redirect('/cken/mypage');
  }

  //ゴミ箱ボタンを押した時の処理
  public function deletebutton($id) {
    $shop = Shop::find($id);

    $shop->delete();

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
    $editdata = News::orderBy('updated_at', 'desc')->where('user_id', $req->user()->id)->get();

    // テンプレートへ渡す情報を作成する。
    $editdata = [
        'edit' => $editdata
    ];
    return view('cken.edit', $editdata);
  }

  //修正ページのアクション
  public function editretouch($id) {
    $newseditdata = News::find($id);

    // テンプレートへ渡す情報を作成する。
    $newseditdata = [
        'editdata' => $newseditdata
    ];
    return view('cken.editretouch', $newseditdata);
  }

  //修正ページ 削除するボタンを押した時の処理
  public function newseditdelete(Request $req) {
    News::destroy($req->chkDelete);

    //mypage/editへリダイレクトする
    return redirect('cken/mypage/edit');
  }

  //お店側のお知らせ・クーポンの内容修正ページ 実行するボタンを押した時
  public function editupdate(UpdateRequest $req, $id) {
    //お店を取得しておくviewの引数にデータの変数を渡す
    $newsdata = News::find($id);

      if(isset($req->title)) {
        //shopnameに入力があれば更新
        $newsdata->title = $req->title;
      }

      if(isset($req->news)) {
        //shopnameに入力があれば更新
        $newsdata->news = $req->news;
      }
      $newsdata->save();

    //mypage/editへリダイレクトする
    return redirect('/cken/mypage/edit');
  }

}
