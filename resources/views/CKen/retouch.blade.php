<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-お店情報修正')
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
            <a class="nav-link active" id="shopinfo" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true">お店情報</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="shopinfo">
            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              情報の修正
            </p>
            <!--/. キャッチコピー -->

            <form action="{{ route('update', $goshops->id) }}" method="post">
              {{ csrf_field() }}

              <div class="mb-3">
                <label class="col-md-12 control-label text-left mb-0">店名</label>

                <div class="col-md-12">
                    <input type="text" class="form-control" name="shopname" value="{{ $goshops->shopname }}">
                </div>
              </div>

              <div class="mb-3">
                <label class="col-md-12 control-label text-left mb-0">ホームページ</label>

                <div class="col-md-12">
                  @if(empty($goshops->homepage))
                    <input type="text" class="form-control" name="homepage" placeholder="未登録" value="{{ old('homepage', $goshops->homepage) }}"><!-- 入力なし -->
                  @else
                    <input type="text" class="form-control" name="homepage" value="{{ old('homepage', $goshops->homepage) }}"><!-- 入力あり -->
                  @endif
                  @if ($errors->has('homepage'))
                    @foreach ($errors->get('homepage') as $e)
                      <div class="text-danger text-left">
                        {{$e}}
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>

              <div class="mb-3">
                <label class="col-md-12 control-label text-left mb-0">住所</label>

                <div class="col-md-12">
                  @if(empty($goshops->address))
                    <input type="text" class="form-control" name="address" placeholder="未登録" value="{{ old('address', $goshops->address) }}"><!-- 入力なし -->
                  @else
                    <input type="text" class="form-control" name="address" value="{{ old('address', $goshops->address) }}"><!-- 入力あり -->
                  @endif
                </div>
              </div>

              <div class="mb-3">
                <label class="col-md-12 control-label text-left mb-0">メモ</label>

                <div class="col-md-12">
                  @if(empty($goshops->memo))
                    <textarea class="form-control" rows="5" name="memo" placeholder="未登録" value="{{ old('memo', $goshops->memo) }}"></textarea><!-- 入力なし -->
                  @else
                    <textarea class="form-control" rows="5" name="memo" value="{{ old('memo', $goshops->memo) }}"></textarea><!-- 入力あり -->
                  @endif
                  @if ($errors->has('memo'))
                    @foreach ($errors->get('memo') as $e)
                      <div class="text-danger text-left">
                        {{$e}}
                      </div>
                    @endforeach
                  @endif
                </div>
              </div>

              <div class="mb-3">
                <a href="http://127.0.0.1:8000/cken/mypage">
                  <button type="button" class="btn btn-success text-dark">戻る</button>
                </a>
                <button type="submit" class="btn btn-info text-dark">実行する</button>
              </div>
            </form>
          </div>
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

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
