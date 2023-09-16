<!DOCTYPE html>
<html lang="ja">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    @stop

    @extends('adminlte::page')

    @section('title', '備品管理システム_TOP')

</head>

<body>
    @section('content_header')

        <h1><img src="vendor/adminlte/dist/img/AdminLTELogo.png" alt="" style="width:40px; height:40px;"> 備品管理システム</h1>
    @stop
    @section('content')
        <p>現在の備品の情報や在庫の確認ができます</p>

<!-- 新規登録品表示 -->
<div class="container" style="display: flex; margin: 10px 0; border: 1px solid;">
    <div class="contents1" style="margin: 5px; padding: 20px 10px;">
        <div class="row">
            <div class="col-lg-5">
                <div class="card-header">
                    <h6 class="card-title"><span class=text-secondary>▶︎</span> 更新情報</h6>
                </div>
                <div class="card border-light" style="width: 40em;">
                    <div class="row g-0">
                        @if ($items->count() == 0)
                        <p>商品はありません。</p>
                        @else
                        <div class="col-md-4 p-2">
                            <h5 class="text-center text-secondary">N E W</h5>

                            <!-- データベースの画像を表示 -->
                            @if(isset($items[0]->image))
                            <img width="128" height="128" src="data:image/jpeg;base64, {{ $items[0]->image }}" alt="" style="margin-left: 40px;">
                            @else
                            <img width="128" height="128" src="/images/noimage.jpg" alt="">
                            @endif   
                        </div>
                        <div class="col-md-8 mt-2">
                            <div class="card-body m-2">
                                <a href="/searchlist/detail/{{ $items[0]->id }} " class="card-title fs-5 fw-bold text-decoration-none">{{ $items[0]->item_name }}</a>
                                <div class="mt-2">
                                    <li>名称：{{ $items[0]->name }}</li>
                                    <li>登録日：{{ $items[0]->created_at->format('Y年n月j日') }}</li>
                                    <li>カテゴリ：@if($items[0]->type==1)事務機器
                                                    @elseif($items[0]->type==2)インク・トナー・コピー用紙
                                                    @elseif($items[0]->type==3)パソコン・周辺機器
                                                    @elseif($items[0]->type==4)文房具
                                                    @elseif($items[0]->type==5)オフィス家具・収納
                                                    @elseif($items[0]->type==6)その他
                                                @endif</li>
                                    <li>価格：{{ number_format($items[0]->price) }}円</li>
                                    <li>数量：{{ $items[0]->quantity}}</li>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-7">
            <div class="card-header">
                <h6 class="card-title"><span class=text-secondary>▶︎</span> 新着一覧</h6>
            </div>
            <table class="table table-sm" style="width: 40em;">
                <thead>
                    <tr>
                        <th scope="col" class="fw-normal text-secondary">登録日</th>
                        <th scope="col" class="fw-normal text-secondary">品名</th>
                        <th scope="col" class="fw-normal text-secondary">カテゴリ</th>
                        <th scope="col" class="fw-normal text-secondary">価格</th>
                        <th scope="col" class="fw-normal text-secondary">在庫数</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($items->count() == 0)
                    @else
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->created_at->format('Y.n.j') }}</td>
                            <td><a href="/items/detail/{{ $item->id }}" class="fw-bold text-decoration-none link-dark"><span class="d-inline-block text-truncate" style="max-width: 220px;">{{ $item->name }} </span></a></td>
                            <!-- <td class="fw-bold">{{ $item->item_name }} </td> -->
                            <td>@if($item->type==1)事務機器
                                    @elseif($item->type==2)インク・トナー・コピー用紙
                                    @elseif($item->type==3)パソコン・周辺機器
                                    @elseif($item->type==4)文房具
                                    @elseif($item->type==5)オフィス家具・収納
                                    @elseif($item->type==6)その他
                                @endif
                            </td>
                            <td>{{ number_format($item->price) }} 円</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>


    <div class="contents2" style="margin: 5px; padding: 20px 10px;">
        <div class="card-header">
            <h6 class="card-title"><span class=text-secondary>▶︎</span> お知らせ</h6>
            <div class="card-tools">
                <div class="input-group input-group-sm">
                    @can('admin')
                    <div class="input-group-append">
                        <a href="{{ url('notificationadd') }}" class="btn btn-default">お知らせ登録</a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="card border-light" style="width: 25em;">
            <div class="card-body m-2">
                <div class="row">
                    <div class="col">
                    @if ($notifications->count() == 0)
                    @else
                    @foreach($notifications as $notification)
                        <tr>
                            <div class="border-bottom border-secondary" style="max-width: 500px;">
                                <td>{{ $notification->created_at->format('Y.n.j') }}</td><br>
                                <td>{{ $notification->notification }}</td>
                                <td>
                                    @can('admin')
                                    <a href="/notification/{{$notification->id}}">>>編集</a>
                                    @endcan
                                </td>
                            </div>
                        </tr>
                    @endforeach
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
</body>
</html>

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
