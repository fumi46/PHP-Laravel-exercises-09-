@extends('layouts.front')  <!-- 閲覧者用索引view -->

@section('content')
    <div class="container">
        <hr color="#c0c0c0">
        @if (!is_null($headline))  <!-- headline にデータがあれば -->
            <div class="row">
                <div class="headline col-md-10 mx-auto">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="name p-2">
                               <h1>{{ str_limit($headline->name, 20) }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="gender p-2">
                               <h1>{{ str_limit($headline->gender, 10) }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hobby p-2">
                               <h1>{{ str_limit($headline->hobby, 30) }}</h1>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="hobby p-2">
                               <h1>{{ str_limit($headline->home, 10) }}</h1>
                            </div>
                        </div>
                         <div class="col-md-6">
                            <p class="introduction mx-auto">{{ str_limit($headline->introduction, 150) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <hr color="#c0c0c0">
        <div class="row">
            <div class="posts col-md-8 mx-auto mt-3">
                @foreach($posts as $post)
                    <div class="post">
                        <div class="row">
                            <div class="text col-md-6">
                                <div class="date">
                                    {{ $post->updated_at->format('Y年m月d日') }}  <!-- フォーマット作成。この場合は、見やすい日付のフォーマットを作る。 -->
                                </div>
                                <div class="name">
                                    {{ str_limit($post->name, 20) }}
                                </div>
                                <div class="gender mt-3">
                                    {{ str_limit($post->gender, 10) }}
                                </div>
                                <div class="hobby mt-3">
                                    {{ str_limit($post->hobby, 30) }}
                                </div>
                                 <div class="hobby mt-3">
                                    {{ str_limit($post->home, 10) }}
                                </div>
                                <div class="introduction mt-3">
                                    {{ str_limit($post->introduction, 150) }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr color="#c0c0c0">
                @endforeach
            </div>
        </div>
    </div>
    </div>
@endsection