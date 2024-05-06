<?php

namespace App\Http\Controllers\ris;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class soportesController extends Controller
{

    public function index()
    {
        return view('ris.cargarsoportes.create');
    }
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $file = $request->file('file');
            $name = "PRUEBA";
            $file->storeAs('soportes', $name . "." . $file->extension(), 'public');
        }
    }
}
