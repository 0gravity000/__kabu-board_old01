<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meigara;

class MeigarasController extends Controller
{
  public function index()
  {
    $Meigaras = Meigara::all();
    //dd($Meigaras->first()->code);
    return view('meigaras.index', compact('Meigaras'));
  }
}
