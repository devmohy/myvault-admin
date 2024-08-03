<?php

namespace App\Http\Controllers;

use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bank = State::orderBy('name', 'ASC')->get();
        return response()->json([
            'data' => $bank,
            'message' => 'List of states fetched successfully',
            'code' => 200,
        ]);
    }
}
