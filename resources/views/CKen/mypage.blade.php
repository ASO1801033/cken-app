<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-マイページ')
  </head>

  <body>

    <!-- Start your project here-->

    <!--Navbar-->
    <nav class="navbar lighten-1 mb-4 fixed-top" style="background-color: #afeeee;">

      <!-- Navbar brand -->
      <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" width=111px height=39px></a>

      <!-- ログインしている時はログイン者名を表示 -->
      @guest
      @else
        <div class="dropdown float-right">
          <a class="dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
            <a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();" class="text-right">
              <i class="fa fa-sign-out" aria-hidden="true"></i> ログアウト
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      @endguest
      <!--/. ログイン者名表示 -->

    </nav>
    <!--/.Navbar-->

    @if(Auth::user()->flg == 0)
      <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
      <div class="container-fluid main">

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
              <form class="text-center p-3" action="{{ route('shopreg') }}" method="post">
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
                  <input type="text" class="form-control mb-3" placeholder="お店の名前" name="shopname" value="{{old('shopname')}}">
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
                  <input type="text" class="form-control mb-3" placeholder="ホームページ" name="homepage" value="{{old('homepage')}}">
                @endif

                <!-- Adress -->
                <input type="text" class="form-control mb-3" placeholder="お店の住所" name="adress" value="{{old('adress')}}">

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
                            <form action="{{ route('wentbutton', $shop->id) }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-success text-dark">行った！</button>
                            </form>
                          </div>
                          <div class="col-6 text-left">
                            <a href="{{ route('goshopinfo', $shop->id) }}" class="btn btn-info text-dark">詳細をみる</a>
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
                            <form action="{{ route('notwentbutton', $shop->id) }}" method="post">
                              {{ csrf_field() }}
                              <button type="submit" class="btn btn-success text-dark">行っとらん</button>
                            </form>
                          </div>
                          <div class="col-6 text-left">
                            <a href="{{ route('wentshopinfo', $shop->id) }}" class="btn btn-info text-dark">詳細をみる</a>
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
              <a href="{{ route('index') }}">
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
      <div class="container-fluid main">

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
              <form class="text-center p-3" action="{{ route('newsreg') }}" method="post">
                {{ csrf_field() }}

                <!-- キャッチコピー -->
                <p class="catch-copy mt-3">
                  お知らせ作成
                </p>
                <!--/. キャッチコピー -->

                <!-- form-group -->
                <div class="form-group">

                  @if ($errors->has('newstitle'))
                  <div>
                    @foreach ($errors->get('newstitle') as $e)
                    <input type="text" class="form-control mb-0" placeholder="タイトル" name="newstitle" value="{{old('newstitle')}}">
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <input type="text" class="form-control mb-3" placeholder="タイトル" name="newstitle" value="{{old('newstitle')}}">
                  @endif

                  @if ($errors->has('news'))
                  <div>
                    @foreach ($errors->get('news') as $e)
                    <textarea class="form-control rounded-0 mb-0" rows="5" placeholder="お知らせを入力してください" name="news" value="{{old('news')}}"></textarea>
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <textarea class="form-control rounded-0 mb-3" rows="6" placeholder="お知らせを入力してください" name="news" value="{{old('news')}}"></textarea>
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
                        <h6 class="modal-title" id="exampleModalLabel">CKén-マイページ</h6>
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
              <form class="text-center p-3" action="{{ route('couponreg') }}" method="post">
                {{ csrf_field() }}

                <!-- キャッチコピー -->
                <p class="catch-copy mt-3">
                  クーポン作成
                </p>
                <!--/. キャッチコピー -->

                <!-- form-group -->
                <div class="form-group marginB">

                  @if ($errors->has('coupontitle'))
                  <div>
                    @foreach ($errors->get('coupontitle') as $e)
                    <input type="text" class="form-control mb-0" placeholder="タイトル" name="coupontitle" value="{{old('coupontitle')}}">
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <input type="text" class="form-control mb-3" placeholder="タイトル" name="coupontitle" value="{{old('coupontitle')}}">
                  @endif

                  @if ($errors->has('contents'))
                  <div>
                    @foreach ($errors->get('contents') as $e)
                    <textarea class="form-control rounded-0" rows="3" placeholder="クーポン内容を入力してください" name="contents" value="{{old('contents')}}"></textarea>
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <textarea class="form-control rounded-0 mb-3" rows="5" placeholder="クーポン内容を入力してください" name="contents" value="{{old('contents')}}"></textarea>
                  @endif

                  <div class="text-left">
                    <div class="row">
                      <div style="width: 55%;">
                        @if ($errors->has('startdate'))
                        <div>
                          @foreach ($errors->get('startdate') as $e)
                          　利用開始日：<input type="date" class="mb-0" name="startdate" value="{{old('startdate')}}"></input>
                          <div class="text-danger text-left">
                            　{{$e}}
                          </div>
                          @endforeach
                        </div>
                        @else
                          　利用開始日：<input type="date" class="mb-2" name="startdate" value="{{old('startdate')}}"></input>
                        @endif
                      </div>
                      <div style="width: 45%;">
                        @if ($errors->has('starttime'))
                        <div>
                          @foreach ($errors->get('starttime') as $e)
                          利用開始時間：<input type="time" class="mb-0" name="starttime" value="{{old('starttime')}}"></input><br>
                          <div class="text-danger text-left">
                            {{$e}}
                          </div>
                          @endforeach
                        </div>
                        @else
                          利用開始時間：<input type="time" class="mb-2" name="starttime" value="{{old('starttime')}}"></input><br>
                        @endif
                      </div>
                    </div>

                    <div class="row">
                      <div style="width: 55%;">
                        @if ($errors->has('finishdate'))
                        <div>
                          @foreach ($errors->get('finishdate') as $e)
                          　利用終了日：<input type="date" class="mb-0" name="finishdate" value="{{old('finishdate')}}"></input>
                          <div class="text-danger text-left">
                            　{{$e}}
                          </div>
                          @endforeach
                        </div>
                        @else
                          　利用終了日：<input type="date" class="mb-2" name="finishdate" value="{{old('finishdate')}}"></input>
                        @endif
                      </div>
                      <div style="width: 45%;">
                        @if ($errors->has('finishtime'))
                        <div>
                          @foreach ($errors->get('finishtime') as $e)
                          利用終了時間：<input type="time" class="mb-0" name="finishtime" value="{{old('finishtime')}}"></input><br>
                          <div class="text-danger text-left">
                            {{$e}}
                          </div>
                          @endforeach
                        </div>
                        @else
                          利用終了時間：<input type="time" class="mb-2" name="finishtime" value="{{old('finishtime')}}"></input><br>
                        @endif
                      </div>
                    </div>

                  </div>

                  <!-- Register in button -->
                  <input class="btn btn-info text-dark" type="submit" value="投稿">

                </div>

              </form>

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
                        <h6 class="modal-title" id="exampleModalLabel">CKén-マイページ</h6>
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
              <a href="{{ route('index') }}">
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
              <a href="{{ route('edit') }}">
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
    <script>/*日付選択スクリプト*/
      var _addEvent=function(t,p,l){try{t.addEventListener(p,l,false);}catch(e){t.attachEvent("on"+p,function(e){l.call(t,e);});}};

      (function(){
      _addEvent(window, "load", function(e) {
        var yearId = "year"; // 年コントロールのID
        var monthId = "month"; // 月コントロールのID
        var dayId = "day"; // 日コントロールのID

        var targetYear = document.getElementById(yearId);
        var targetMonth = document.getElementById(monthId);
        var targetDay = document.getElementById(dayId);

        _addEvent(targetYear, "change", function(e) {
          // 年コントロールを変更したとき
          nonExistDayIsNonDisplayed(this, targetMonth, targetDay);
        });
        _addEvent(targetMonth, "change", function(e) {
          // 月コントロールを変更したとき
          nonExistDayIsNonDisplayed(targetYear, this, targetDay);
        });
      });

      /**
       * 存在しない日（2月30日など）の選択肢を非表示にする
       *
       * @param targetYear 年コントロール
       * @param targetMonth 月コントロール
       * @param targetDay 日コントロール
       */
      var nonExistDayIsNonDisplayed = function(targetYear, targetMonth, targetDay) {
        var selectedMonthValue = parseInt(targetMonth.getElementsByTagName("option")[targetMonth.selectedIndex].value, 10);
        var targetDayOptions = targetDay.getElementsByTagName("option");

        if (selectedMonthValue === 2) {
          // 2月の場合
          var selectedYearValue = parseInt(targetYear.getElementsByTagName("option")[targetYear.selectedIndex].value, 10)
          var leapYear = isLeapYear(selectedYearValue); // 閏年か

          for (var i = targetDayOptions.length - 1; i >= 0; i--) {
            var targetDayOption = targetDayOptions[i];
            var dayValue = parseInt(targetDayOption.value, 10);
            if (dayValue >= 30 || (dayValue === 29 && !leapYear)) {
              targetDayOption.disabled = true; // 選択不能指定
              if (targetDayOption.selected) {
                // 29日(閏年でない場合のみ)、30日、31日のいずれかが選択されていた場合は、2月の最終日に変更
                if (leapYear) {
                  targetDay.value = "29";
                } else {
                  targetDay.value = "28";
                }
              }
            } else if (targetDayOption.disabled) {
              // 選択不能指定が成されていたら解除
              targetDayOption.disabled = false;
            } else {
              break;
            }
          }
        } else if (selectedMonthValue === 4 || selectedMonthValue === 6 || selectedMonthValue === 9 || selectedMonthValue === 11) {
          // 月の日数が30日の場合
          for (var i = targetDayOptions.length - 1; i >= 0; i--) {
            var targetDayOption = targetDayOptions[i];
            var dayValue = parseInt(targetDayOption.value, 10);
            if (dayValue >= 31) {
              targetDayOption.disabled = true; // 選択不能指定
              if (targetDayOption.selected) {
                // 31日が選択されていた場合は、各月の最終日に変更
                targetDay.value = "30";
              }
            } else if (targetDayOption.disabled) {
              // 選択不能指定が成されていたら解除
              targetDayOption.disabled = false;
            } else {
              break;
            }
          }
        } else {
          // 月の日数が31日の場合
          for (var i = targetDayOptions.length - 1; i >= 0; i--) {
            var targetDayOption = targetDayOptions[i];
            if (targetDayOption.disabled) {
              // 選択不能指定が成されていたら解除
              targetDayOption.disabled = false;
            } else {
              break;
            }
          }
        }
      };

      /**
       * 閏年か
       *
       * @param year 年
       *
       * @return 閏年ならtrue、それ以外の場合はfalse
       */
      var isLeapYear = function(year) {
        return new Date(year, 1, 29).getMonth() === 1;
      };
      })();
    </script>
    <!--/. Script -->

  </body>

</html>
