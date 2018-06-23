<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/6/14
 * Time: 17:42
 */

namespace by\component\ipAddress;


use by\infrastructure\helper\CallResultHelper;
use by\infrastructure\helper\Object2DataArrayHelper;

class IpHelper
{
    /**
     * @param $ip
     * @return array|string
     * @throws \Exception
     */
    public static function getRegionByIp($ip)
    {
        $result = LocalDbIpHelper::find($ip);

        if (is_array($result) && count($result) > 2) {
            $entity = new IpLocEntity();
            $entity->setIp($ip);
            $entity->setCountry($result[0]);
            $entity->setProvince($result[1]);
            $entity->setCity($result[2]);
            $entity->setFrom("local");
            return CallResultHelper::success($entity);
        } elseif ($result == "N/A") {
            $result = self::getFromTaobao($ip);
            if ($result->isSuccess()) return $result;
        }

        return CallResultHelper::success(["from"=>"unknown", "country"=>"unknown", "province"=>"unknown", "city"=>"unknown"]);
    }

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

        return CallResultHelper::fail('device login ip is invalid');
    }


    public static function getFromTaobao($ip)
    {
        $context = stream_context_create(array(
            'http' => array(
                'timeout' => 5 //超时时间，单位为秒
            )
        ));

        $info = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=" . $ip, 0, $context);
        if ($info !== false) {
            $info = json_decode($info, JSON_OBJECT_AS_ARRAY);
            $entity = new IpLocEntity();
            if (array_key_exists('data', $info)) {
                $data = $info['data'];
                Object2DataArrayHelper::setData($entity, $data);
                if (array_key_exists('region', $data)) {
                    $entity->setProvince($data['region']);
                }
            }

            $entity->setFrom("taobao");
            return CallResultHelper::success($entity);
        }
        return CallResultHelper::fail();
    }
}