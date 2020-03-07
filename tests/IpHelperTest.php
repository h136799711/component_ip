<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/6/14
 * Time: 18:00
 */

namespace byTest;


use by\component\ipAddress\IpHelper;
use by\component\ipAddress\IpLocEntity;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class IpHelperTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFind()
    {
        $ip = "127.0.0.1";
        $result = IpHelper::getRegionByIp($ip);
        Assert::assertTrue($result->isSuccess());
        $data = $result->getData();
        Assert::assertEquals(IpLocEntity::class, get_class($data));
        if ($data instanceof IpLocEntity) {
            Assert::assertEquals("本机地址", $data->getCountry());
            Assert::assertEquals("本机地址", $data->getProvince());
        }
        $ip = "43.227.137.251";
        $result = IpHelper::getRegionByIp($ip);
        var_dump($result);
        $ip = "43.227.137.251";
        $result = IpHelper::getFromPconline($ip);
        var_dump($result);

//        $ip = "3.227.139.167";
//        $result = IpHelper::getRegionByIp($ip);
//        var_dump($result);
//        $ip = "333.333.333.333";
//        $result = IpHelper::getFromPconline($ip);
//        var_dump($result);
//        $ip = "101.37.37.167";
//        $result = IpHelper::getRegionByIp($ip);
//        var_dump($result);
//        $ip = "47.88.216.242";
//        $result = IpHelper::getRegionByIp($ip);
//        var_dump($result);

//        $result = IpHelper::getCountryByIp($ip);
//        var_dump($result);
//        Assert::assertTrue($result->isSuccess());
//        Assert::assertEquals("中国", $result->getData());
//
//        $ip = "47.88.216.242";
//
//        $result = IpHelper::getCountryByIp($ip);
//        var_dump($result);
//        Assert::assertTrue($result->isSuccess());
//        Assert::assertEquals("新加坡", $result->getData());
//
//        $ip = "112.16.93.124";
//        $result = IpHelper::getCountryByIp($ip);
//        Assert::assertTrue($result->isSuccess());
//        Assert::assertEquals("中国", $result->getData());
    }
}
