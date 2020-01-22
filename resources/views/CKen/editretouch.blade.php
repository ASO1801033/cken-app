<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/css/mdb.min.css" rel="stylesheet">
    <!-- Your custom styles (optional) -->
    <link href="css/style.css" rel="stylesheet">
    <!-- アイコンのCDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">
    <title>CKén-内容修正</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
              aria-selected="true">お知らせ修正</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="coupon" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">クーポン修正</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="news">

            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              内容の修正
            </p>
            <!--/. キャッチコピー -->

            <!-- Default form subscription -->
            <form class="text-center p-3" action="http://127.0.0.1:8000/cken/mypage/editretouch/{{$editdata->id}}/update" method="post">
              {{ csrf_field() }}

              <div class="mb-3">
                  <label class="col-md-12 control-label text-left mb-0">タイトル</label>

                  <div class="col-md-12">
                      <input type="text" class="form-control" name="title" value="{{ $editdata->title }}">
                  </div>
              </div>

              <div class="mb-3">
                  <label class="col-md-12 control-label text-left mb-0">内容</label>

                  <div class="col-md-12">
                      <textarea class="form-control" rows="5" name="news">{{ $editdata->news }}</textarea>
                  </div>
              </div>

              <div class="mb-3">
                <a href="http://127.0.0.1:8000/cken/mypage/edit">
                  <button type="button" class="btn btn-success text-dark">戻る</button>
                </a>
                <button type="submit" class="btn btn-info text-dark">実行する</button>
              </div>

            </form>
            <!-- Default form subscription -->

          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="coupon">

            <!-- Default form subscription -->
            <form class="text-center p-3" action="#" method="post">
              {{ csrf_field() }}

              <!-- キャッチコピー -->
              <p class="catch-copy mt-3">
                内容の修正
              </p>
              <!--/. キャッチコピー -->

            </form>
            <!-- Default form subscription -->

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

    <!-- SCRIPTS -->
    <!-- JQuery -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.8.10/js/mdb.min.js"></script>
    <!-- ハンバーガーメニュー -->
    <script>
    $(document).ready(function () {
      $('.first-button').on('click', function () {
        $('.animated-icon1').toggleClass('open');
      });
      $('.second-button').on('click', function () {
        $('.animated-icon2').toggleClass('open');
      });
      $('.third-button').on('click', function () {
        $('.animated-icon3').toggleClass('open');
      });
    });
    </script>

  </body>

</html>
