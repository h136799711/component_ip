<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 17:01
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\helper;

use by\component\lang\helper\LangHelper;
use by\infrastructure\base\CallResult;

/**
 * 所有调用结果的帮助
 * Class CallResultHelper
 * @package by\infrastructure
 */
class CallResultHelper
{

    // member function

    public function __construct()
    {
        // TODO construct
    }

    public static function success($data = '', $msg = 'success', $code = 0)
    {
        if ($msg === 'success') $msg = LangHelper::lang($msg);

        return new CallResult($data, $msg, $code);
    }

    // construct

    public static function fail($msg = 'fail', $data = '', $code = -1)
    {
        if ($msg === 'fail') $msg = LangHelper::lang($msg);
        return new CallResult($data, $msg, $code);
    }

    // override function __toString()

    // member variables

    // getter setter

}