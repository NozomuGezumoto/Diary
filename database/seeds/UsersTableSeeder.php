<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'test',
            'email' => 'test@examle.com',
            'password' => bcrypt('123456'), //bcrypy暗号化
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
