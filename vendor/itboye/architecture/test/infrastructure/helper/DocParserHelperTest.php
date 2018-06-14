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


use by\component\helper\ReflectionHelper;
use by\infrastructure\helper\CallResultHelper;
use PHPUnit\Framework\TestCase;

class DocParserHelperTest extends TestCase
{

    // member function

    /**
     * testGEtDoc
     * @demo_required demo is required
     * @demo2_required (demo2) is required
     * @group doc_parser
     * @param string $demo
     * @param string $demoTest
     * @return \by\infrastructure\base\CallResult|void
     */
    public function testGetDoc()
    {

        $ref = new \ReflectionClass($this);
        $method = $ref->getMethod('add');
//        $this->assertEquals('add', $method->getName());
        $doc = $method->getDocComment();
//        $params = DocParserHelper::parse($doc);
//        var_dump($params);
//        ReflectionHelper::splitRegex("reg:\d/");
//        ReflectionHelper::splitRegex("reg:\d/ msg:333 ");

//        exit;

        // 下划线优先
        $result = ReflectionHelper::invokeWithArgs($this, 'add', ['demo_test' => '1']);

        $this->assertEquals(false, $result->isSuccess());

        $result = ReflectionHelper::invokeWithArgs($this, 'add', ['demo' => '124444', 'reg_from', 'demoTest' => 12345678901, 'demo_test' => 12345678901]);

        $this->assertEquals(true, $result->isSuccess(), $result->getMsg());
        $data = $result->getData();
        $this->assertEquals(2, $data['demoTest']);
    }

    /**
     *
     * @reg_from_match_regex reg:/^\d{1}$/i msg:regFrom length 1 and only digit
     * @demo_test_match_regex reg:/^\d{1,10}$/i     msg:the type must be integer
     * @demo_match_regex reg:/^\w{3,6}$/i msg:the value length must in 3-6
     * @demo_required demo is required
     * @demo_test_required param demo_test is required
     * @param string $demo
     * @param string $demoTest
     * @return \by\infrastructure\base\CallResult
     */
    public function add($demo = '', $demoTest = '', $regFrom = '')
    {
        return CallResultHelper::success(['demo' => $demo, 'demoTest' => $demoTest]);
    }

}