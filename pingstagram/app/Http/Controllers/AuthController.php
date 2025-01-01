<?php

namespace App\Http\Controllers;

use App\Exceptions\MyAuthException;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use MyToken;

class AuthController extends Controller
{
    // 로그인
    public function login(UserRequest $request) {
        $userInfo = User::where('account', $request->account)
                    ->withCount('boards')
                    ->first();

        // 비밀번호 체크
        if(!Hash::check($request->password, $userInfo->password)) {
            throw new AuthenticationException('비밀번호 체크 오류');
        }

        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // refreshToken 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);
    
        $responseData = [
            'success' => true,
            'msg' => '로그인 성공',
            'accessToken' => $accessToken,
            'refreshToken' => $refreshToken,
            'data' => $userInfo->toArray(),
        ];

        return response()->json($responseData, 200);
    }

    // 로그아웃
    public function logout(Request $request) {
        $id = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        DB::beginTransaction();

        $userInfo = User::find($id);

        MyToken::updateRefreshToken($userInfo, null);

        DB::commit();
        
        $responseData = [
            'success' => true
            ,'msg' => '로그아웃 성공'
        ];

        return response()->json($responseData, 200);
    }

    // 토큰 재발급
    public function reissue(Request $request) {
        // payload에서 pk 획득
        $userId = MyToken::getValueInPayload($request->bearerToken(), 'idt');

        $userInfo = User::find($userId);

        if($request->bearerToken() !== $userInfo->refresh_token) {
            throw new MyAuthException('E22');
        }

        // 토큰 발행
        list($accessToken, $refreshToken) = MyToken::createTokens($userInfo);

        // refreshToken 저장
        MyToken::updateRefreshToken($userInfo, $refreshToken);

        $responseData = [
            'success' => true
            ,'msg' => '토큰 재발급 성공'
            ,'accessToken' => $accessToken
            ,'refreshToken' => $refreshToken
        ];

        return response()->json($responseData, 200);
    }
}
