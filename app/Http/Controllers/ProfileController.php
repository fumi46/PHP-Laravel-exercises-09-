<?php

namespace App\Http\Controllers;  //閲覧者用controller

use Illuminate\Http\Request;
use Illuminate\Support\Facades\HTML;
use App\Profile;

class ProfileController extends Controller
{   // 索引アクション
    public function index(Request $request)
    {
        $posts = Profile::all()->sortByDesc('updated_at'); //newsテーブルの全ての情報を取得して、投稿日時順に新しい方からに並べ換える。

        if (count($posts) > 0) {  //投稿があれば。
            $headline = $posts->shift();  //shift メソッド = 配列の最初のデータを返し、配列からは削除する。$headline には最新記事が、$posts には最新記事以外の記事が格納されることになる。
        } else {
            $headline = null;
        }

        // profile/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('profile.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
