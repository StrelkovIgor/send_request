<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendRequest;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{

    public function sendRequest(SendRequest $request)
    {
        RequestModel::create($request->toArray());
        return response()->json(['success' => true], 201);
    }

}
