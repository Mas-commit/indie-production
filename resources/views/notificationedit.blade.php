<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @extends('adminlte::page')
    @section('title', 'お知らせ編集')
</head>

@section('content_header')
    <h1>お知らせ編集</h1>
@stop

@section('content')
<body>
    <div class="card card-primary">
        <form class="input-area text-left mt-4" action="{{ url('notification/editor') }}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            @csrf
            <input type="hidden" name="id" value="{{$notification->id}}">
            <div class="card-body">
                <div class="form-group">
                    <label for="notification">お知らせを編集</label>
                    <textarea name="notification" id="notification" cols="30" rows="10" class="form-control">{{ old('notification',$notification->notification) }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-secondary">編集確定</button>
            </div>
        </form>
    </div>
@stop
</body>
</html>

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop