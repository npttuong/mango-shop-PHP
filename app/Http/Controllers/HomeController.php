<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Illustration;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

// Code của Nguyễn Châu Phúc Huy
use Illuminate\Support\Facades\Auth;
// Kết thúc

class HomeController extends Controller
{
  function index()
  {

    // Code của Nguyễn Châu Phúc Huy
    if (Auth::check()) {
      if (Auth::user()->role_name == 'admin') {
        return redirect('/admin/admin-profile');
      }
    }
    // Kết thúc

    $numTake = 8;
    $topProducts = Product::all()->take($numTake);
    return view('home', compact('topProducts'));
  }
}
