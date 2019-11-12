<?php

use Illuminate\Database\Seeder;
// use=repuire_once
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DiariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //配列でサンプルデータを作成
        $dairies = [
            [
                'title' =>'初めてのララベル',
                'body' => '難しいなぁ'
            ],
            [
                'title' => '初めてのセブ',
                'body' => '渋滞がぱねー'
            ],
            [
                'title' =>'セブ旅行',
                'body' => '海綺麗'
            ]
            ];
        //配列をループで回して、テーブルにINSERTする
        foreach ($dairies as $diary) {
            DB::table('diaries')->insert([
            'title' => $diary['title'],
            'body' => $diary['body'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            //Carbon::now() 現在時刻
            ]);
    }
}
}