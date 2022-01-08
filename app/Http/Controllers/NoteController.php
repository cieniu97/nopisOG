<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Exam;
use App\Models\File;



class NoteController extends Controller
{
    // Display all instances of a model paginated
    // public function index()
    // {
    //     $notes = Note::paginate(20);
    //     return view ('notes.index', ['notes' => $notes]);
    // }

    // Display all trshed (soft deleted) instances of a model paginated
    // public function trashed()
    // {
    //     $notes = Note::onlyTrashed()->paginate(20);
    //     return view ('notes.trashed', ['notes' => $notes]);
    // }

    // Display instance of a model creation form
    // public function create()
    // {
    //     return view('notes.create');
    // }

    // Validate data from creation form and store instance into database
    public function store(Request $request)
    {
        //dd($request->all());
        //Validating request from form
        $validated = $request->validate([
                'subject_id' => 'required|numeric',
                'name' => 'required|string',
                'description' => 'required|string',
                'files.*' => ['mimes:jpeg,jpg,doc,docx,odt,pdf,txt,zip,rar','max:5000'],
        ]);

        
        

        //Creating new classroom with validated request data
        $note = new Note;
        $note->subject_id = $validated['subject_id'];
        $note->user_id= auth()->user()->id;
        $note->name = $validated['name'];
        $note->description = $validated['description'];
        $note->save();


        // Adding files if they exist
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file ) {
                $newFile = new File;
                $newFile->note_id=$note->id;
                $path=$file->store('public/files');
                $newFile->name=$file->getClientOriginalName();
                $newFile->path=$path;
                $newFile->save();
            }
        }
        return redirect('/notes/'.$note->id)->with('message', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Note $note)
    {
        
        return view('notes.show', ['note' => $note]);
    }

    // Display instance o a model update form
    public function edit(Note $note)
    {
        return view('notes.edit', ['note' => $note]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, Note $note)
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
            $note->subject_id = $validated['subject_id'];
        }
        if($request->has('name')){
            $note->name = $validated['name'];
        }
        if($request->has('date')){
            // Additional validation for time inputs
            $date = $this->validateTime($validated['date']);
            if($date==false)
            {
                return back()->withErrors(['start' => 'Invalid date in form field']);
            }
            $note->date = $date;
        }
        if($request->has('description')){
            $note->description = $validated['description'];
        }
        $note->save();

        return redirect('/notes/'.$note->id)->with('message', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect('/')->with('message', 'Usunięto!');
    }

    // // Restore trashed (soft deleted) instance of a model
    // public function restore($id)
    // {
    //     $note = Note::withTrashed()->where('id', $id)->firstOrFail();
    //     $note->restore();
    //     return redirect('/notes/trashed')->with('success', 'Przywrócono!');
    // }

}
