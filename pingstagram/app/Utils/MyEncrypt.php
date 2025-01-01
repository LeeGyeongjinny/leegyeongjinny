<?php

namespace App\Utils;

use Illuminate\Support\Str;

class MyEncrypt {
    /**
     * base64 URL encode
     * 
     * @param string $json
     * @return string base64 URL encode
     */
    public function base64UrlEncode(string $json) {
        return strtr(base64_encode($json), '+/', '-_');
    }

    // base64 URL decode
    public function base64UrlDecode(string $base64) {
        return base64_decode(strtr($base64, '-_', '+/'));
    }

    /**
     * Salt 생성
     * 
     * @param   int $saltLength
     * 
     * @return string 랜덤 문자열
     */
    public function makeSalt($saltLength) {
        return Str::random($saltLength);
    }

    /**
     * 문자열 암호화
     * 
     * @param  string $alg 알고리즘명
     * @param  string $str 암호화할 문자열
     * @param  string $salt 솔트
     * 
     * @return string 암호화된 문자열
     */
    public function hashWithSalt(string $alg, string $str, string $salt) {
        return hash($alg, $str).$salt;
    }

    // 솔트 제거한 문자열 반환
    public function subSalt(string $signature, int $saltLength) {
        return mb_substr($signature, 0, (-1 * $saltLength));
    }


}