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
use \App\Models\Subscription;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(500)->create();
        University::factory(5)->create();
        Field::factory(50)->create();
        Year::factory(50)->create();
        Subject::factory(200)->create();
        Note::factory(800)->create();
        Exam::factory(400)->create();

        $users = User::all();
        $universities = University::all();
        $fields = Field::all();
        $years = Year::all();
        $subjects = Subject::all();
        $notes = Note::all();
        $exams = Exam::all();

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

        foreach($notes as $note){
            $note->subject_id=$subjects->random()->id;
            if(random_int(0,2)==0){
                $note->exam_id = $exams->random()->id;
            }
            $note->save();
        }

        foreach($exams as $exam){
            $exam->subject_id=$subjects->random()->id;
            $exam->save();
        }

        foreach($users as $user){
            $subscription = new Subscription;
            $subscription->user_id = $user->id;
            $subscription->subject_id = $subjects->random()->id;
            //Adding checksum to avoid duplicates in subscriptions table
            //Without the checksum if duplicates occur then deleting record doesnt detach the relation and needs to be deleted N times
            $checksum = $subscription->user_id. "-" .$subscription->subject_id;
            $anit_duplicates = Subscription::where('checksum', $checksum)->first();
            
            if($anit_duplicates == null){
                $subscription->checksum = $checksum;
                $subscription->save();
                
            }
            else{
                echo "Duplicate avoided \n"; 
            }
        }
    }
}
