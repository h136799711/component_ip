<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-17 14:19
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\bookstore\v1\entity;


use by\infrastructure\base\BaseEntity;

/**
 * Class BookSourceEntity
 * 书籍来源-一本书有多个来源
 * @package by\component\bookstore\v1\entity
 */
class BookSourceEntity extends BaseEntity
{
    private $bookId;
    private $bookAddress;
    private $bookSourceAddress;
    private $bookSourceName;

    /**
     * 书地址
     * @return mixed
     */
    public function getBookAddress()
    {
        return $this->bookAddress;
    }

    /**
     * 设置书地址
     * @param mixed $bookAddress
     */
    public function setBookAddress($bookAddress)
    {
        $this->bookAddress = $bookAddress;
    }

    /**
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * @param mixed $bookId
     */
    public function setBookId($bookId)
    {
        $this->bookId = $bookId;
    }

    /**
     * @return mixed
     */
    public function getBookSourceAddress()
    {
        return $this->bookSourceAddress;
    }

    /**
     * @param mixed $bookSourceAddress
     */
    public function setBookSourceAddress($bookSourceAddress)
    {
        $this->bookSourceAddress = $bookSourceAddress;
    }

    /**
     * @return mixed
     */
    public function getBookSourceName()
    {
        return $this->bookSourceName;
    }

    /**
     * @param mixed $bookSourceName
     */
    public function setBookSourceName($bookSourceName)
    {
        $this->bookSourceName = $bookSourceName;
    }
}