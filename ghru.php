<!DOCTYPE html>
<html lang="en">
  <body>
    <!-- コンテンツ(スクロールするとヘッダーの下に動く) -->
    <div class="container-fluid main">

      <!-- キャッチコピー -->
      <p class="catch-copy text-center border-bottom border-info">
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
                  <td class="text-left" style="word-wrap:break-word;">{{ $goshops->homepage }}</td>
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

          <a href="http://127.0.0.1:8000/cken/mypage/retouch/{{$goshops->id}}">
            <button type="button" class="btn btn-success text-dark">更新・削除</button>
          </a>
          <a href="http://127.0.0.1:8000/cken/mypage">
            <button type="button" class="btn btn-info text-dark">戻る</button>
          </a>
          </div>

          <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="shopmap">
            <!-- キャッチコピー -->
            <p class="catch-copy mt-3">
              お店周辺の地図
            </p>
            <!--/. キャッチコピー -->
            <div class="bg-info">
              map
            </div>
          </div>
      </div>
    </div>
    <!--/. コンテンツ -->

  </body>

</html>
