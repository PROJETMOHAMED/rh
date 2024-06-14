<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getChildrenOfType(Request $request)
    {
        $children = Type::where('parent_id', $request->parentId)->get();
        return response()->json([
            "status" => "success",
            "data" => $children
        ]);
    }
}
