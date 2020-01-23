<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-内容修正')
  </head>

  <body>

    <!-- Start your project here-->

    <!-- ナビゲーションバー -->
    @section('logincom-nav')
    @endsection
    <!--/. ナビゲーションバー -->

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

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
