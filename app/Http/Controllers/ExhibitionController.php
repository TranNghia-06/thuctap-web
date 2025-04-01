<?php

namespace App\Http\Controllers;

use App\Models\Exhibition;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ExhibitionController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('limit', 10);
        $data = Exhibition::paginate($perPage)->appends($request->query());
        return view('admin.exhibition.view', compact('data'));
    }

    
}
