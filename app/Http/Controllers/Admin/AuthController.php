<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Admin;
use App\Http\Controllers\Admin\Traits\TokenTrait;
use Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use TokenTrait;

    public function login(Request $request)
    {
        // 根据用户名或者邮箱登录
        $admin = Admin::orWhere('username', $request->username)
            ->orwhere('email', $request->username)
            ->firstOrFail();

        // 检验密码是否正确，错误返回 401 和报错信息
        if (!Hash::check($request->password, $admin->password)) {
            return response()->json([
                'message' => '用户名或密码错误'
            ], 401);
        }

        $token = $this->authenticate();
        return response()->json($token);
    }

    public function refresh()
    {
        // 获取 token
        $token = $this->getRefreshToken();
        return response()->json($token);
    }

    public function logout()
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->user()->token()->delete();
        }

        return  response()->noContent();
    }
}
