<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class YourHomeController extends Controller
{
    public function index(): View
    {
        return view('index'); // welcome.blade.php を表示
    }
}