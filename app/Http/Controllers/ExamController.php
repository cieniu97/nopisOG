<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;

class ExamController extends Controller
{
    // Display all instances of a model paginated
    public function index()
    {
        $exams = Exam::paginate(20);
        return view ('exams.index', ['exams' => $exams]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        $exams = Exam::onlyTrashed()->paginate(20);
        return view ('exams.trashed', ['exams' => $exams]);
    }

    // Display instance of a model creation form
    public function create()
    {
        return view('exams.create');
    }

    // Validate data from creation form and store instance into database
    public function store(Request $request)
    {
        //Validating request from form
        $validated = $request->validate([
                'subject_id' => 'required|numeric',
                'name' => 'required|string',
                'date' => 'required|date',
                'description' => 'required|string',
        ]);

        // Additional validation for time inputs
        $date = $this->validateTime($validated['date']);
        if($date==false)
        {
            return back()->withErrors(['start' => 'Invalid date in form field']);
        }

        //Creating new classroom with validated request data
        $exam = new Exam;
        $exam->subject_id = $validated['subject_id'];
        $exam->name = $validated['name'];
        $exam->date = $date;
        $exam->description = $validated['description'];

        $exam->save();

        return redirect('/exams/'.$exam->id)->with('success', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Exam $exam)
    {
        
        return view('exams.show', ['exam' => $exam]);
    }

    // Display instance o a model update form
    public function edit(Exam $exam)
    {
        return view('exams.edit', ['exam' => $exam]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, Exam $exam)
    {
        //Validating request from form
        $validated = $request->validate([
            'subject_id' => 'numeric',
            'name' => 'string',
            'date' => 'date',
            'description' => 'string',

        ]);

        //Changing data only if request had new data
        if($request->has('subject_id')){
            $exam->subject_id = $validated['subject_id'];
        }
        if($request->has('name')){
            $exam->name = $validated['name'];
        }
        if($request->has('date')){
            // Additional validation for time inputs
            $date = $this->validateTime($validated['date']);
            if($date==false)
            {
                return back()->withErrors(['start' => 'Invalid date in form field']);
            }
            $exam->date = $date;
        }
        if($request->has('description')){
            $exam->description = $validated['description'];
        }
        $exam->save();

        return redirect('/exams/'.$exam->id)->with('success', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Exam $exam)
    {
        $exam->delete();
        return redirect('/exams')->with('success', 'Usunięto!');
    }


    // Converting datetime to timestamp so it can be converted back to local time on client side
    public function validateTime($time)
    {
        // Making sure date is correct and converting it to timestamp
        $output=@strtotime($time);

        if($output==false){
            return false;
        }
        return $output;

    }

}
