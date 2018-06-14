<?php
/**
 * Created by PhpStorm.
 * User: itboye
 * Date: 2018/6/14
 * Time: 18:00
 */

namespace byTest;


use by\component\ipAddress\IpHelper;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class IpHelperTest extends TestCase
{
    /**
     * @throws \Exception
     */
    public function testFind()
    {
        $ip = "101.37.37.167";

        $result = IpHelper::getCountryByIp($ip);
        var_dump($result);
        Assert::assertTrue($result->isSuccess());
        Assert::assertEquals("中国", $result->getData());

        $ip = "47.88.216.242";

        $result = IpHelper::getCountryByIp($ip);
        var_dump($result);
        Assert::assertTrue($result->isSuccess());
        Assert::assertEquals("新加坡", $result->getData());

        $ip = "112.16.93.124";
        $result = IpHelper::getCountryByIp($ip);
        Assert::assertTrue($result->isSuccess());
        Assert::assertEquals("中国", $result->getData());
    }
}