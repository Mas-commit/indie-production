<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('adminlte::page')
    @section('title', '在庫数編集')
</head>

@section('content_header')
    <h1>在庫数編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                       @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                       @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form class="input-area text-left mt-4" action="{{ url('items/qtyedit') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                        <p style="font-size: 25px; font-weight:bold;">名称：{{$item->name}}</p><br>
                        <ul style="list-style: none;">
                        <label for="price">価格：
                        <?php
                            $price = $item->price;
                            echo number_format($price);
                            echo " 円"
                        ?></label>
                        <br>
                        <label for="type">カテゴリ：@if($item->type==1)事務機器
                                @elseif($item->type==2)インク・トナー・コピー用紙
                                @elseif($item->type==3)パソコン・周辺機器
                                @elseif($item->type==4)文房具
                                @elseif($item->type==5)オフィス家具・収納
                                @elseif($item->type==6)その他
                                @endif</label>
                        <br><br>
                        <div class="form-group">
                            <label for="quantity" style="color: red;">※ 在庫数量</label>
                            <input type="text" class="form-control" id="quantity" value="{{ old('quantity',$item->quantity) }}" name="quantity" placeholder="在庫数量に入庫数量を足した値を入力">
                        </div>
                        <label for="minquantity">必要在庫数量：{{$item->minquantity}}</label>
                        <br><br>
                        <label for="detail">詳細情報：{{$item->detail}}</li>
                        <br>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">編集確定</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop