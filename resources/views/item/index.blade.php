@extends('adminlte::page')

@section('title', '備品一覧')

@section('content_header')
    <h1>備品一覧</h1>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">備品一覧</h3>
                    <!-- 検索機能 -->
                        <span>商品検索：</span>
                        <div style="display: inline-block; _display: block;">
                            <form method="get" action="/search" class="form-inline">
                            {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" name="keyword" class="form-control" style="max-width:400px;" value="@if (isset( $keyword )) {{request()->keyword}} @endif" placeholder="キーワードを入力">
                                    <input type="submit" value="検索" class="btn btn-secondary">
                                </div>
                            </form>
                        </div>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            @can('admin')
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">備品登録</a>
                            </div>
                            @endcan
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
                                <th>在庫数 / 必要在庫</th>
                                @can('admin')
                                <th>編集</th>
                                @endcan
                                <!-- @can('general')
                                <th>在庫数編集</th>
                                @endcan -->
                                <th>詳細情報</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <th>
                                        @foreach(config('const.types') as $value => $label)
                                        {{ $item->type == $value ? $label : ""}}
                                        @endforeach
                                    </th>
                                    <th><?php $price = $item->price; echo number_format($price);?> 円</th>
                                    <th>{{ $item->quantity }} / {{ $item->minquantity }}</th>
                                    @can('admin')
                                    <th scope="col"><a href="/items/edit/{{$item->id}}"><button type="button" class="btn btn-secondary">編集</button></a></th>
                                    @endcan
                                    <!-- @can('general')
                                    <th scope="col"><a href="/items/qtyedit/{{$item->id}}"><button type="button" class="btn btn-secondary">編集</button></a></th>
                                    @endcan -->
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
