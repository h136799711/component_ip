<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-09 10:51
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\bookstore\v1\entity;


use by\infrastructure\base\BaseEntity;

/**
 * Class BookEntity
 * 书本实体
 * @package by\component\bookstore\v1
 */
class BookEntity extends BaseEntity
{

    /**
     * 书籍完本
     */
    const STATE_END = 1;

    /**
     * 书籍连载中
     */
    const STATE_Serialize = 0;

    /**
     * 未知
     */
    const STATE_Unknown = -1;

    private $title;
    private $authorId;
    private $authorName;
    private $summary;
    private $thumbnail;
    private $state;
    private $cateId;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * 获取分类id
     * @return mixed
     */
    public function getCateId()
    {
        return $this->cateId;
    }

    /**
     * 设置分类id
     * @param integer $cateId
     */
    public function setCateId($cateId)
    {
        $this->cateId = $cateId;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @param mixed $authorName
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @param mixed $summary
     */
    public function setSummary($summary)
    {
        $this->summary = $summary;
    }

    /**
     * @return mixed
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param mixed $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

}