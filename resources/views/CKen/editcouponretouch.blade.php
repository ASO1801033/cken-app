<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-クーポン内容修正')
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
            <a class="nav-link active" id="coupon" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true">クーポン修正</a>
          </li>
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="coupon">

            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              内容の修正
            </p>
            <!--/. キャッチコピー -->

            <!-- Default form subscription -->
            <form class="text-center p-3" action="{{ route('editcouponupdate', $editdata->id) }}" method="post">
              {{ csrf_field() }}

              <div>
                <label class="col-md-12 control-label text-left mb-0">タイトル</label>

                <div class="col-md-12">
                  @if ($errors->has('coupontitle'))
                  <div>
                    @foreach ($errors->get('coupontitle') as $e)
                    <input type="text" class="form-control mb-0" name="coupontitle" value="{{ old('coupontitle') }}">
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <input type="text" class="form-control mb-3" name="coupontitle" value="{{ $editdata->coupontitle }}">
                  @endif
                </div>
              </div>

              <div>
                <label class="col-md-12 control-label text-left mb-0">内容</label>

                <div class="col-md-12">
                  @if ($errors->has('contents'))
                  <div>
                    @foreach ($errors->get('contents') as $e)
                    <textarea class="form-control" rows="4" name="contents" value="{{ old('contents') }}"></textarea>
                    <div class="text-danger text-left">
                      {{$e}}
                    </div>
                    @endforeach
                  </div>
                  @else
                    <textarea class="form-control mb-3" rows="4" name="contents">{{ $editdata->contents }}</textarea>
                  @endif
                </div>
              </div>

              <div class="text-left">
                <div class="row">
                  <div style="width: 55%;">
                    @if ($errors->has('startdate'))
                    <div>
                      @foreach ($errors->get('startdate') as $e)
                      　　利用開始日：<input type="date" class="mb-0" name="startdate" value="{{ $editdata->startdate->format('Y-m-d') }}"></input>
                      <div class="text-danger text-left">
                        　　{{$e}}
                      </div>
                      @endforeach
                    </div>
                    @else
                      　　利用開始日：<input type="date" class="mb-2" name="startdate" value="{{ $editdata->startdate->format('Y-m-d') }}"></input>
                    @endif
                  </div>

                  <div style="width: 45%;">
                    @if ($errors->has('starttime'))
                    <div>
                      @foreach ($errors->get('starttime') as $e)
                      利用開始時間：<input type="time" class="mb-0" name="starttime" value="{{ $editdata->starttime }}"></input><br>
                      <div class="text-danger text-left">
                        {{$e}}
                      </div>
                      @endforeach
                    </div>
                    @else
                      利用開始時間：<input type="time" class="mb-2" name="starttime" value="{{ $editdata->starttime }}"></input><br>
                    @endif
                  </div>
                </div>

                <div class="row">
                  <div style="width: 55%;">
                    @if ($errors->has('finishdate'))
                    <div>
                      @foreach ($errors->get('finishdate') as $e)
                      　　利用終了日：<input type="date" class="mb-0" name="finishdate" value="{{ old('finishdate') }}"></input>
                      <div class="text-danger text-left">
                        　　{{$e}}
                      </div>
                      @endforeach
                    </div>
                    @else
                      　　利用終了日：<input type="date" class="mb-2" name="finishdate" value="{{ $editdata->finishdate->format('Y-m-d') }}"></input>
                    @endif
                  </div>

                  <div style="width: 45%;">
                    @if ($errors->has('finishtime'))
                    <div>
                      @foreach ($errors->get('finishtime') as $e)
                      利用終了時間：<input type="time" class="mb-0" name="finishtime" value="{{ old('finishtime') }}"></input><br>
                      <div class="text-danger text-left">
                        {{$e}}
                      </div>
                      @endforeach
                    </div>
                    @else
                      利用終了時間：<input type="time" class="mb-2" name="finishtime" value="{{ $editdata->finishtime }}"</input><br>
                    @endif
                  </div>
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
