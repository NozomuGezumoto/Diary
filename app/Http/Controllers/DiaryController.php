<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

use App\Http\Requests\CreateDiary;

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

        // DBに保存
        $diary->save();

        // 一覧ページにリダイレクト
        return redirect()->route('diary.index');
        // return view('diaries.create');二重投稿が起こる
    }
}
