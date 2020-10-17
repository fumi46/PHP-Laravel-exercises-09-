<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;  //Profileモデルの使用
use App\ProfileHistory;  //ProfileHistoryモデルの使用
use Carbon\Carbon; //現在時刻の取得

class Profilecontroller extends Controller
{
    //課題５
    public function add()
    {
        return view('admin.profile.create');
    }
    
    //PHP14課題5  作成アクション
    public function create(Request $request) //Requestに依存
    {
      // Validationを行う
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
    
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
     
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
      
      return redirect('admin/profile/create');
    }
    
    //PHP16課題  編集アクション
    public function edit(Request $request)
    {
        // Modelからデータを取得。
      $profile = Profile::find($request->id);
      
      //dd($profile); //デバッグ
      
      if (empty($profile)) {
        abort(404);    
      }
        // view への指示。
      return view('admin.profile.edit', ['profile_form' => $profile]);
      
    }
    
    //PHP16課題  更新アクション
    public function update(Request $request)
    {
        // Validation
      $this->validate($request, Profile::$rules);
      // Modelからデータを取得。
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する。request の中の全てのデータをprofile_form に代入。
      $profile_form = $request->all();
      
      unset($profile_form['_token']);
      unset($profile_form['remove']);
      $profile->fill($profile_form)->save();  //profile レコードに、ふるいにかけたprofile_form を代入し（profile のレコードをprofile_form レコードにして）、保存。

      $profile_history = new ProfileHistory;
      $profile_history->profile_id = $profile->id;
      $profile_history->edited_at = Carbon::now();  //現在時刻をedited_atカラムに保存
      $profile_history->save();
      
      // view への指示。
      return redirect('admin/profile/');
    }
    
      // 索引表示アクション
    public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('name', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }
    
    //PHP16課題  削除アクション
    public function delete(Request $request)
    {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
    }
}