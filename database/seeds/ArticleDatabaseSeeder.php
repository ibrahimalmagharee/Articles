<?php

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Article::class, 100)->create();
    }
}
