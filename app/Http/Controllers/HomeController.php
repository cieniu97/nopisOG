<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\University;
use App\Models\Field;
use App\Models\Year;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Note;



class HomeController extends Controller
{

    public function index(){
        if(Auth::check()){
            
            $allExams = $this->getAllActiveUserExams();
            $recentNotes = $this->getRecentNotes();
            
            $subjects = auth()->user()->subjects;
            $years = auth()->user()->years;
            return view('home', ['subjects' => $subjects, 'years' => $years, 'allExams' => $allExams, 'recentNotes' => $recentNotes]);
        }
        else{
            return view('intro');
        }

    }

    public function getRecentNotes(){
        
        $allNotes = collect();
        $subjects = auth()->user()->subjects;
        $years = auth()->user()->years;
        foreach($years as $year){
            $subjects = $subjects->merge($year->subjects);
        }
        foreach($subjects as $subject){
            $allNotes = $allNotes->merge($subject->notes);
        }
        
        return $allNotes->unique()->sortBy('created_at')->take(10);


    }

    public function getAllActiveUserExams(){
        $allExams = collect();
        $subjects = auth()->user()->subjects;
        $years = auth()->user()->years;

        foreach($subjects as $subject){
            $exams=$subject->exams->where('date', '>=', time());
            $allExams = $allExams->merge($exams);
        }
        foreach($years as $year){
            foreach($year->subjects as $subject){
                $exams=$subject->exams->where('date', '>=', time());
                $allExams = $allExams->merge($exams);
            }
        }
        $allExams=$allExams->unique()->sortBy('date');

        return $allExams;
        
    }

    public function search(Request $request){

        $validated = $request->validate([
            'search' => 'required|string',
       ]);

       if(strlen($validated['search'])<3){
           return back()->with('message','Wprowadź co najmniej 3 znaki');
       }

       $search = $validated['search'];

       $universities = University::where('name', 'like', '%'.$search.'%')->get();
       $fields = Field::where('name', 'like', '%'.$search.'%')->get();
       $years = Year::where('name', 'like', '%'.$search.'%')->get();
       $subjects = Subject::where('name', 'like', '%'.$search.'%')->get();
       $teachers = Subject::where('teacher', 'like', '%'.$search.'%')->pluck('teacher')->unique();



       

       return view('search', ['universities' => $universities, 'fields' => $fields, 'years' => $years, 'subjects' => $subjects, 'search' => $search, 'teachers' => $teachers]);

    }

    public function create(){
        $universities = University::all();
        $teachers = Subject::all()->pluck('teacher')->unique();
        $yearTypes = Year::all()->pluck('type')->unique();

        return view('create', ['universities' => $universities, 'teachers' => $teachers, 'yearTypes' => $yearTypes]);
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
            
            
        }
        $result[0]= $university;
        // Adding field if data is provided
        if($request->has('field') && $validated['field'] != null){
            $field=Field::where('name', $validated['field'])->where('university_id', $university->id)->first();
            if($field==null){
                $field = new Field;
                $field->name=$validated['field'];
            }
            $field->university_id = $university->id;
            $field->save();
            $result[1]= $field;

            // Adding year if data is provided
            if($request->has('year') && $validated['year'] != null && $request->has('year-type') && $validated['year-type'] != null){
                
                $year=Year::where('name', $validated['year'])->where('field_id', $field->id)->first();
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
                
                    $subject=Subject::where('name', $validated['subject'])->where('year_id', $year->id)->first();
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

        return back()->with(['message' => 'Dodano!', 'added' => $result]);
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

    public function teacher($name){
        $subjects=Subject::where('teacher', $name)->get();

        return view('teacher', ['teacher' => $name, 'subjects' => $subjects]);
    }


}
