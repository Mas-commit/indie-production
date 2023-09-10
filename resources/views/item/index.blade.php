@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <!-- 検索機能 -->
                        <span>商品検索：</span>
                        <div style="display: inline-block; _display: block;">
                            <form method="get" action="/search" class="form-inline">
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" style="max-width:400px;" value="@if (isset( $keyword )) {{request()->keyword}} @endif" placeholder="キーワードを入力">
                                    <input type="submit" value="検索" class="btn btn-secondary">
                                </div>
                            </form>
                        </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>価格</th>
                                <th>編集</th>
                                <th>詳細情報</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <th>
                                        @if($item->type==1)事務機器
                                        @elseif($item->type==2)インク・トナー・コピー用紙
                                        @elseif($item->type==3)パソコン・周辺機器
                                        @elseif($item->type==4)文房具
                                        @elseif($item->type==5)オフィス家具・収納
                                        @elseif($item->type==6)その他
                                        @endif
                                    </th>
                                    <th><?php $price = $item->price; echo number_format($price);?> 円</th>
                                    <th scope="col"><a href="/items/edit/{{$item->id}}"><button type="button" class="btn btn-secondary">編集</button></a></th>
                                    <th scope="col"><a href="/items/detail/{{$item->id}}"><button type="button" class="btn btn-dark">詳細</div></button></a>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{$items->appends(request()->query())->links()}}
@stop

@section('css')
@stop

@section('js')
@stop
