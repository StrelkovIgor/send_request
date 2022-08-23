<?php

namespace App\Http\Controllers;

use App\Http\Requests\SendAnswer;
use App\Http\Requests\SendRequest;
use App\Models\Request as RequestModel;

class RequestController extends Controller
{

    public function sendRequest(SendRequest $request)
    {
        RequestModel::create($request->toArray());
        return response()->json(['success' => true], 201);
    }

    public function sendAnswer(SendAnswer $request, RequestModel $requestModel)
    {
        if ($requestModel->hasResolved()) {
            return response()->json([
                'success' => false,
                'error' => "На эту заявку уже дали ответ"
            ], 403);
        }

        $requestModel->answer($request->comment);
    }

}
