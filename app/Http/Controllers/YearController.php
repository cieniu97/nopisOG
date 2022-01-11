<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Year;
use App\Models\Field;
use App\Models\User;



class YearController extends Controller
{
    // Display all instances of a model paginated
    public function index()
    {
        $years = Year::paginate(20);
        return view ('years.index', ['years' => $years]);
    }

    // Display all trshed (soft deleted) instances of a model paginated
    public function trashed()
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
        $years = Year::onlyTrashed()->paginate(20);
        return view ('years.trashed', ['years' => $years]);
    }

    // Display instance of a model creation form
    public function create()
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
        return view('years.create');
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

        return redirect('/years/'.$year->id)->with('message', 'Dodano!');
            
    }

    // Display single instance of a model
    public function show(Year $year)
    {
        $subjects = $year->subjects()->paginate(20);
        if(count(auth()->user()->years->where('id', $year->id)) > 0){
            $is_subscribed = true;
        }
        else{
            $is_subscribed = false;
        }
        return view('years.show', ['year' => $year, 'subjects' => $subjects, 'is_subscribed' => $is_subscribed]);
    }

    // Display instance o a model update form
    public function edit(Year $year)
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
        return view('years.edit', ['year' => $year]);
    }

    // Validate data from creation form and update instance in database
    public function update(Request $request, Year $year)
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
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

        return redirect('/years/'.$year->id)->with('message', 'Edycja pomyślna!');
            
    }

    // Soft delete instance of a model
    public function destroy(Year $year)
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
        if(count($year->subjects) > 0){
            return back()->with('message', 'Do tego rocznika przypisane są jeszcze przedmioty. Należy najpierw usunąć powiązane dane.');
        }
        $year->delete();
        return redirect('/years')->with('message', 'Usunięto!');
    }

    // Restore trashed (soft deleted) instance of a model
    public function restore($id)
    {
        if(!auth()->user()->is_admin){
            return back()->with('message', 'Nie posiadasz uprawnień!');
        }
        $year = Year::withTrashed()->where('id', $id)->firstOrFail();
        if($year->field == null){
            return back()->with('message', 'Nie można przywrócić tego przedmiotu, ponieważ związany z nim rocznik został usunięty lub nie istnieje');
        }
        $year->restore();
        return redirect('/years')->with('message', 'Przywrócono!');
    }

    //Subscribe user to a year 
    public function subscribe(Year $year){
        $user = User::where('id', auth()->user()->id)->first();
        if(count($user->years->where('id', $year->id)) > 0){
            
            $user->years()->detach($year->id);
        }
        else{

            $user->years()->attach($year->id);
        }
        
        return back();
    }
}
