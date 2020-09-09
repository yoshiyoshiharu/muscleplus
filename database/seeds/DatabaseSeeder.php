<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $tags = ['背中', '肩', '胸部', '腕' , '腹筋' , '脚'];
          foreach ($tags as $tag){
            DB::table('tags')->insert([
              'name' => $tag
            ]);
          }

    }
}
