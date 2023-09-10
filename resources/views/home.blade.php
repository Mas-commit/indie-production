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

    @section('title', 'Dashboard')

</head>

<body>
    @section('content_header')
        <h1>Dashboard</h1>
    @stop
    @section('content')
        <p>Welcome to this beautiful admin panel.</p>

    <div class="col-lg-7">

        <h6>新規登録商品</h6>
        <table class="table table-sm">
            <thead>
                <tr>
                <th scope="col" class="fw-normal">登録日</th>
                <th scope="col" class="fw-normal">商品名</th>
                <th scope="col" class="fw-normal">カテゴリ</th>
                <th scope="col" class="fw-normal">数量</th>
                <th scope="col" class="fw-normal">価格</th>
                </tr>
            </thead>
        </table>
    </div>
    @stop
</body>
</html>

    @section('js')
        <script> console.log('Hi!'); </script>
    @stop
