<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-13 18:29
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\ip;


use by\component\ip\helper\IpHelper;
use PHPUnit\Framework\TestCase;

class IpHelperTest extends TestCase
{

    public function testGetClientIp()
    {
        $ip = IpHelper::getClientIp(1);

        $this->assertEquals(0, $ip);

    }
}