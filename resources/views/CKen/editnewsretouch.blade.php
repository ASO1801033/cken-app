<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-お知らせ内容修正')
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
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="news">

            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              内容の修正
            </p>
            <!--/. キャッチコピー -->

            <!-- Default form subscription -->
            <form class="text-center p-3" action="{{ route('editnewsupdate', $editdata->id) }}" method="post">
              {{ csrf_field() }}

              <div>
                <label class="col-md-12 control-label text-left mb-0">タイトル</label>

                <div class="col-md-12">
                  @if ($errors->has('newstitle'))
                  <div>
                    @foreach ($errors->get('newstitle') as $e)
                    <input type="text" class="form-control mb-0" name="newstitle" value="{{ old('newstitle') }}">
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <input type="text" class="form-control mb-3" name="newstitle" value="{{ $editdata->newstitle }}">
                  @endif
                </div>
              </div>

              <div>
                <label class="col-md-12 control-label text-left mb-0">内容</label>

                <div class="col-md-12">
                  @if ($errors->has('news'))
                  <div>
                    @foreach ($errors->get('news') as $e)
                    <textarea class="form-control rounded-0 mb-0" rows="4" name="news" value="{{ old('news') }}"></textarea>
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <textarea class="form-control rounded-0 mb-3" rows="4" name="news">{{ $editdata->news }}</textarea>
                  @endif
                </div>
              </div>

              <div class="mb-3">
                <a href="{{ route('edit') }}">
                  <button type="button" class="btn btn-success text-dark">戻る</button>
                </a>
                <button type="submit" class="btn btn-info text-dark">実行する</button>
              </div>

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

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
