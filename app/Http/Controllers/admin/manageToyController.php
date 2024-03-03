<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Toys;
use Illuminate\Http\Request;

class manageToyController extends Controller
{
    public function toyManagement()
    {
        $toys = Toys::all();
        return view('admin.toyManagement', compact('toys'));
    }
}
