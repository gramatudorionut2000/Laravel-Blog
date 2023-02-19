<?php

namespace Database\Seeders;

use App\Models\Article;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles=[
            [
                'title' =>'Article one',
                'content' =>'Content of Article one',
                'is_approved' =>false,
            ],
            [
                'title' =>'Article two',
                'content' =>'Content of Article two',
                'is_approved' =>false,
            ]
        ];

        foreach($articles as $key=>$value){
            Article::create($value);
        }
    }
}
