@extends('adminlte::page')

@section('title', '備品登録')

@section('content_header')
    <h1>備品登録</h1>
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
                <form class="input-area text-left mt-4" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="名前">
                        </div>

                        <div class="form-group">
                            <label for="type">カテゴリ</label>
                            <select name="type" id="type" value="{{ old('type') }}" class="form-control"  placeholder="カテゴリ">
                                <option value=""></option>
                                <option value="1" @if(old('type')==1) selected @endif>事務機器</option>
                                <option value="2" @if(old('type')==2) selected @endif>インク・トナー・コピー用紙</option>
                                <option value="3" @if(old('type')==3) selected @endif>パソコン・周辺機器</option>
                                <option value="4" @if(old('type')==4) selected @endif>文房具</option>
                                <option value="5" @if(old('type')==5) selected @endif>オフィス家具・収納</option>
                                <option value="5" @if(old('type')==6) selected @endif>その他</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price">単価</label>
                            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}" placeholder="単価">
                        </div>

                        <div class="form-group">
                            <label for="quantity">在庫数</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity') }}" placeholder="在庫数量に入庫数量を足した値を入力">
                        </div>

                        <div class="form-group">
                            <label for="minquantity">必要在庫数</label>
                            <input type="text" class="form-control" id="minquantity" name="minquantity" value="{{ old('minquantity') }}" placeholder="最低限必要な在庫数量を入力">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">{{ old('detail') }}</textarea>
                        </div>

                        <div class="form-group"> 
                            <label for="image">画像</label>
                            <input type="file" name="image" id="image" class="form-control" accept="image/jpeg, image/png">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-secondary">登録</button>
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
