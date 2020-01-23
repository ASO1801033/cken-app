<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-お店詳細')
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
            <a class="nav-link active" id="shopinfo" data-toggle="tab" href="#home" role="tab" aria-controls="home"
              aria-selected="true">お店情報</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="shopmap" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
              aria-selected="false">Map</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="shopinfo">
            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              お店の詳細

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-sm" id="deletebutton" data-toggle="modal" data-target="#basicExampleModal">
                <i class="fa fa-trash-o text-danger fa-2x" aria-hidden="true"></i>
              </button>

              <!-- Modal -->
              <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">CKén-マイページ(お店削除)</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      本当に削除しますか？
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-success" data-dismiss="modal">いいえ</button>
                      <a href="http://127.0.0.1:8000/cken/mypage/shop/delete/{{$goshops->id}}">
                        <button type="button" class="btn btn-info">削除する</button>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </p>
            <!--/. キャッチコピー -->

            <table class="table table-borderless" style="table-layout:fixed;">
              <thead>
                <tr>
                  <th scope="col" style="width:50%;" class="text-right">【項目】</th>
                  <th scope="col" style="width:50%;" class="text-left">【情報】</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row" class="text-right">店名</th>
                  <td class="text-left" style="word-wrap:break-word;">{{ $goshops->shopname }}</td>
                </tr>
                <tr>
                  <th scope="row" class="text-right">ホームページ</th>
                  @if(empty($goshops->homepage))
                    <td class="text-left" style="word-wrap:break-word;"><span style="background-color: #F7DD67;">未登録</span></td>
                  @else
                    <td class="text-left" style="word-wrap:break-word;">
                      <a href="{{ $goshops->homepage }}" target="_blank" class="text-primary">{{ $goshops->homepage }}</a>
                    </td>
                  @endif
                </tr>
                <tr>
                  <th scope="row" class="text-right">住所</th>
                  @if(empty($goshops->adress))
                    <td class="text-left" style="word-wrap:break-word;"><span style="background-color: #F7DD67;">未登録</span></td>
                  @else
                    <td class="text-left" style="word-wrap:break-word;">{{ $goshops->adress }}</td>
                  @endif
                </tr>
                <tr>
                  <th scope="row" class="text-right">メモ</th>
                  @if(empty($goshops->memo))
                    <td class="text-left" style="word-wrap:break-word;"><span style="background-color: #F7DD67;">未登録</span></td>
                  @else
                    <td class="text-left" style="word-wrap:break-word;">{{ $goshops->memo }}</td>
                  @endif
                </tr>
              </tbody>
            </table>

            <div class="mb-3">
              <a href="http://127.0.0.1:8000/cken/mypage/retouch/{{$goshops->id}}">
                <button type="button" class="btn btn-success text-dark">更新</button>
              </a>
              <a href="http://127.0.0.1:8000/cken/mypage">
                <button type="button" class="btn btn-info text-dark">戻る</button>
              </a>
            </div>
          </div>
          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="shopmap">
            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              お店周辺の地図
            </p>
            <!--/. キャッチコピー -->

            <!-- マップの表示 -->
            @if(isset($goshops->adress))
              <iframe src="http://maps.google.co.jp/maps?&output=embed&q={{$goshops->adress}}" width="100%" height="400"></iframe>
            @else
              <div class="text-danger">
                ⚠︎住所が設定されていないためデフォルトを表示中です！
              </div>
              <iframe src="http://maps.google.co.jp/maps?&output=embed&q=東京駅" width="100%" height="400"></iframe>
            @endif
            <!--/. マップの表示 -->

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
