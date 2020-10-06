<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyNews</title>
</head>
<body><!-- 最終的に表示する画面の作成 -->
    {{-- layouts/admin.blade.phpを読み込む --}}<!-- layoutsのadmin.blade.phpファイルの使用-->
    @extends('layouts.admin')
    
    {{-- admin.blade.phpの@yield('title')に'ニュースの新規作成'を埋め込む --}}
    @section('title', 'ニュースの新規作成')
    
    {{-- admin.blade.phpの@yield('content')に以下のタグを埋め込む --}}
    @section('content')
     <div class="container">
         <div class="row">
             <div class="col-md-8 mx-auto">
                 <h2>ニュース新規作成</h2>
             </div>
         </div>
     </div>
     @endsection
</body>
</html>