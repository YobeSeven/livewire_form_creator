<?php

namespace App\Http\Controllers;

use App\Models\Count;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        // $counts = Count::all();
        return view("home");
    }
}
