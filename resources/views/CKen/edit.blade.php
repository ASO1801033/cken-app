<!DOCTYPE html>
@extends('layouts.app')
<html lang="en">

  <head>
    @section('head')
    @section('title', 'CKén-投稿管理')
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
              <a class="nav-link active" id="news" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                aria-selected="true">お知らせ管理</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="coupon" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
                aria-selected="false">クーポン管理</a>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="news">

              <!-- Default form subscription -->
              <form class="text-center p-3" action="{{ route('newseditdelete') }}" method="post">
                {{ csrf_field() }}

                <!-- キャッチコピー -->
                <p class="catch-copy mt-3">
                  お知らせ管理
                </p>
                <!--/. キャッチコピー -->

                @if (count($edit) == 0)
                  <div class="mt-3">投稿されたお知らせはありません</div>
                @else
                  <div class="row">
                    <div class="col-md-12">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><big>日付</big></th>
                            <th scope="col"><big>タイトル</big></th>
                            <th scope="col"><big>修正</big></th>
                            <th scope="col"><big>削除</big></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($edit as $cont)
                            <tr>
                              <th scope="row" class="align-middle">
                                {{ $cont->updated_at->format('Y/m/d') }}
                              </th>
                              <!-- <td class="align-middle"><a href="http://127.0.0.1:8000/cken/newsdetail/{{ $cont->id }}" target="_blank"><u class="text-primary">{{ $cont->title }}</u></a></td> -->
                              <td class="align-middle"><a href="{{ route('newsdetail', $cont->id) }}" target="_blank"><u class="text-primary">{{ $cont->title }}</u></a></td>
                              <td class="align-middle"><a class="btn btn-info text-dark" href="{{ route('editretouch', $cont->id) }}" role="button">修正</a></td>
                              <td class="align-middle"><input type="checkbox" name="chkDelete[]" value="{{ $cont->id }}"></td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <button class="btn btn-success text-dark" type="button" data-toggle="modal" data-target="#basicExampleModal">チェックした投稿を削除する</button>

                  <!-- Modal -->
                  <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">CKén-マイページ(お知らせ削除)</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          本当に削除しますか？
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" data-dismiss="modal">いいえ</button>
                          <input type="submit" class="btn btn-info" value="削除する">
                        </div>
                      </div>
                    </div>
                  </form>

                @endif
              </div>
              <!-- Default form subscription -->

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="coupon">

              <!-- Default form subscription -->
              <form class="text-center p-3" action="https://www.google.co.jp" method="post">
                {{ csrf_field() }}

                <!-- キャッチコピー -->
                <p class="catch-copy mt-3">
                  クーポン管理
                </p>
                <!--/. キャッチコピー -->

                <!-- Register in button -->
                <input class="btn btn-info text-dark" type="submit" value="投稿">

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
