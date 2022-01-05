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
}
