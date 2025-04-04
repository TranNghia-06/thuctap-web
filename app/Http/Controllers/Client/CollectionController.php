<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Collection;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(Request $request)
{
    $limit = $request->input('limit', 50);
    $query = Collection::where('is_public', true);

    // Thêm điều kiện tìm kiếm nếu có từ khóa
    if ($request->has('q')) {
        $search = $request->input('q');
        $query->where('name', 'like', "%{$search}%");
    }

    $data = $query->paginate($limit)->appends($request->query());

    return view('client.collection.view', compact('data'));
}


    public function details($id)
    {
        $data = Collection::findOrFail($id);

        if ($data->getIsInactiveAttribute()) {
            abort(404);
        }
        
        return view('client.collection.details', compact('data'));
    }
}
