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
        return view ('subjects.index', ['subjects' => $subjects]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        $subjects = Subject::onlyTrashed()->paginate(20);
        return view ('subjects.trashed', ['subjects' => $subjects]);
    }

    // Display instance of a model creation form
    public function create()
    {
        return view('subjects.create');
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

        return redirect('/subjects/'.$subject->id)->with('message', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Subject $subject)
    {
        $exams = $subject->exams->sortByDesc('date');
        $notes = $subject->notes()->paginate(10);
        
        if(count(auth()->user()->subjects->where('id', $subject->id)) > 0){
            $is_subscribed = true;
        }
        else{
            $is_subscribed = false;
        }
        
        return view('subjects.show', ['subject' => $subject, 'exams' => $exams, 'notes' => $notes, 'is_subscribed' => $is_subscribed]);
    }

    // Display instance o a model update form
    public function edit(Subject $subject)
    {
        return view('subjects.edit', ['subject' => $subject]);
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

        return redirect('/subjects/'.$subject->id)->with('message', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Subject $subject)
    {
        if((count($subject->notes) > 0) || (count($subject->exams) > 0)){
            return back()->with('message', 'Do tego przedmiotu przypisane są jeszcze egzaminy lub notatki. Należy najpierw usunąć powiązane dane.');
        }
        $subject->delete();
        return redirect('/subjects')->with('message', 'Usunięto!');
    }

    // Restore trashed (soft deleted) instance of a model
    public function restore($id)
    {
        
        $subject = Subject::withTrashed()->where('id', $id)->firstOrFail();
        $subject->restore();
        return redirect('/subjects')->with('message', 'Przywrócono!');
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
