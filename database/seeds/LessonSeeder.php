<?php

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quots01['name'] = [
            'en' => 'It’s not about ideas. It’s about making ideas happen.',
            'ar' => 'الأمر لا يتعلق بالافكار إنه حول جعل الأفكار تحدث.',
        ];

        $quots02['name'] = [
            'en' => 'It’s not about ideas. It’s about making ideas happen.',
            'ar' => 'الأمر لا يتعلق بالافكار إنه حول جعل الأفكار تحدث.',
        ];
        
        $quots03['name'] = [
            'en' => 'It’s not about ideas. It’s about making ideas happen.',
            'ar' => 'الأمر لا يتعلق بالافكار إنه حول جعل الأفكار تحدث.',
        ];

        Lesson::create($quots01);
        Lesson::create($quots02);
        Lesson::create($quots03);
    }
}