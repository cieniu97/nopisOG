<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;

use App\Models\Subject;
use App\Models\Year;



class PanelController extends Controller
{
    public function index(){
        
        $universities = University::all();
        $teachers = Subject::all()->pluck('teacher')->unique();
        $yearTypes = Year::all()->pluck('type')->unique();

        return view('panel.main', ['universities' => $universities, 'teachers' => $teachers, 'yearTypes' => $yearTypes]);
    }

    public function store(Request $request){
        
        
        //Validating request from form
        $validated = $request->validate([
            'university' => 'required|string',
            'field' => 'string|nullable',
            'year' => 'string|nullable',
            'year-type' => 'string|nullable',
            'subject' => 'string|nullable',
            'semester' => 'numeric|max:255|nullable',
            'teacher' => 'string|nullable',
        ]);
        
        $result = [];

        $university=University::where('name', $validated['university'])->first();
        
        if($university==null){
            $university = new University;
            $university->name=$validated['university'];
            $university->save();
            
            $result[0]= $university;
        }
        // Adding field if data is provided
        if($request->has('field') && $validated['field'] != null){
            $field=Field::where('name', $validated['field'])->first();
            if($field==null){
                $field = new Field;
                $field->name=$validated['field'];
            }
            $field->university_id = $university->id;
            $field->save();
            $result[1]= $field;

            // Adding year if data is provided
            if($request->has('year') && $validated['year'] != null && $request->has('year-type') && $validated['year-type'] != null){
                
                $year=Year::where('name', $validated['year'])->first();
                if($year==null){
                    $year = new Year;
                    $year->name=$validated['year'];
                    $year->type=$validated['year-type'];

                }
                $year->field_id = $field->id;
                $year->save();
                $result[2]= $year;

                // Adding subject if data is provided
                if($request->has('subject') && $validated['subject'] != null && $request->has('semester') && $validated['semester'] != null && $request->has('teacher') && $validated['teacher'] != null){
                
                    $subject=Subject::where('name', $validated['subject'])->first();
                    if($subject==null){
                        $subject = new Subject;
                        $subject->name=$validated['subject'];
                        $subject->semester=$validated['semester'];
                        $subject->teacher=$validated['teacher'];

    
                    }
                    $subject->year_id = $year->id;
                    $subject->save();
                    $result[3]= $subject;

    
                }

            }
        }

        return $result;
    }

    public function getFields($universityName){
        $university=University::where('name', $universityName)->firstOrFail();
        $fields=$university->fields->pluck('name');
        return $fields;
    }

    public function getYears($universityName, $fieldName){
        $university=University::where('name', $universityName)->firstOrFail();
        $field=$university->fields->where('name',$fieldName)->firstOrFail();
        $years=$field->years->pluck('name');
        return $years;
    }

    public function getSubjects($universityName, $fieldName, $yearName){
        $university=University::where('name', $universityName)->firstOrFail();
        $field=$university->fields->where('name',$fieldName)->firstOrFail();
        $year=$field->years->where('name',$yeardName)->firstOrFail();
        $subjects=$year->subjects->pluck('name');
        return $subjects;
    }


}
