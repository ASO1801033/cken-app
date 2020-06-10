<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-パスワード再設定')
  </head>

  <body>

    <!-- Start your project here-->

    <!--Navbar-->
    <nav class="navbar lighten-1 mb-4 fixed-top" style="background-color: #afeeee;">

      <!-- Navbar brand -->
      <a class="navbar-brand" href="/"><img src="{{ asset('img/logo.png') }}" width=111px height=39px></a>
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

    <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
    <div class="container-fluid main">

      <h2 class="text-center mb-3">パスワード再設定</h2>

      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="panel panel-default">

                      <div class="panel-body">
                          <form class="form-horizontal" method="POST" action="{{ route('password.request') }}">
                              {{ csrf_field() }}

                              <input type="hidden" name="token" value="{{ $token }}">

                              <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
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

                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                  <label for="password" class="col-md-12 control-label">パスワード</label>

                                  <div class="col-md-12">
                                      <input id="password" type="password" class="form-control" name="password" required>

                                      @if ($errors->has('password'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                  <label for="password-confirm" class="col-md-12 control-label">パスワード(確認用)</label>
                                  <div class="col-md-12">
                                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                      @if ($errors->has('password_confirmation'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('password_confirmation') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>

                              <div class="form-group">
                                  <div class="col-md-12">
                                      <button type="submit" class="btn btn-primary btn-lg btn-block">
                                          パスワード再設定
                                      </button>
                                  </div>
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
