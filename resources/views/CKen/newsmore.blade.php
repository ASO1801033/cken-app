<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-お知らせをもっと見る')
  </head>

  <body>

    <!-- Start your project here-->

    <!-- ナビゲーションバー -->
    @section('logout-nav')
    @endsection
    <!--/. ナビゲーションバー -->

    <!-- コンテンツ -->
    <div class="container-fluid main">

      <!-- キャッチコピー -->
      <p class="catch-copy text-center border-bottom border-info mt-3 mb-5">
        お知らせ一覧
      </p>
      <!--/. キャッチコピー -->

      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col"><big>日付</big></th>
            <th scope="col"><big>投稿者</big></th>
            <th scope="col"><big>タイトル</big></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($news as $cont)
            <tr>
              <th scope="row">{{ $cont->updated_at->format('Y/m/d') }}</th>
              <td>{{ $cont->user->name }}</td>
              <td><a href="http://127.0.0.1:8000/cken/newsdetail/{{ $cont->id }}" target="_blank"><u class="text-primary">{{ $cont->title }}</u></a></td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <!-- お知らせを閉じるボタン -->
      <form class="text-center" style="margin-bottom:78px;">
        <a href="http://127.0.0.1:8000">
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
    @endguest

    <!-- Script -->
    @section('script')
    <!--/. Script -->

  </body>

</html>
