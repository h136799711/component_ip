<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-27 15:16
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\constants;

/**
 * Class StatusEnum
 * 数据状态枚举
 * @package by\infrastructure\constants
 */
class StatusEnum
{
    /**
     * 已软删除数据
     */
    const SOFT_DELETE = -1;

    /**
     * 正常使用中
     */
    const ENABLE = 1;

    /**
     * 被禁用数据
     */
    const DISABLED = 0;

    public static function getDesc($status)
    {
        switch ($status) {
            case StatusEnum::DISABLED:
                return "已禁用";
            case StatusEnum::ENABLE:
                return "启用";
            case StatusEnum::SOFT_DELETE:
                return "已删除";
            default:
                return "未知";
        }
    }
}