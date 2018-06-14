<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-13 18:23
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\ip\helper;


class IpHelper
{
    /**
     * 获取客户端IP地址
     * @param integer $type 返回类型 0 返回IP地址 1 返回IPV4地址数字
     * @param boolean $adv 是否进行高级模式获取（有可能被伪装）
     * @return mixed
     */
    public static function getClientIp($type = 0, $adv = true)
    {
        if ($_SERVER) {
            $type = $type ? 1 : 0;
            static $ip = NULL;
            if ($ip !== NULL) return $ip[$type];
            if ($adv) {
                if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                    $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                    $pos = array_search('unknown', $arr);
                    if (false !== $pos) unset($arr[$pos]);
                    $ip = trim($arr[0]);
                } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
                } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                    $ip = $_SERVER['REMOTE_ADDR'];
                }
            } elseif (isset($_SERVER['REMOTE_ADDR'])) {
                $ip = $_SERVER['REMOTE_ADDR'];
            }
            // IP地址合法验证
            $long = sprintf("%u", ip2long($ip));
            $ip = $long ? array($ip, $long) : array('0.0.0.0', 0);
            return $ip[$type];
        } else {
            return 0;
        }
    }
}