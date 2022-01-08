<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use \App\Models\User;
use \App\Models\University;
use \App\Models\Field;
use \App\Models\Year;
use \App\Models\Subject;
use \App\Models\Note;
use \App\Models\Exam;
use \App\Models\File;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(100)->create();
        University::factory(2)->create();
        Field::factory(4)->create();
        Year::factory(8)->create();
        Subject::factory(16)->create();
        Note::factory(300)->create();
        Exam::factory(320)->create();
        File::factory(300)->create();

        

        $users = User::all();
        $universities = University::all();
        $fields = Field::all();
        $years = Year::all();
        $subjects = Subject::all();
        $notes = Note::all();
        $exams = Exam::all();
        $files = File::all();


        foreach($fields as $field){
            $field->university_id=$universities->random()->id;
            $field->save();
        }

        foreach($years as $year){
            $year->field_id=$fields->random()->id;
            $year->save();
        }

        foreach($subjects as $subject){
            $subject->year_id=$years->random()->id;
            $subject->save();
        }


        foreach($exams as $exam){
            $exam->subject_id=$subjects->random()->id;
            $exam->user_id=$users->random()->id;
            $exam->save();
        }

        foreach($notes as $note){
            $note->subject_id=$subjects->random()->id;
            $note->user_id=$users->random()->id;
            $note->save();
        }

        foreach($files as $file){
            $file->note_id=$notes->random()->id;
            $file->save();
        }

        foreach($users as $user){
            //Subscribing to 
            for($i=random_int(0,3); $i<5; $i++){
                $user->subjects()->attach($subjects->random()->id);
            }
            $user->years()->attach($years->random()->id);
        }


    }
}
