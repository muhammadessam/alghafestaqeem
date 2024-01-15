<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    public function index()
    {
        return view('admin.contracts.index');
    }

    public function create()
    {
        return view('admin.contracts.create');
    }
}
