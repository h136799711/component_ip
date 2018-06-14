<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 16:20
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\message;

/*
 * 基础队列消息对象
 * @author hebidu <email:346551990@qq.com> 
 * @modify 2017-10-26 13:44:00
 */
use by\component\mq\interfaces\MessageInterface;

abstract class BaseMessage implements MessageInterface
{

    // member function
    abstract function convert();

    /**
     * 消息过期时间
     * @var  integer
     */
    private $expiration;

    /**
     * TODO 未明白有什么作用
     * @var boolean
     */
    private $truncated;
    /**
     * 消息长度 可用strlen($body)得出-UTF-8编码
     * @var integer
     */
    private $bodySize;

    /**
     * 消息主体
     * @var string
     */
    private $body;

    /**
     * 是否强制
     * @var  boolean
     */
    private $mandatory;
    /**
     * 是否直接
     * @var boolean
     */
    private $immeadiate;

    public function __construct()
    {
        $this->setBodySize(0);
        $this->setBody('');
        $this->setTruncated(false);
        $this->setImmeadiate(false);
        $this->setMandatory(false);
    }


    /**
     * @return int
     */
    public function getExpiration()
    {
        return $this->expiration;
    }

    /**
     * @param int $expiration
     */
    public function setExpiration($expiration)
    {
        $this->expiration = $expiration;
    }

    /**
     * @return boolean
     */
    public function getTruncated()
    {
        return $this->truncated;
    }

    /**
     * @param boolean $truncated
     */
    public function setTruncated($truncated)
    {
        $this->truncated = $truncated;
    }

    /**
     * @return mixed
     */
    public function getBodySize()
    {
        return $this->bodySize;
    }

    /**
     * @param mixed $bodySize
     */
    public function setBodySize($bodySize)
    {
        $this->bodySize = $bodySize < 0 ? 0 : $bodySize;
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return bool
     */
    public function isMandatory()
    {
        return $this->mandatory;
    }

    /**
     * @param bool $mandatory
     */
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
    }

    /**
     * @return bool
     */
    public function isImmeadiate()
    {
        return $this->immeadiate;
    }

    /**
     * @param bool $immeadiate
     */
    public function setImmeadiate($immeadiate)
    {
        $this->immeadiate = $immeadiate;
    }

}