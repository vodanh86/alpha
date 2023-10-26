<?php

namespace App\Http\Controllers\Auth;

use App\Http\Response\CommonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use CommonResponse;
    public function login(Request $request)
    {
        if (Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password])) {
            $user = Auth::user();;
            $accessToken = [
                'access_token' => $user->access_token
            ];
            $response = $this->_formatBaseResponse(200, $accessToken, 'Đăng nhập thành công', []);
            return response()->json($response);
        } else {
            $response = $this->_formatBaseResponse(401, null, 'Đăng nhập không thành công', ['errors' => 'Unauthorised']);
            return response()->json($response, 401);
        }
    }
}
