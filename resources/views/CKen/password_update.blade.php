<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-パスワード更新')
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

            <!--
            <a class="nav-link text-dark" href="{{ route('password_update_in') }}">
              <i class="fa fa-key" aria-hidden="true"></i> パスワード更新
              <span class="sr-only">(current)</span>
            </a>
            -->

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
    <div class="container-fluid main">

      <h2 class="text-center mb-3">パスワード更新</h2>

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">

                      <div class="panel-body">
                          @if (session('change_password_error'))
                              <div class="container mt-2">
                                  <div class="alert alert-danger">
                                    {{session('change_password_error')}}
                                  </div>
                              </div>
                          @endif

                          @if (session('change_password_success'))
                              <div class="container mt-2">
                                  <div class="alert alert-success">
                                    {{session('change_password_success')}}
                                  </div>
                              </div>
                          @endif

                          <form class="form-horizontal" method="POST" action="{{ route('password_update') }}">
                              {{ csrf_field() }}

                              <!--
                              <div class="form-group">
                                  <label for="email" class="col-md-12 control-label">メールアドレス</label>

                                  <div class="col-md-12">
                                      <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>

                                      @if ($errors->has('email'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('email') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>
                              -->

                              <div class="form-group">
                                <label for="current" class="col-md-12">
                                    現在のパスワード
                                </label>
                                <div class="col-md-12">
                                    <input id="current" type="password" class="form-control" name="current-password" required autofocus>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="password" class="col-md-12">
                                    新しいパスワード
                                </label>
                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control" name="new-password" required>
                                    @if ($errors->has('new-password'))
                                        <div class="text-danger text-left">
                                            {{ $errors->first('new-password') }}
                                        </div>
                                    @endif
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="confirm" class="col-md-12">
                                    新しいパスワード(確認用)
                                </label>
                                <div class="col-md-12">
                                    <input id="confirm" type="password" class="form-control" name="new-password_confirmation" required>
                                </div>
                              </div>

                              <div class="col-md-12">
                                @if (session('change_password_success'))
                                    <a href="/cken/mypage">
                                        <button type="button" class="btn btn-primary btn-lg btn-block">
                                            マイページへ移動
                                        </button>
                                    </a>
                                @else
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">変更</button>
                                @endif
                              </div>
                          </form>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
    <!--/. コンテンツ -->

    <!-- Footer -->
    <footer class="page-footer font-small">

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3 text-dark fixed-bottom" style="background-color: #afeeee;">
        <b>© 2019 CKén Inc.</b>
      </div>
      <!--/. Copyright -->

    </footer>
    <!--/. Footer -->

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
