<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('adminlte::page')
    @section('title', '備品編集')
</head>

@section('content_header')
    <h1>備品編集</h1>
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
                <form class="input-area text-left mt-4" action="{{ url('items/editor') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                @csrf
                <input type="hidden" name="id" value="{{$item->id}}">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名称</label>
                            <input type="text" class="form-control" id="name" value="{{ old('name',$item->name) }}" name="name" placeholder="品名">
                        </div>

                        <div class="form-group">
                            <label for="type">カテゴリ</label>
                            <select name="type" id="type"  class="form-control">
                                <option value=""></option>
                                <option value="1" @if(1== old('type',$item->type)) selected @endif>事務機器</option>
                                <option value="2" @if(2== old('type',$item->type)) selected @endif>インク・トナー・コピー用紙</option>
                                <option value="3" @if(3== old('type',$item->type)) selected @endif>パソコン・周辺機器</option>
                                <option value="4" @if(4== old('type',$item->type)) selected @endif>文房具</option>
                                <option value="5" @if(5== old('type',$item->type)) selected @endif>オフィス家具・収納</option>
                                <option value="6" @if(6== old('type',$item->type)) selected @endif>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">単価</label>
                            <input type="text" class="form-control" id="price" value="{{ old('price',$item->price) }}" name="price" placeholder="単価">
                        </div>

                        <div class="form-group">
                            <label for="quantity">在庫数量</label>
                            <input type="text" class="form-control" id="quantity" value="{{ old('quantity',$item->quantity) }}" name="quantity" placeholder="在庫数量に入庫数量を足した値を入力">
                        </div>

                        <div class="form-group">
                            <label for="minquantity">必要在庫数量</label>
                            <input type="text" class="form-control" id="minquantity" value="{{ old('minquantity',$item->minquantity) }}" name="minquantity" placeholder="最低限必要な在庫数量を入力">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">{{ old('detail',$item->detail) }}</textarea>
                        </div>

                        <div> 
                            <label for="image">画像</label>
                            <div class="image-view">
                                @if(isset($item->image))
                                <img src="data:image/png;base64, {{ $item->image }}" alt="画像" class="img-fluid">
                                @else
                                <p>画像は登録されていません</p>
                                @endif
                                <input type="file" name="image" id="image" class="form-control" accept="image/jpeg, image/png">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">編集確定</button>
                    </div>
                </form>
                <div class="container" style="display: flex; margin: 0px 10px; text-align:right;">
                <form class="mt-3" action="{{ url('items/imagedelete') }}" method="POST" style="text-align:right; margin: 0px 10px;">
                {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}" >
                    <button class="btn btn-danger">画像を削除する</button>
                </form>
                <form class="text-center mt-3" action="{{ url('items/itemdelete') }}" method="POST" style="text-align:right; margin: 0px 10px;">
                {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{ $item->id }}" >
                    <button class="btn btn-danger">備品を削除する</button>
                </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop