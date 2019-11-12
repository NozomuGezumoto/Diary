<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Diary;

class DiaryController extends Controller
{
    //
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
}
