<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-05 11:13
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\bookstore\entity;


use by\component\bookstore\v1\entity\BookEntity;
use PHPUnit\Framework\TestCase;

class BookEntityTest extends TestCase
{
    /**
     *
     */
    public function testNewEntity()
    {
        $bookEntity = new BookEntity();

        $bookEntity->setAuthorId(11);
        $bookEntity->setAuthorName('hebidu');

        $data = $bookEntity->toArray();

        $this->assertArrayHasKey('author_id', $data);
        $this->assertArrayHasKey('author_name', $data);
        $this->assertEquals(11, $data['author_id']);
        $this->assertEquals('hebidu', $data['author_name']);
    }

}