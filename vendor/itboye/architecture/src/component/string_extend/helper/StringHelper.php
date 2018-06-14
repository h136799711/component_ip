<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-27 14:26
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\string_extend\helper;

/**
 * Class StringHelper
 * 字符串帮助类
 * @package by\component\string_extend\helper
 */
class StringHelper
{
    /**
     * 仅字母大小写
     */
    const ALPHABET = 1;

    /**
     * 字母 + 数字
     */
    const ALPHABET_AND_NUMBERS = 2;

    /**
     * 仅数字
     */
    const NUMBERS = 3;

    private static $alphaCodeSet = 'abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';

    private static $codeSet = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';

    /**
     * 数字转36进制字符串，默认大写字符串
     * 1. 只支持大于0的转换，小于0 则会返回0
     * @param int $num 待转换数字 大于0
     * @return int|string
     */
    public static function intTo36Hex($num)
    {
        $num = intval($num);
        if ($num <= 0)
            return 0;
        $charArr = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
        $char = '';
        do {
            $key = ($num - 1) % 36;
            $char = $charArr[$key] . $char;
            $num = floor(($num - $key) / 36);
        } while ($num > 0);
        return $char;
    }

    /**
     * utf8编码转GBK编码
     * @param $str
     * @return string
     */
    public static function utf8ToGbk($str)
    {
        return iconv('utf-8', 'gbk', $str);
    }

    /**
     * 支持随机生成只包含数字的随机字符串长度为1-8
     * @param int $length
     * @return int
     */
    public static function randNumbers($length = 6)
    {
        if ($length < 0) $length = 1;
        if ($length > 8) $length = 8;
        $start = pow(10, $length - 1);
        return mt_rand($start, ($start * 10) - 1);
    }

    /**
     * 随机字母+数字
     * @param $length
     * @return string
     */
    public static function randAlphabetAndNumbers($length)
    {
        if ($length < 0) $length = 1;
        if ($length > 64) $length = 64;
        $code = [];
        for ($i = 0; $i < $length; $i++) {
            $code[$i] = self::$codeSet[mt_rand(0, strlen(self::$codeSet) - 1)];
        }
        return implode("", $code);
    }

    /**
     * 随机字母
     * @param $length
     * @return string
     */
    public static function randAlphabet($length)
    {
        if ($length < 0) $length = 1;
        if ($length > 64) $length = 64;
        $code = [];
        for ($i = 0; $i < $length; $i++) {
            $code[$i] = self::$alphaCodeSet[mt_rand(0, strlen(self::$alphaCodeSet) - 1)];
        }
        return implode("", $code);
    }

    // construct

    /**
     * 返回uniqid的md5值
     * @return string
     */
    public static function md5UniqueId()
    {
        return md5(uniqid());
    }

    /**
     * 生成随机字符
     * @param string $type 该帮助类 ALPHABET|ALPHABET_AND_NUMBERS|NUMBERS
     * @param int $length
     * @return int|string
     */
    public static function randStr($type, $length = 6)
    {
        // TODO 生成随机长度的字符串
        if ($type == self::ALPHABET) {
            return self::randAlphabet($length);
        } elseif ($type == self::ALPHABET_AND_NUMBERS) {
            return self::randAlphabetAndNumbers($length);
        } elseif ($type == self::NUMBERS) {
            return self::randNumbers($length);
        }

        return "unknown type";
    }

    /**
     * 转换成骆驼式字符串
     * 注意：
     *  1. 只能处理 (下划线 + 小写字母)这种字符串
     * @param $str
     * @return string
     */
    public static function toCamelCase($str)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ', '', lcfirst($str));
        return $str;
    }

    /**
     * 骆驼式字符串转下划线
     * 默认 每个大写字母都变成下划线 + 小写字母
     * @param $camelCaseStr
     * @param string $separator
     * @return mixed|string
     * @internal param $str
     */
    public static function camelCaseToUnderline($camelCaseStr, $separator = '_')
    {
        $temp_array = array();
        for ($i = 0; $i < strlen($camelCaseStr); $i++) {
            $ascii_code = ord($camelCaseStr[$i]);
            if ($ascii_code >= 65 && $ascii_code <= 90) {
                $temp_array[] = $separator . chr($ascii_code + 32);
            } else {
                $temp_array[] = $camelCaseStr[$i];
            }
        }
        return implode('', $temp_array);
    }
}