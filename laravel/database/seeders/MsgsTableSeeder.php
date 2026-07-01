<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsgsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('msgs')->truncate();

         $msgs = [
              ['msg' => 'PHP Book',
              'path' => null],
              ['msg' => 'Laravel Book',
              'path' => null],
              ['msg' => 'Ruby Book',
              'path' => null]
             ];

    // 登録
    foreach($msgs as $msg) {
      \App\Models\Msg::create($msg);
    }
    }
    
}
