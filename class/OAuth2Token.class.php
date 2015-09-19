<?php

/**
 * Class OAuth2Token
 */
class OAuth2Token {

    /**
     *
     */
    CONST CODE_URL = 'https://oauth.api.189.cn/emp/oauth2/v3/callback/udb/229112459?appId=tyopen&paras=000DEBC73A32D2733EFD86261FEF8B1183D70DEB740C68909D27B8B998D3D683828E3FAC5FB33D7A162D2ADC915661A350A2998D3F121688F915758600E96E1EA66E14BAFD9EB5E919486C2D8AA98FAD9EBD844D0C4A9EF7DB94E9B0FD61D3B51B357C4D77C11E33985A76E756D3FFBA22908E18293051DDA39A987EBFECF19EDEFA9524A0BDAA46C7A67BE6428A958031B3488A64730BA70D36820F9B01178A069E2AFAA7A3363A2831F78BF61BAC30C1564B4CD683EAC6A0B85F716665A8231B419AF4EE68FBFF8088CBBF0E1BD59FCCD6A4759AC785EDBC6198FB&sign=063D0D9B9CADD03C09EC113191724EE849C4BBD7';
    CONST ACCESS_TOKEN_URL = 'https://oauth.api.189.cn/emp/oauth2/v3/access_token';

    /**
     * @author xuke
     * @return string
     * @desc 生成请求access_token所需要的code
     */
    public static function createCode() {

        $curl = curl_init(self::CODE_URL);
        curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $content = curl_exec($curl);
        $info = curl_getinfo($curl, CURLINFO_REDIRECT_URL);
        preg_match('/code=(.*?)&/i', $info, $matches);
        curl_close($curl);

        if (!empty($matches)) {
            return $matches[1];
        }
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public static function updateToken() {
        $code = self::createCode();
        $params = array(
            'app_id' => C('APP_ID'),
            'app_secret' => C('APP_SECRET'),
            'grant_type' => 'authorization_code',
            'redirect_uri' => 'http://www.189pai.com/push',
            'code' => $code
        );

        $curl = curl_init(self::ACCESS_TOKEN_URL);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_HEADER,'Content-Type: application/x-www-form-urlencoded');
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");

        // have a setup that causes ssl validation to fail
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $postData = "";

        //This is needed to properly form post the credentials object
        foreach($params as $k => $v)
        {
            $postData .= $k . '='.urlencode($v).'&';
        }
        $postData = rtrim($postData, '&');

        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);

        $json_response = curl_exec($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // evaluate for success response
        if ($status != 200) {
            throw new Exception("Error: call to URL $endpoint failed with status $status, response $json_response, curl_error " . curl_error($curl) . ", curl_errno " . curl_errno($curl) . "\n");
        }
        curl_close($curl);

        $token_result = json_decode($json_response, true);
        if (!empty($token_result) && ($token_result['res_code'] == '0')) {
            $token = $token_result['access_token'];
            $file = fopen('token.ini', 'w');
            fwrite($file, '[token_config]' . "\n");
            fwrite($file, 'access_token = ' . $token);
            fclose($file);
            return $token;
        }
    }

    /**
     * @return mixed
     * @desc 从配置文件中获取token
     */
    public static function getTokenFromFile() {
        $ini_array = parse_ini_file('token.ini');
        return $ini_array['access_token'];
    }
}