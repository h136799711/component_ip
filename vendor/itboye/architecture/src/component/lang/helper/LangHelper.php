<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-14 19:57
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\lang\helper;


/**
 * Class LangHelper
 * 语言帮助类
 * @package by\component\lang\helper
 */
class LangHelper
{
    /**
     * lang函数如果存在则调用lang函数
     * @param $name
     * @param array $vars
     * @param string $lang
     * @return mixed
     */
    public static function lang($name, $vars = [], $lang = '')
    {
        if (function_exists('lang')) {
            return lang($name, $vars, $lang);
        }

        return $name;
    }
}