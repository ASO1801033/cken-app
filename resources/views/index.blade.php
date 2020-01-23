<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-トップ')
  </head>

  <body>

    <!-- Start your project here-->

    <!-- ナビゲーションバー -->
    @section('logout-nav')
    @endsection
    <!--/. ナビゲーションバー -->

    <!-- カルーセル -->
    <div class="carousel">
      <div id="cr1" class="carousel slide" data-ride="carousel" style="width:70%">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="slide/img/dum01.png" alt="First slide">
          </div>
          <div class="carousel-item">
              <img class="d-block w-100" src="slide/img/dum02.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="slide/img/dum03.png" alt="Third slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="slide/img/dum04.png" alt="Fourth slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="slide/img/dum05.png" alt="Fifth slide">
          </div>
        </div>


        <a class="carousel-control-prev" href="#cr1" role="button" data-slide="prev">
          <span><i class="fa fa-angle-left fa-2x text-info" aria-hidden="true"></i></span>
          <span class="sr-only">Previous</span></a>
        <a class="carousel-control-next" href="#cr1" role="button" data-slide="next">
          <span><i class="fa fa-angle-right fa-2x text-info" aria-hidden="true"></i></span>
          <span class="sr-only">Next</span></a>
      </div>
    </div>
    <!--/. カルーセル -->

    <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
    <div class="container-fluid main">

      <!-- キャッチコピー -->
      <p class="catch-copy text-center border-bottom border-info mt-3 mb-5">CKénで始めるお出かけライフ</p>
      <!--/. キャッチコピー -->

      <!-- グリッドシステム1段目 -->
      <div class="row text-center">

        <!-- お知らせ -->
        <div class="col-md-6 mb-5">

          <!-- 中身 -->
          <div class="row">
            <div class="col-md-12 text-left">

              <!-- 見出し -->
              <div class="row">
                <div class="col-md-12 text-left">
                  <i class="fa fa-info-circle fa-2x" aria-hidden="true">
                    おしらせ
                  </i>
                </div>
              </div>

              <!-- 直近のお知らせ -->
              @if (count($news) == 0)
                <div class="mt-3">投稿されたお知らせはありません</div>
              @else
                <div class="row">
                  <div class="col-md-12">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col"><big>日付</big></th>
                          <th scope="col"><big>投稿者</big></th>
                          <th scope="col"><big>タイトル</big></th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (count($news) > 5)
                          @foreach ($news_5 as $cont)
                            <tr>
                              <!--<th scope="row">{{ $cont->created_at->format('Y/m/d H:m:s') }}</th>-->
                              <th scope="row">{{ $cont->updated_at->format('Y/m/d') }}</th>
                              <td>{{ $cont->user->name }}</td>
                              <td><a href="http://127.0.0.1:8000/cken/newsdetail/{{ $cont->id }}" target="_blank"><u class="text-primary">{{ $cont->title }}</u></a></td>
                            </tr>
                          @endforeach
                          <tr>
                            <th scope="row"></th>
                            <td></td>
                            <td><a href="http://127.0.0.1:8000/cken/newsmore"><u class="text-primary">もっと見る</u></a></td>
                          </tr>
                        @else
                          @foreach ($news as $cont)
                            <tr>
                              <!--<th scope="row">{{ $cont->created_at->format('Y-m-d') }}</th>-->
                              <th scope="row">{{ $cont->updated_at->format('Y/m/d') }}</th>
                              <td>{{ $cont->user->name }}</td>
                              <td><a href="http://127.0.0.1:8000/cken/newsdetail/{{ $cont->id }}" target="_blank"><u class="text-primary">{{ $cont->title }}</u></a></td>
                            </tr>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div>
        <!--/. お知らせ -->

        <!-- クーポン -->
        <div class="col-md-6 mb-5">

          <!-- 中身 -->
          <div class="row">
            <div class="col-md-12 text-left">

              <!-- 見出し -->
              <div class="row">
                <div class="col-md-12 text-left">
                  <i class="fa fa-money fa-2x" aria-hidden="true">
                    クーポン
                  </i>
                </div>
              </div>

              <!-- 直近のクーポン -->
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><big>投稿日</big></th>
                        <th scope="col"><big>投稿者</big></th>
                        <th scope="col"><big>クーポン名</big></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">クーポン</u></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">クーポン</u></td>
                      </tr>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">クーポン</u></a></td>
                      </tr>
                      <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td><a href="https://google.com" target="_blank"><u class="text-primary">もっと見る</u></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/. クーポン -->

      </div>
      <!--/. グリッドシステム1段目 -->
<style>/*
      <!-- グリッドシステム2段目 -->
      <div class="row text-center">

        <!-- 口コミ -->
        <div class="col-md-6">

          <!-- 中身 -->
          <div class="row">
            <div class="col-md-12 text-left">

              <!-- 見出し -->
              <div class="row">
                <div class="col-md-12 text-left">
                  <i class="fa fa-commenting fa-2x" aria-hidden="true">
                    口コミ
                  </i>
                </div>
              </div>

              <!-- 直近の口コミ -->
              <div class="row">
                <div class="col-md-12">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th scope="col"><big>投稿日</big></th>
                        <th scope="col"><big>投稿者</big></th>
                        <th scope="col"><big>口コミ名</big></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">口コミ</u></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">口コミ</u></a></td>
                      </tr>
                      <tr>
                        <th scope="row">2019/11/7</th>
                        <td>あやさん</td>
                        <td><a href="https://www.apple.com/jp/" target="_blank"><u class="text-primary">口コミ</u></a></td>
                      </tr>
                      <tr>
                        <th scope="row"></th>
                        <td></td>
                        <td><a href="https://google.com" target="_blank"><u class="text-primary">もっと見る</u></a></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--/. 口コミ -->

      </div>
      <!--/. グリッドシステム2段目 -->
*/</style>
    </div>
    <!--/. コンテンツ -->

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
