<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Meigara;
use Goutte\Client;
use Illuminate\Support\Facades\DB;

class AnalysesController extends Controller
{
	private $StockCollection = [];

  public function index()
  {
    return view('analyses.index');
    //return view('meigaras.index', compact('Meigaras'));
	}

}
