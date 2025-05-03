<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TestModel;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function store(Request $request)
    {
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

    // TODO:テスト用
    public function showTable()
    {
        $user = User::all();
        // TODO:
        Log::info("showTable", ['$user' => $user]);

        return response()->json(
            [
                'table_data' => $user
            ],
            200
        );
    }
}
