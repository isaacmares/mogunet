<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
class SitesController extends Controller
{
    public function index(){
        $sites = Site::get();
        return view('dashboard', compact('sites'));
    }

    public function show(){
        return view('sites.index');

    }

    public function create(){
        return view('sites.create');
    }

    public function store(Request $request)
    {
        $site = new Site;  
        $site->nombre = $request->nombre;  
        $site->save();  
    
        return redirect()->route('dashboard')->with('success', 'Site Creado Correctamente');
    }
    

}
