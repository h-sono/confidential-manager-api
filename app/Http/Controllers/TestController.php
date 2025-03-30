<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function store(Request $request)
    {
        Log::info("データ1", $request->all());

        $request->validate([
            'test_value_1' => ['required', 'string'],
            'test_value_2' => ['required', 'string'],
            'test_value_3' => ['nullable', 'string'],
        ]);

        $testStoreResult = TestModel::create([
            'test_value_1' => $request->input('test_value_1'),
            'test_value_2' => $request->input('test_value_2'),
            'test_value_3' => $request->input('test_value_3'),
        ]);

        return response()->json($testStoreResult, 200);
    }
}
