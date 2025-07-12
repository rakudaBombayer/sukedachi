<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as UserRequest;
use Illuminate\View\View;

class YourHomeController extends Controller
{
    public function index(): View
    {
        $allRequests = UserRequest::all(); // 全ての依頼データを取得

        return view('index', compact('allRequests')); // index.blade.php を表示し、$allRequests を渡す
    }
}
