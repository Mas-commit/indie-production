<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('adminlte::page')
    @section('title', '備品詳細')
    @section('content_header')
        <h1>備品詳細</h1>
    @stop

    <title>備品詳細画面</title>
</head>
<body>
@section('content')
    <div class="container" style="margin-top: 5px;">
        <div class="row">
            <div class="col-4">
                @if(isset($items->image))
                <img src="data:image/png;base64, {{ $items->image }}" alt="商品画像" class="form-control img-fluid border-secondary" style="width: 500px; height: 500px;">
                @else
                <img src="/images/noimage.jpg" alt="" style="width:500px;">
                @endif
                <br>
            </div>
            <div class="col-8">
                <div class="border-bottom border-secondary" style="max-width: 500px;">
                    <p style="font-size: 25px; font-weight:bold;">{{$items->name}}</p>
                </div><br>
                <div class="border-bottom border-secondary" style="max-width: 500px;">
                    【　価格　】<br>
                    <ul style="list-style: none;">
                        <?php
                            $price = $items->price;
                            echo number_format($price);
                            echo " 円"
                        ?>
                    </ul>
                </div><br>
                <div class="border-bottom border-secondary" style="max-width: 500px;">
                    【　商品情報　】<br>
                    <ul style="list-style: none;">
                        <li>カテゴリ：@if($items->type==1)事務機器
                                @elseif($items->type==2)インク・トナー・コピー用紙
                                @elseif($items->type==3)パソコン・周辺機器
                                @elseif($items->type==4)文房具
                                @elseif($items->type==5)オフィス家具・収納
                                @elseif($items->type==6)その他
                                @endif</li>
                        <li>商品登録日：@if(!empty($items->created_at)) {{$items->created_at->format('Y年 n月 j日 h時 m分')}} @else 未登録 @endif</li>
                        <li>商品更新日：@if(!empty($items->updated_at)) {{$items->updated_at->format('Y年 n月 j日 h時 m分')}} @else 未登録 @endif</li>
                    </ul>
                </div><br>
                <div class="border-bottom border-secondary" style="max-width: 500px;">
                    【　詳細情報　】<br>
                    <ul style="list-style: none; white-space: pre-line">
                        <li>{{$items->detail}}</li>
                    </ul>
                </div><br>
                <a href="/items" class="link-secondary">商品一覧へ戻る</a>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
</body>
</html>