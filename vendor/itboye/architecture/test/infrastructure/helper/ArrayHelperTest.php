<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 11:13
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\infrastructure\helper;


use by\infrastructure\helper\ArrayHelper;
use PHPUnit\Framework\TestCase;

class ArrayHelperTest extends TestCase
{

    // member function

    /**
     * @covers ArrayHelper::getValueBy()
     * @uses   ArrayHelper
     * @group helper
     * @group array_helper
     */
    public function testArrayHelperGetValueBy()
    {

        $arguments = [
            'passive' => true,
            'auto_delete' => false,
            'ticket' => []
        ];
        $instance = ArrayHelper::getInstance()->from($arguments);
        $passive = $instance->getValueBy('passive', false);
        $autoDelete = $instance->getValueBy('auto_delete', true);
        $ticket = $instance->getValueBy('ticket', null);
        $ticket2 = $instance->getValueBy('ticket2', null);

        $this->assertEquals(true, $passive);
        $this->assertEquals(false, $autoDelete);
        $this->assertEquals([], $ticket);
        $this->assertEquals(null, $ticket2);
    }

    /**
     * @covers ArrayHelper::filter
     * @uses   ArrayHelper
     * @group helper
     * @group ArrayHelper
     */
    public function testFilter()
    {
        $data = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];
        $data2 = ['k1' => 1, 'k2' => 2, 'k3' => 3, 'k4' => 4];
        $key = [3, 4, 5, 6];
        $key2 = ['k2', 'k3'];
        $lengthOfData = count($data);
        $lengthOfData2 = count($data2);
        ArrayHelper::filter($data, $key);
        $this->assertEquals($lengthOfData - count($key), count($data));
        ArrayHelper::filter($data2, $key2);
        $this->assertEquals($lengthOfData2 - count($key2), count($data2));
    }


    // override function __toString()

    // member variables

    // getter setter

}