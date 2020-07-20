<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $tags = ['PHP', 'Laravel', 'Bootstrap', 'CSS', 'JS', 'HTML', 'Vue', 'React'];

        foreach ($tags as $tag) {
            DB::table('tags')->insert(['name' => $tag]);
        }
    }
}
