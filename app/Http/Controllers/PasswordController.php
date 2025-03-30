<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;

class PasswordController extends BaseController
{
    /**
     * すべてのパスワードを取得
     */
    public function index()
    {
        $passwords = Password::where('user_id', Auth::id())->get();
        return response()->json($passwords);
    }

    /**
     * 新しいパスワードを保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'site' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $password = Password::create([
            'user_id' => Auth::id(),
            'site' => $request->site,
            'username' => $request->username,
            'password' => Crypt::encryptString($request->password) // パスワードを暗号化
        ]);

        return response()->json($password, 201);
    }

    /**
     * 特定のパスワードを取得
     */
    public function show($id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $password->password = Crypt::decryptString($password->password); // 復号化して表示
        return response()->json($password);
    }

    /**
     * パスワードを更新
     */
    public function update(Request $request, $id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $request->validate([
            'site' => 'sometimes|string',
            'username' => 'sometimes|string',
            'password' => 'sometimes|string'
        ]);

        if ($request->has('site')) {
            $password->site = $request->site;
        }
        if ($request->has('username')) {
            $password->username = $request->username;
        }
        if ($request->has('password')) {
            $password->password = Crypt::encryptString($request->password);
        }

        $password->save();

        return response()->json($password);
    }

    /**
     * パスワードを削除
     */
    public function destroy($id)
    {
        $password = Password::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $password->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
