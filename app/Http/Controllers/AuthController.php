<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * ユーザー新規登録処理
     *
     * @param Request $request リクエストデータ
     * @return void
     */
    public function addUser(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => '入力内容にエラーがあります。',
            ], 200);
        }

        // ユーザーを登録
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User registered successfully'
        ], 200);
    }

    /**
     * ログイン処理
     *
     * @param Request $request リクエストデータ
     * @return void
     */
    public function login(Request $request)
    {
        // バリデーション
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
                'message' => '入力内容にエラーがあります。',
            ], 200);
        }

        $user = User::where('email', $request->email)->first();

        // ハッシュ化してDBに保存しているパスワードと合致するかチェック
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => false,
                'err_msg' => 'wrong password'
            ], 200);
        }

        // ログイン成功時にログイントークンを発行
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'status' => true,
            'login_token' => $token
        ], 200);
    }

    /**
     * ログアウト処理
     *
     * @param Request $request リクエストデータ
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status' => true,
            'message' => 'Logged out successfully'
        ], 200);
    }
}
