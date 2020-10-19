<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //controller.phpの呼び出し
use App\News;  //Newsモデルの使用
use App\History;  //Historyモデルの使用
use Carbon\Carbon; 
use Storage;

class NewsController extends Controller  // news に関する物を作成する。
{
  public function add()
  {
      return view('admin.news.create');
  }
  
  //create(初回作成)アクション
  public function create(Request $request) //Requestクラスで、ブラウザを通してユーザーから送られる情報をすべて含んでいるオブジェクトを取得。それらを$requestへ代入。
  {
      // Varidationを行う
      $this->validate($request, News::$rules); //$this = 疑似変数。呼び出し元のオブジェクトへの参照。
                                               //validate = Controller.phpのValidateRequestsのトレイトのメソッドで宣言されている。
                                               //News::$rules = News.phpの$rules変数を呼び出す。
                                               //News::$rulesを基に$form で判定されたデータに問題があるならエラーメッセージと入力値とともに直前のページに戻る。
      $news = new News; //Newsモデルに新しいレコードを生成。
      $form = $request->all(); //$request 内の全てのデータを$form に代入する。
     
     // modelへの指示
     // フォームから画像が送信されてきたら($form に画像があれば)、保存して、$news->image_path に画像のパスを保存する
     if (isset($form['image'])) {                               // formに画像があれば保存。（issetメソッド = 引数の中にデータがあるかないかを判断する。）
        //$path = $request->file('image')->store('public/image'); //画像をアップロードするメソッド。
        $path = Storage::disk('s3')->putFile('/', $form['image'], 'public'); //AWS S3への画像のアップロード。
        //$news->image_path = basename($path); //ハッシュ化されたファイル名を取得し、image_pathに代入。
        $news->image_path = Storage::disk('s3')->url($path);  //AWS S3への画像の保存。
      } else {
          $news->image_path = null;  //Newsテーブルの新しいレコードのimage_pathカラムにnullを代入。
      }
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);  //token = 何らかの証や印になるデータ。データの最小構成単位
      // フォームから送信されてきたimageを削除する
      unset($form['image']);
      
      // データベースに保存する
      $news->fill($form);  //新しいnewsレコードにはtitleとbodyとimage_pathが残る。
      $news->save();  //新しいレコードの保存。
      
      // viewへの指示
      return redirect('admin/news/create');
  }
  
  // index(索引参照) アクション
  public function index(Request $request)
  {
      //modelからデータを取得。
      $cond_title = $request->cond_title;  //検索機能。$requestの一つであるcond_title（という名前の検索窓にユーザーが入力した値）を、$cond_titleという変数に代入する。
      if ($cond_title != '') {             //検索欄が空欄で無ければ。
          // 検索結果を取得する
          $posts = News::where('title', $cond_title)->get();  //whereメソッド。Newsモデル（レコード）のtitleカラムの中で、検索された文字（$cond_title）と一致するレコードを全て取得。
      } else {                             //検索欄が空欄ならば。
          // すべてのニュースを取得する
          $posts = News::all();  //Newsモデルの中の全てのレコードを取得して、$postsに代入。
      }
      // view への指示。
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);  //$posts = レコード, $cond_title = 検索文字 をindex.blade.php(view)に渡してページを開く。
  }
  
  // edit(編集) アクション
  public function edit(Request $request)
  {
      // Modelからデータを取得。
      $news = News::find($request->id);
      if (empty($news)) {
        abort(404);    
      }
      // view への指示。
      return view('admin.news.edit', ['news_form' => $news]);
  }

  // update アクション（編集画面から送信されたフォームデータを処理。内部処理）
  public function update(Request $request)
  {
      // Validation
      $this->validate($request, News::$rules);
      // Modelからデータを取得。
      $news = News::find($request->id);
      // 送信されてきたフォームデータを格納する。request の中の全てのデータをnews_form に代入する。
      $news_form = $request->all();
      // 画像変更
      if ($request->remove == 'true') {                             //編集によって削除されたら
            $news_form['image_path'] = null;                          //送信された news_form の image_path に null に代入。
        } elseif ($request->file('image')) {                        //編集によって画像が添付されたら
            //$path = $request->file('image')->store('public/image');   //画像のアップロード
            $path = Storage::disk('s3')->putFile('/', $form['image'], 'public'); //AWS S3への画像のアップロード。
            //$news_form['image_path'] = basename($path);               //ハッシュ化されたファイル名を取得し、image_pathに代入。
            $news->image_path = Storage::disk('s3')->url($path);  //AWS S3への画像の保存。
        } else {                                                    //何も操作されないなら
            $news_form['image_path'] = $news->image_path;             //そのまま
        }
        
      unset($news_form['_token']);
      unset($news_form['image']);
      unset($news_form['remove']);
      
      // 該当するデータを上書きして保存する
      $news->fill($news_form)->save();  //新しいnews レコードに、残ったnews_formを代入して、保存。
      
      $history = new History; // histoty テーブルに新しいレコードを生成。
      $history->news_id = $news->id; //history テーブルのnews_id とnews テーブルのid が等しい（結びつく）。
      $history->edited_at = Carbon::now(); //日付操作ライブラリ。編集時刻（現在時刻）をedited_atカラムに保存する。
      $history->save();

      // view への指示。
      return redirect('admin/news/');
  }
  
  // delete(削除) アクション
  public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $news = News::find($request->id);
      // 削除する
      $news->delete();
      return redirect('admin/news/');
  }
}