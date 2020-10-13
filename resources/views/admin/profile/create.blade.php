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
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール(profile)</h2> <!--PHP13課題4 フォーム送信先指定。-->
                <form action="{{ action('Admin\Profilecontroller@create') }}" method="post" enctype="multipart/form-data">

                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <!-- PHP14課題5-->
                    <div class="form-group row">
                        <label class="col-md-2" for="name">名前(name)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="gender">性別(gender)</label>
                        <div class="col-md-10">
                            <!-- プルダウンのとき
                            　　<select type="text" class="form-control" name="gender">
                                <option value="n" selected>未選択</option>
                                <option value="f">女</option>
                                <option value="m">男</option>
                                </select>-->
                                
                            <!-- ボタン選択のとき -->
                                <input id="non" name="gender" type="radio" value="1"><label for="non">未選択</label>
                                <input id="female" name="gender" type="radio" value="2"> <label for="female">女</label>
                                <input id="male" name="gender" type="radio" value="3"> <label for="male">男</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="hobby">趣味(hobby)</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2" for="introduction">自己紹介(introduction)</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <input type="submit" class="btn btn-primary" value="更新">
                </form>
            </div>
        </div>
    </div> 
    @endsection
</body>
</html>