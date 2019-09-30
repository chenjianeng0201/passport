<?php

namespace App\Http\Controllers\Admin\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait TokenTrait
{
    public function authenticate()
    {
        $client = new Client();

        try {
            // 请求本地的 passport token
            $url = request()->root() . '/admin/oauth/token';
            $password_client = \DB::table('oauth_clients')->where('name', 'passport-admin')->first();
            $params = [
                'grant_type' => 'password', // 认证类型 passport
                'client_id' => $password_client->id,
                'client_secret' => $password_client->secret,
                'scope' => 'admin', // 设置 token 作用域
                'username' => request('username'),
                'password' => request('password'),
            ];

            $respond = $client->request('POST', $url, ['form_params' => $params]);
        } catch (RequestException $exception) {
            abort(401, '系统异常');
        }

        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }

        abort(401, '账号或密码错误');
    }

    public function getRefreshToken()
    {
        $client = new Client();

        try {
            // 请求本地的 passport token
            $url = request()->root() . '/admin/oauth/token';
            $password_client = \DB::table('oauth_clients')->where('name', 'passport-admin')->first();
            $params = [
                'grant_type' => 'refresh_token',// 认证类型 refresh_token
                'client_id' => $password_client->id,
                'client_secret' => $password_client->secret,
                'scope' => 'admin', // 设置 token 作用域
                'refresh_token' => request('refresh_token')
            ];
            $respond = $client->request('POST', $url, ['form_params' => $params]);
        } catch (RequestException $exception) {
            abort(401, '系统异常');
        }
        if ($respond->getStatusCode() !== 401) {
            return json_decode($respond->getBody()->getContents(), true);
        }
        abort(401, 'refresh token 错误');
    }
}
