<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/6/14
 * Time: 17:42
 */

namespace by\component\ipAddress;


use by\infrastructure\helper\CallResultHelper;

class IpHelper
{

    /**
     *
     * @param $ip
     * @return \by\infrastructure\base\CallResult
     * @throws \Exception
     */
    public static function getCountryByIp($ip)
    {
        $result = LocalDbIpHelper::find($ip);
        if (count($result) > 0) {
            $country = $result[0];
            if ($country == '保留地址') {
                $country = '';
            }
        }
        if (!empty($country)) {
            return CallResultHelper::success($country);
        }
        $context = stream_context_create(array(
            'http' => array(
                'timeout' => 5 //超时时间，单位为秒
            )
        ));


        // 淘宝ip接口获取
        $info = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $ip, 0, $context);
        if ($info != false) {
            $info = json_decode($info, JSON_OBJECT_AS_ARRAY);

            if ($info != false && is_array($info) && array_key_exists('code', $info)) {
                $code = intval($info['code']);
                if ($code == 0) {
                    $data = $info['data'];
                    $country = $data['country'];
                    return CallResultHelper::success($country);
                }
            }
        }

        $info = @file_get_contents("http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json&ip=" . $ip, 0, $context);
        if ($info !== false) {
            $info = json_decode($info, JSON_OBJECT_AS_ARRAY);
            if ($info != false && is_array($info) && array_key_exists('ret', $info)) {
                $ret = intval($info['ret']);
                if ($ret == 1) {
                    $country = $info['country'];
                    return CallResultHelper::success($country);
                }
            }
        }
        return CallResultHelper::fail('device login ip is invalid');
    }
}