<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\Field;


class YearController extends Controller
{
    // Display all instances of a model paginated
    public function index()
    {
        $years = Year::paginate(20);
        return view ('panel.years.index', ['years' => $years]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        $years = Year::onlyTrashed()->paginate(20);
        return view ('panel.years.trashed', ['years' => $years]);
    }

    // Display instance of a model creation form
    public function create()
    {
        return view('panel.years.create');
    }

    // Validate data from creation form and store instance into database
    public function store(Request $request)
    {
        //Validating request from form
        $validated = $request->validate([
                'field_id' => 'required|numeric',
                'name' => 'required|string',
                'type' => 'required|string',

        ]);

        //Creating new classroom with validated request data
        $year = new Year;
        $year->field_id = $validated['field_id'];
        $year->name = $validated['name'];
        $year->type = $validated['type'];
        $year->save();

        return redirect('/panel/years/'.$year->id)->with('success', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Year $year)
    {
        $subjects = $year->subjects()->paginate(20);
        return view('panel.years.show', ['year' => $year, 'subjects' => $subjects]);
    }

    // Display instance o a model update form
    public function edit(Year $year)
    {
        return view('panel.years.edit', ['year' => $year]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, Year $year)
    {
        //Validating request from form
            $validated = $request->validate([
                'field_id' => 'numeric',
                'name' => 'string',
                'type' => 'string',

            ]);

        //Changing data only if request had new data
            if($request->has('field_id')){
                $year->field_id = $validated['field_id'];
            }
            if($request->has('name')){
                $year->name = $validated['name'];
            }
            if($request->has('type')){
                $year->type = $validated['type'];
            }
        $year->save();

        return redirect('/panel/years/'.$year->id)->with('success', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Year $year)
    {
        $year->delete();
        return redirect('/panel/years')->with('success', 'Usunięto!');
    }

    // Restore trashed (soft deleted) instance of a model
    public function restore($id)
    {
        
        $year = Year::withTrashed()->where('id', $id)->firstOrFail();
        $year->restore();
        return redirect('/panel/years/trashed')->with('success', 'Przywrócono!');
    }
}
