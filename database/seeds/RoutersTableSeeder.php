<?php

use Illuminate\Database\Seeder;

class RoutersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($limit)
    {
        for($i=0;$i<$limit;$i++){
            DB::table('routers')->insert([
                'ip' => long2ip(mt_rand()),
                'sapid' => Str::random(10).'1b1',
            ]);
        }
    }
}
