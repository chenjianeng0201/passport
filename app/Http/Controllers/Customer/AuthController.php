<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Customer;
use App\Http\Controllers\Customer\Traits\TokenTrait;
use Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    use TokenTrait;

    public function login(Request $request)
    {
        // 根据用户名或者邮箱登录
        $customer = Customer::orWhere('username', $request->username)
            ->orwhere('email', $request->username)
            ->firstOrFail();

        // 检验密码是否正确，错误返回 401 和报错信息
        if (!Hash::check($request->password, $customer->password)) {
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
        if (Auth::guard('customer')->check()) {
            Auth::guard('customer')->user()->token()->delete();
        }

        return  response()->noContent();
    }
}
