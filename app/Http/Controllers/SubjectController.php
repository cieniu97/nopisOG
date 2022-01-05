<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Year;
use App\Models\User;



class SubjectController extends Controller
{
    // Display all instances of a model paginated
    public function index()
    {
        $subjects = Subject::paginate(20);
        return view ('panel.subjects.index', ['subjects' => $subjects]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        $subjects = Subject::onlyTrashed()->paginate(20);
        return view ('panel.subjects.trashed', ['subjects' => $subjects]);
    }

    // Display instance of a model creation form
    public function create()
    {
        return view('panel.subjects.create');
    }

    // Validate data from creation form and store instance into database
    public function store(Request $request)
    {
        //Validating request from form
        $validated = $request->validate([
                'year_id' => 'required|numeric',
                'name' => 'required|string',
                'semester' => 'required|numeric|max:255',
                'teacher' => 'required|string',
        ]);

        //Creating new classroom with validated request data
        $subject = new Subject;
        $subject->year_id = $validated['year_id'];
        $subject->name = $validated['name'];
        $subject->semester = $validated['semester'];
        $subject->teacher = $validated['teacher'];

        $subject->save();

        return redirect('/panel/subjects/'.$subject->id)->with('success', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Subject $subject)
    {
        $exams = $subject->exams()->paginate(20)->sortByDesc('date');
        $notes = $subject->notes()->paginate(20);
        
        if(count(auth()->user()->subjects->where('id', $subject->id)) > 0){
            $is_subscribed = true;
        }
        else{
            $is_subscribed = false;
        }
        
        return view('panel.subjects.show', ['subject' => $subject, 'exams' => $exams, 'notes' => $notes, 'is_subscribed' => $is_subscribed]);
    }

    // Display instance o a model update form
    public function edit(Subject $subject)
    {
        return view('panel.subjects.edit', ['subject' => $subject]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, Subject $subject)
    {
        //Validating request from form
        $validated = $request->validate([
            'year_id' => 'numeric',
            'name' => 'string',
            'semester' => 'numeric|max:255',
            'teacher' => 'string',

        ]);

        //Changing data only if request had new data
        if($request->has('year_id')){
            $subject->year_id = $validated['year_id'];
        }
        if($request->has('name')){
            $subject->name = $validated['name'];
        }
        if($request->has('semester')){
            $subject->semester = $validated['semester'];
        }
        if($request->has('teacher')){
            $subject->teacher = $validated['teacher'];
        }
        $subject->save();

        return redirect('/panel/subjects/'.$subject->id)->with('success', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return redirect('/panel/subjects')->with('success', 'Usunięto!');
    }

    // Restore trashed (soft deleted) instance of a model
    public function restore($id)
    {
        
        $subject = Subject::withTrashed()->where('id', $id)->firstOrFail();
        $subject->restore();
        return redirect('/panel/subjects/trashed')->with('success', 'Przywrócono!');
    }

    //Subscribe user to a subject 
    public function subscribe(Subject $subject){
        $user = User::where('id', auth()->user()->id)->first();
        if(count($user->subjects->where('id', $subject->id)) > 0){
            $user->subjects()->detach($subject->id);
        }
        else{
            $user->subjects()->attach($subject->id);
        }
        
        return back();
    }
}
