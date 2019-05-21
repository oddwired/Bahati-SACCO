<?php

namespace BahatiSACCO\Http\Controllers\Admin;

use Illuminate\Http\Request;
use BahatiSACCO\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index(){
        return view('admin.home');
    }
}
