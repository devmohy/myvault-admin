<?php

namespace App\Http\Controllers;

use App\Models\Tenure;
use Illuminate\Http\Request;

class InterestRateController extends Controller
{
    public function index()
    {
        return Tenure::paginate(10);
    }
}
