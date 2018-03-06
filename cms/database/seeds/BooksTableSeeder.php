<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create('ja_JP');
        for($i =0; $i<10; $i++){
        App\Book::create([
            'item_name' => $faker->word(),// 文字 列 
            'item_number' => $faker->numberBetween(1, 999), //1 〜 999
            'user_id' => $faker->numberBetween(1,3),
            'item_amount' => $faker->numberBetween(100, 5000), //100 〜 5000 
            'published' => $faker->dateTime('now'),// 現 在 まで YmdHis 
            'created_at' => $faker->dateTime('now'),// 現 在 まで YmdHis 
            'updated_at' => $faker->dateTime('now'),//
        ]);
    }
    }
}
