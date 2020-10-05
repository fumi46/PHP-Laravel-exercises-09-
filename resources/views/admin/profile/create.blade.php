<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>profile</title>
</head>
<body>
    <!-- PHP11課題4 -->
    @extends('layouts.profile')         <!-- layouts/profile.blade.phpを読み込む -->
    @section('title', 'プロフィール')  <!-- profile.blade.phpの@yield('title')に'プロフィール'を埋め込む -->
    @section('content')                <!-- profile.blade.phpの@yield('content')に以下のタグを埋め込む -->
    <h2>プロフィール作成</h2>
    　<p>項目</p>
    　 <ul>
    　     <li>名前</li>
    　     <li>年齢</li>
    　 </ul>
    @endsection
</body>
</html>