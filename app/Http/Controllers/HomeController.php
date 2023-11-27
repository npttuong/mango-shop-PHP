<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Illustration;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  function index()
  {
    $numTake = 8;
    $topProducts = Product::all()->take($numTake);
    return view('home', compact('topProducts'));
  }
}