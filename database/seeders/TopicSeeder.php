<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $topics = [
            [
                'name'=>'Vuejs',
                'image_url'=>'images/vuejs.png',
                'description'=>'Vue is a progressive framework for building user interfaces.'
            ],
            [
                'name'=>'Mysql',
                'image_url'=>'images/mysql.png',
                'description'=>'MySQL is an open-source relational database management system (RDBMS)',
            ],
            [
                'name'=>'Javascript',
                'image_url'=>'images/javascript.png',
                'description'=> "JavaScript is the world's most popular programming language.",
            ],
            
            [
                'name'=>'Laravel',
                'image_url'=>'images/laravel.png',
                'description'=>'Laravel is a web application framework with expressive, elegant syntax'
            ],
            [
                'name'=>'Design Patterns',
                'image_url'=>'images/dp.png',
                'description'=>'a design pattern is a general repeatable solution to a commonly occurring problem in software design.'
            ],
            [
                'name'=>'Algorithms',
                'image_url'=>'images/algorithm.png',
                'description'=>'a process or set of rules to be followed in calculations or other problem-solving operations, especially by a computer.',
            ],
            [
                'name'=>'php',
                'image_url'=>'images/php.png',
                'description'=>'PHP is a popular general-purpose scripting language that is especially suited to web development.'
            ],
            [
                'name'=>'Mathematics',
                'image_url'=>'images/math.png',
                'description'=> 'Mathematicians seek and use patterns to formulate new conjectures; they resolve the truth or falsity'
            ],
            [
                'name'=>'Sass',
                'image_url'=>'images/sass.png',
                'description'=>'Sass is the most mature, stable, and powerful professional grade CSS extension language in the world.'
            ]
        ];

        $i=1;
        foreach ($topics as $topic) {
            Topic::create(array_merge($topic, [
                'order'=>$i
            ]));
            $i++;
        }
    }
}
