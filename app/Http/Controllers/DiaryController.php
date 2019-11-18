<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

use App\Http\Requests\CreateDiary;

use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    //一覧画面を表示する
    public function index()
    {
        // diariesテーブルのデータを全件取得
        //取得した結果を画面で確認

        $diaries = Diary::all();
        // dd($diaries);
        //dd() : var_dump と die が同時に実行される
        //
        //view/diaries/index.phpを表示
        // フォルダ名.ファイル名(blade.phpは除く)
        return view('diaries.index', [
            //キー => 値
            'diaries' => $diaries
        ]);
    }
    //日記の作成画面を表示する
    public function create()
    {
        return view('diaries.create');
    }
    //新しい日記の保存をする画面
    public function store(CreateDiary $request)
    {
        // Diaryモデルのインスタンスを作成
        $diary = new Diary();

        // Diaryモデルを使って、Dbに日記を保存
        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->user_id = Auth::user()->id;

        // DBに保存
        $diary->save();

        // 一覧ページにリダイレクト
        return redirect()->route('diary.index');
        // return view('diaries.create');二重投稿が起こる
    }
//日記を削除するためのメソッド
    public function destroy(int $id)
    {
        //diaryモデルをしようして、IDが一致する日記の取得
        $diary = Diary::find($id);

        //取得した日記の削除
        $diary->delete();

        //一覧画面にリダイレクト
        return redirect()->route('diary.index');

    }
    //編集画面を表示する
    public function edit(int $id)
    {
        // dd($id);
        //受け取ったIDを元に日記を取得
        $diary = Diary::find($id);

        //編集画面を返す。同時に画面に取得した日記を渡す

        return view('diaries.edit',['id' => $diary->id], [
            //キー => 値
            'diary' => $diary
        ]);

    }
    //日記を更新し、一覧画面にリダイレクトする
    // $id :  編集対象の日記のID
    // $request : リクエストの内容。ここに画面で入力された文字が格納されている。
    public function update(int $id, CreateDiary $request)
    {
        //受け取ったIDを元に日記を取得
        $diary = Diary::find($id);
        //取得した日記のタイトル、本文を書き換える

        $diary->title = $request->title;
        $diary->body = $request->body;
        //DBに保存
        $diary->save();
        //一覧ページにリダイレクト
        return redirect()->route('diary.index');
    }
}
