<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-お知らせをもっと見る')
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
            <a class="nav-link text-dark" href="http://127.0.0.1:8000/cken/mypage">
              <i class="fa fa-file-text-o" aria-hidden="true"></i> マイページ
              <span class="sr-only">(current)</span>
            </a>

            <a class="nav-link text-dark" href="{{ route('password_update_in') }}">
              <i class="fa fa-key" aria-hidden="true"></i> パスワード更新
              <span class="sr-only">(current)</span>
            </a>

            <a class="nav-link text-dark" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out" aria-hidden="true"></i> ログアウト
              <span class="sr-only">(current)</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
            </form>
          </div>
        </div>
      @endguest
      <!--/. ログイン者名表示 -->

      @auth <!-- ログインしている時はナビゲーションバーの中身を非表示 -->

      <!-- ログインしていない時はナビゲーションバーの中身を表示 -->
      @else
      <!-- Collapse button -->
      <button class="navbar-toggler second-button" type="button" data-toggle="collapse" data-target="#navbarSupportedContent23"
        aria-controls="navbarSupportedContent23" aria-expanded="false" aria-label="Toggle navigation">
        <div class="animated-icon2"><span></span><span></span><span></span><span></span></div>
      </button>

      <!-- Collapsible content -->
      <div class="collapse navbar-collapse" id="navbarSupportedContent23">

        <!-- Links -->
        <ul class="navbar-nav"><!-- バーガーメニューを開いたときは左揃え(デフォルト) -->
          <li class="nav-item active">
            <a class="nav-link text-dark" href="{{ route('login') }}">
            <i class="fa fa-sign-in" aria-hidden="true"></i> ログイン
            <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link text-dark" href="{{ route('register') }}">
            <i class="fa fa-user-plus" aria-hidden="true"></i> 新規登録
            <span class="sr-only">(current)</span></a>
          </li>
        </ul>
        <!-- Links -->

      </div>
      <!-- Collapsible content -->
      @endauth
      <!--/. ナビゲーションバーの中身を表示 -->

    </nav>
    <!--/.Navbar-->

    <!-- コンテンツ -->
    <div class="container-fluid main marginB">

      <!-- キャッチコピー -->
      <p class="catch-copy text-center border-bottom border-info mt-3 mb-5">
        お知らせ一覧
      </p>
      <!--/. キャッチコピー -->

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col" style="width:25%;"><big>日付</big></th>
            <th scope="col" style="width:30%;"><big>投稿者</big></th>
            <th scope="col" style="width:40%;"><big>タイトル</big></th>
            <th scope="col" style="width:5%;"><big></big></th><!-- New!表示 -->
          </tr>
        </thead>
        <tbody>
          @foreach ($news as $cont)
            <tr>
              <th scope="row">{{ $cont->updated_at->format('Y/m/d') }}
                (@php
                $wday = mb_substr($cont->updated_at->format('Y/m/d (l)'), 12, 3);
                switch($wday){
                  case "Sun": echo "日"; break;
                  case "Mon": echo "月"; break;
                  case "Tue": echo "火"; break;
                  case "Wed": echo "水"; break;
                  case "Thu": echo "木"; break;
                  case "Fri": echo "金"; break;
                  case "Sat": echo "土"; break;
                }
              @endphp)</th>
              <td>{{ $cont->user->name }}</td>
              <td><a href="{{ route('newsdetail', $cont->id) }}" target="_blank"><u class="text-primary">{{ $cont->newstitle }}</u></a></td>
              <!-- 更新日から1週間の間はNew!を表示 -->
              <td class="text-danger align-middle">
                <b>
                @php
                  $day = $cont->updated_at; //更新日を取得
                  $sevenafterday =  $day->addDays(7); //更新日から1週間後を計算
                  $today = Carbon\Carbon::now(); //実行当日の日付を取得
                  if($today->format('Y/m/d H:i:s') <= $sevenafterday->format('Y/m/d 23:59:59')){
                    echo "New!"; //トップページの表示処理が更新日から1週間後の23:59:59以内はNew!を表示
                  }
                @endphp
                </b>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- お知らせを閉じるボタン -->
      <form class="text-center" style="margin-bottom:78px;">
        <a href="{{ route('index') }}">
          <button type="button" class="btn btn-info text-dark">
            トップへ戻る
          </button>
        </a>
      </form>
      <!--/. お知らせを閉じるボタン -->

    </div>
    <!--/.コンテンツ-->

    <!-- ログインの有無でヘッダーの内容を変える -->
    @guest
      <!-- Footer -->
      <footer class="page-footer font-small">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-dark" style="background-color: #afeeee;">
          <b>© 2019 CKén Inc.</b>
        </div>
        <!--/. Copyright -->
      </footer>
      <!--/. Footer -->
    @elseif(Auth::user()->flg == 0)
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
            <!--<a href="http://127.0.0.1:8000/cken/mypage/coupon">-->
            <a href="#">
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
    @endguest

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
