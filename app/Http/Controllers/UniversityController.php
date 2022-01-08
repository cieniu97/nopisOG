<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\University;
use App\Models\Field;


class UniversityController extends Controller
{
    // Display all instances of a model paginated
    public function index()
    {
        $universities = University::paginate(20);
        return view ('universities.index', ['universities' => $universities]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        $universities = University::onlyTrashed()->paginate(20);
        return view ('universities.trashed', ['universities' => $universities]);
    }

    // Display instance of a model creation form
    public function create()
    {
        return view('universities.create');
    }

    // Validate data from creation form and store instance into database
    public function store(Request $request)
    {
        //Validating request from form
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        //Creating new classroom with validated request data
        $university = new University;
        $university->name = $validated['name'];
        $university->save();

        return redirect('/universities/'.$university->id)->with('success', 'Dodano!');
         
    }

    // Display single instance of a model
    public function show(University $university)
    {
        $fields = $university->fields()->paginate(20);
        return view('universities.show', ['university' => $university, 'fields' => $fields]);
    }

    // Display instance o a model update form
    public function edit(University $university)
    {
        return view('universities.edit', ['university' => $university]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, University $university)
    {
        //Validating request from form
        $validated = $request->validate([
            'name' => 'string',
        ]);

        //Changing data only if request had new data
        if($request->has('name')){
            $university->name = $validated['name'];
        }
        $university->save();

        return redirect('/universities/'.$university->id)->with('success', 'Edycja pomyślna!');
         
    }

    // Soft delete instance of a model
    public function destroy(University $university)
    {
        $university->delete();
        return redirect('/universities')->with('success', 'Usunięto!');
    }

    // Restore trashed (soft deleted) instance of a model
    public function restore($id)
    {
        
        $university = University::withTrashed()->where('id', $id)->firstOrFail();
        $university->restore();
        return redirect('/universities/trashed')->with('success', 'Przywrócono!');
    }
}
