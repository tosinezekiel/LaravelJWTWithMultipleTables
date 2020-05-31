<?php

namespace App\Http\Controllers;

use App\Investment;
use Illuminate\Http\Request;

class InvestmentController extends Controller
{
    public function index(){
        $investments = Investment::all();
        return response(['data' => $investments],200);
    }
}
