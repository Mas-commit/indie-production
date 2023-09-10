@extends('adminlte::page')

@section('title', '商品登録')

@section('content_header')
    <h1>商品編集</h1>
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
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">品名</label>
                            <input type="text" class="form-control" id="name" value="{{ old('name',$items->name) }}" name="name" placeholder="品名">
                        </div>

                        <div class="form-group">
                            <label for="type">カテゴリ</label>
                            <select name="type" id="type"  class="form-control">
                                <option value=""></option>
                                <option value="1" @if(1== old('type',$items->type)) selected @endif>事務機器</option>
                                <option value="2" @if(2== old('type',$items->type)) selected @endif>インク・トナー・コピー用紙</option>
                                <option value="3" @if(3== old('type',$items->type)) selected @endif>パソコン・周辺機器</option>
                                <option value="4" @if(4== old('type',$items->type)) selected @endif>文房具</option>
                                <option value="5" @if(5== old('type',$items->type)) selected @endif>オフィス家具・収納</option>
                                <option value="6" @if(6== old('type',$items->type)) selected @endif>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">単価</label>
                            <input type="text" class="form-control" id="price" value="{{ old('price',$items->price) }}" name="price" placeholder="単価">
                        </div>

                        <div class="form-group">
                            <label for="quantity">数量</label>
                            <input type="text" class="form-control" id="quantity" value="{{ old('quantity',$items->quantity) }}" name="quantity" placeholder="在庫数量に入庫数量を足した値を入力">
                        </div>

                        <div class="form-group">
                            <label for="minquantity">必要在庫数量</label>
                            <input type="text" class="form-control" id="minquantity" value="{{ old('minquantity',$items->minquantity) }}" name="minquantity" placeholder="最低限必要な在庫数量を入力">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">{{ old('detail',$items->detail) }}</textarea>
                        </div>

                        <div class="form-group"> 
                            <label for="image">画像</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg, image/png">
                        </div>
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