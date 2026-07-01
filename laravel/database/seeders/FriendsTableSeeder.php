<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('friends')->truncate();

        $friends = [
              ['user_id' => 1,
              'msg_id' => 1,
              'fri_id' => 2],
              ['user_id' => 2,
              'msg_id' => 2,
              'fri_id' => 1],
              ['user_id' => 1,
              'msg_id' => 3,
              'fri_id' => 2]
             ];
        foreach($friends as $friend) {
        \App\Models\Friend::create($friend);
    }
    }
}
