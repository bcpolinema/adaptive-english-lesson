<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index(){
        return view('student.index');
    }

    public function listening(){
        return view('student.listening');
    }
    
}
