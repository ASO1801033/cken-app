<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-マイページ')
  </head>

  <body>

    <!-- Start your project here-->

    <!-- ナビゲーションバー -->
    @section('logincom-nav')
    @endsection
    <!--/. ナビゲーションバー -->

    @if(Auth::user()->flg == 0)
      <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
      <div class="container-fluid main marginB">

        <!-- キャッチコピー -->
        <p class="catch-copy text-center border-bottom border-info mt-3 mb-5">
          ようこそ！ "{{ Auth::user()->name }}" さん
        </p>
        <!--/. キャッチコピー -->

        <div class="text-center">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="shopreg" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">お店登録</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="golist" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">行きたいお店</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="wentlist" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">行ったお店</a>
            </li>
            <style>/*<li class="nav-item">
              <a class="nav-link" id="report" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
                aria-selected="false">口コミ</a>
            </li>*/</style>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="shopreg">

              <!-- キャッチコピー -->
              <p class="catch-copy mt-3">
                行きたいお店登録
              </p>
              <!--/. キャッチコピー -->

              <!-- Default form subscription -->
              <form class="text-center p-3" action="http://127.0.0.1:8000/cken/mypage/shopreg" method="post">
                {{ csrf_field() }}

                <!-- Name -->
                @if ($errors->has('shopname'))
                <div>
                  @foreach ($errors->get('shopname') as $e)
                  <input type="text" class="form-control mb-0" placeholder="お店の名前" name="shopname" value="{{old('shopname')}}">
                  <div class="text-danger text-left">
                    {{$e}}
                  </div>
                  @endforeach
                </div>
                @else
                  <input type="text" class="form-control mb-4" placeholder="お店の名前" name="shopname" value="{{old('shopname')}}">
                @endif

                <!-- Homepage -->
                @if ($errors->has('homepage'))
                <div>
                  @foreach ($errors->get('homepage') as $e)
                  <input type="text" class="form-control mb-0" placeholder="ホームページ" name="homepage" value="{{old('homepage')}}">
                  <div class="text-danger text-left">
                    {{$e}}
                  </div>
                  @endforeach
                </div>
                @else
                  <input type="text" class="form-control mb-4" placeholder="ホームページ" name="homepage" value="{{old('homepage')}}">
                @endif

                <!-- Adress -->
                <input type="text" class="form-control mb-4" placeholder="お店の住所" name="adress" value="{{old('adress')}}">

                <!-- Memo -->
                <div class="form-group">
                  <textarea class="form-control rounded-0" rows="3" placeholder="メモ" name="memo" value="{{old('memo')}}"></textarea>
                </div>

                <!-- Register in button -->
                <input class="btn btn-info text-dark" type="submit" value="登録">

              </form>
              <!-- Default form subscription -->

              <!-- 登録完了メッセージの表示 -->
              @if(Session::has('flashmessage'))
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
                <script>
                  $(window).load(function() {
                  $('#modal_box').modal('show');
                  });
                </script>

                <!-- モーダルウィンドウの中身 -->
                <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">CKén-マイページ(お店登録)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        {{ session('flashmessage') }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">閉じる</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- モーダルウィンドウの中身 -->
              @endif
              <!-- 登録完了メッセージの表示 -->

            </div>
            <div class="tab-pane fade mb-5" id="profile" role="tabpanel" aria-labelledby="golist">
              <!-- キャッチコピー -->
              <p class="catch-copy mt-3">
                行きたいお店リスト
              </p>
              <!--/. キャッチコピー -->

              <!-- 行きたいお店リストの表示 -->
              @if(count($goshops) == 0)
                行きたいお店は登録されていません
              @else
                <!-- Grid row -->
                <div class="row">
                  @foreach($goshops as $shop)
                  <!-- Grid column -->
                  <div class="col-xl-6 col-lg-6 col-md-6">
                    <!--Card-->
                    <div class="card mb-5">
                      <!--Card image-->
                      <div class="view">
                        <img src="{{ asset('img/image.png') }}" class="card-img-top"
                          alt="photo">
                      </div>
                      <!--Card content-->
                      <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">{{ $shop->shopname }}</h4>

                        <div class="row">
                          <div class="col-6 text-right">
                            <form action="http://127.0.0.1:8000/cken/mypage/shop/went/{{ $shop->id }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-success text-dark">行った！</button>
                            </form>
                          </div>
                          <div class="col-6 text-left">
                            <a href="http://127.0.0.1:8000/cken/mypage/goshopinfo/{{ $shop->id }}" class="btn btn-info text-dark">詳細をみる</a>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!--/.Card-->
                  </div>
                  <!-- Grid column -->
                  @endforeach
                </div>
                <!-- Grid row -->
              @endif
              <!--/. 行きたいお店の表示 -->
            </div>

            <div class="tab-pane fade mb-5" id="contact" role="tabpanel" aria-labelledby="wentlist">
              <!-- キャッチコピー -->
              <p class="catch-copy mt-3">
                行ったお店リスト
              </p>
              <!--/. キャッチコピー -->

              <!-- 行ったお店リストの表示 -->
              @if(count($wentshops) == 0)
                行ったお店は登録されていません
              @else
                <!-- Grid row -->
                <div class="row">
                  @foreach($wentshops as $shop)
                  <!-- Grid column -->
                  <div class="col-xl-6 col-lg-6 col-md-6">
                    <!--Card-->
                    <div class="card mb-5">
                      <!--Card image-->
                      <div class="view">
                        <img src="{{ asset('img/image.png') }}" class="card-img-top"
                          alt="photo">
                      </div>
                      <!--Card content-->
                      <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">{{ $shop->shopname }}</h4>

                        <div class="row">
                          <div class="col-6 text-right">
                            <form action="http://127.0.0.1:8000/cken/mypage/shop/notwent/{{$shop->id}}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-success text-dark">行っとらん</button>
                            </form>
                          </div>
                          <div class="col-6 text-left">
                            <a href="http://127.0.0.1:8000/cken/mypage/wentshopinfo/{{ $shop->id }}" class="btn btn-info text-dark">詳細をみる</a>
                          </div>
                        </div>

                      </div>
                    </div>
                    <!--/.Card-->
                  </div>
                  <!-- Grid column -->
                  @endforeach
                </div>
                <!-- Grid row -->
              @endif
              <!--/. 行きたいお店の表示 -->
            </div>
            <style>/*<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="report">
              お店の感想や評価の口コミを書いてみましょう！
            </div>*/</style>
          </div>
        </div>
      </div>
      <!--/. コンテンツ -->

      <!-- Footer -->
      <footer class="page-footer font-small fixed-bottom">

        <!-- Copyright -->
        <div class="footer-copyright text-center" style="background-color: #afeeee;">
          <div class="row mt-1">
            <div class="col-4">
              <a href="http://127.0.0.1:8000/">
                <i class="fa fa-home fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">トップ</b>
              </a>
            </div>
            <div class="col-4">
              <a href="http://127.0.0.1:8000/cken/mypage">
                <i class="fa fa-shopping-cart fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">お店</b>
              </a>
            </div>
            <div class="col-4">
              <a href="http://127.0.0.1:8000/cken/mypage/coupon">
                <i class="fa fa-money fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">クーポン</b>
              </a>
            </div>
          </div>
        </div>
        <!--/. Copyright -->
      </footer>
      <!--/. Footer -->
    @else
      <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
      <div class="container-fluid main marginB">

        <!-- キャッチコピー -->
        <p class="catch-copy text-center border-bottom border-info mt-3 mb-5">
          ようこそ！ "{{ Auth::user()->name }}" さん
        </p>
        <!--/. キャッチコピー -->

        <div class="text-center">

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="news" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">お知らせ作成</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="coupon" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">クーポン作成</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="news">

              <!-- Default form subscription -->
              <form class="text-center p-3" action="http://127.0.0.1:8000/cken/mypage/newsreg" method="post">
                {{ csrf_field() }}

                <!-- キャッチコピー -->
                <p class="catch-copy mt-3">
                  お知らせ作成
                </p>
                <!--/. キャッチコピー -->

                <!-- Memo -->
                <div class="form-group">

                  @if ($errors->has('title'))
                  <div>
                    @foreach ($errors->get('title') as $e)
                    <div class="text-danger text-left">
                      {{$e}}<input type="text" class="form-control mb-2" placeholder="タイトル" name="title" value="{{old('title')}}">
                    </div>

                    @endforeach
                  </div>
                  @else
                    <input type="text" class="form-control mb-4" placeholder="タイトル" name="title" value="{{old('title')}}">
                  @endif


                  @if ($errors->has('news'))
                  <div>
                    @foreach ($errors->get('news') as $e)
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  <textarea class="form-control rounded-0" rows="5" placeholder="お知らせを入力してください" name="news" value="{{old('news')}}"></textarea>
                  @else
                    <textarea class="form-control rounded-0" rows="6" placeholder="お知らせを入力してください" name="news" value="{{old('news')}}"></textarea>
                  @endif
                </div>

                <!-- Register in button -->
                <input class="btn btn-info text-dark" type="submit" value="投稿">

              </form>
              <!-- Default form subscription -->

              <!-- 登録完了メッセージの表示 -->
              @if(Session::has('flashmessage'))
                <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
                <script>
                  $(window).load(function() {
                  $('#modal_box').modal('show');
                  });
                </script>

                <!-- モーダルウィンドウの中身 -->
                <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                  aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">CKén-マイページ(お知らせ投稿)</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        {{ session('flashmessage') }}
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">閉じる</button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- モーダルウィンドウの中身 -->
              @endif
              <!-- 登録完了メッセージの表示 -->

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="coupon">
              クーポンを作成してみましょう！
            </div>
          </div>
        </div>
      </div>
      <!--/. コンテンツ -->

      <!-- Footer -->
      <footer class="page-footer font-small fixed-bottom">

        <!-- Copyright -->
        <div class="footer-copyright text-center" style="background-color: #afeeee;">
          <div class="row mt-1">
            <div class="col-4">
              <a href="http://127.0.0.1:8000/">
                <i class="fa fa-home fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">トップ</b>
              </a>
            </div>
            <div class="col-4">
              <a href="http://127.0.0.1:8000/cken/mypage">
                <i class="fa fa-plus fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">お知らせ/クーポン</b>
              </a>
            </div>
            <div class="col-4">
              <a href="http://127.0.0.1:8000/cken/mypage/edit">
                <i class="fa fa-pencil-square-o fa-2x text-dark" aria-hidden="true"></i><br>
                <b class="text-dark">投稿管理/修正</b>
              </a>
            </div>
          </div>
        </div>
        <!--/. Copyright -->
      </footer>
      <!--/. Footer -->
    @endif

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
