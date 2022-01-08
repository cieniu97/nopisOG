<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Field;

class FieldController extends Controller
{
   // Display all instances of a model paginated
   public function index()
   {
       $fields = Field::paginate(20);
       return view ('fields.index', ['fields' => $fields]);
   }

   // Display all trshed (soft deleted) instances of a model paginated
   public function trashed()
   {
       $fields = Field::onlyTrashed()->paginate(20);
       return view ('fields.trashed', ['fields' => $fields]);
   }

   // Display instance of a model creation form
   public function create()
   {
       return view('fields.create');
   }

   // Validate data from creation form and store instance into database
   public function store(Request $request)
   {
       //Validating request from form
       $validated = $request->validate([
            'university_id' => 'required|numeric',
            'name' => 'required|string',
       ]);

       //Creating new classroom with validated request data
       $field = new Field;
       $field->university_id = $validated['university_id'];
       $field->name = $validated['name'];
       $field->save();

       return redirect('/fields/'.$field->id)->with('message', 'Dodano!');
        
   }

   // Display single instance of a model
   public function show(Field $field)
   {
        $years = $field->years()->paginate(20);
        return view('fields.show', ['field' => $field, 'years' => $years]);
   }

   // Display instance o a model update form
   public function edit(Field $field)
   {
       return view('fields.edit', ['field' => $field]);
   }

   // Validate data from creation form and update instance in database
   public function update(Request $request, Field $field)
   {
       //Validating request from form
        $validated = $request->validate([
            'university_id' => 'numeric',
            'name' => 'string',
        ]);

       //Changing data only if request had new data
        if($request->has('university_id')){
            $field->university_id = $validated['university_id'];
        }
        if($request->has('name')){
            $field->name = $validated['name'];
        }
       $field->save();

       return redirect('/fields/'.$field->id)->with('message', 'Edycja pomyślna!');
        
   }

   // Soft delete instance of a model
   public function destroy(Field $field)
   {
       $field->delete();
       return redirect('/fields')->with('message', 'Usunięto!');
   }

   // Restore trashed (soft deleted) instance of a model
   public function restore($id)
   {
       
       $field = Field::withTrashed()->where('id', $id)->firstOrFail();
       $field->restore();
       return redirect('/fields/trashed')->with('message', 'Przywrócono!');
   }


}
