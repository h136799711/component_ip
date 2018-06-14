<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:30
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;


class Queue
{

    // member function

    // construct
    private $name;

    // override function __toString()
    private $durable;
    private $exclusive;
    private $passive;
    private $nowait;
    private $autoDelete;
    private $ttl;
    private $deadLetterExchange;
    private $deadLetterRoutingKey;

    /**
     * @var
     */
    private $arguments;

    /**
     * Queue constructor.
     * @param string $name
     */
    public function __construct($name)
    {
        $this->setName($name);
        $this->setAutoDelete(true);
        $this->setDurable(false);
        $this->setExclusive(false);
        $this->setNowait(false);
        $this->setPassive(false);
        $this->setArguments([]);
    }

    /**
     * @return mixed
     */
    public function getDeadLetterExchange()
    {
        return $this->deadLetterExchange;
    }

    /**
     * @param mixed $deadLetterExchange
     */
    public function setDeadLetterExchange($deadLetterExchange)
    {
        $this->deadLetterExchange = $deadLetterExchange;
        $this->arguments['x-dead-letter-exchange'] = $deadLetterExchange;
    }

    /**
     * @return mixed
     */
    public function getDeadLetterRoutingKey()
    {
        return $this->deadLetterRoutingKey;
    }

    /**
     * @param mixed $deadLetterRoutingKey
     */
    public function setDeadLetterRoutingKey($deadLetterRoutingKey)
    {
        $this->deadLetterRoutingKey = $deadLetterRoutingKey;
        $this->arguments['x-dead-letter-routing-key'] = $deadLetterRoutingKey;
    }

    /**
     * @return mixed
     */
    public function getTtl()
    {
        return $this->ttl;
    }

    /**
     * @param mixed $ttl
     */
    public function setTtl($ttl)
    {
        $this->ttl = $ttl;
        $this->arguments['x-message-ttl'] = ($ttl);
    }

    /**
     * @return mixed
     */
    public function getPassive()
    {
        return $this->passive;
    }

    /**
     * @param mixed $passive
     */
    public function setPassive($passive)
    {
        $this->passive = $passive;
    }

    /**
     * @return mixed
     */
    public function getNowait()
    {
        return $this->nowait;
    }

    /**
     * @param mixed $nowait
     */
    public function setNowait($nowait)
    {
        $this->nowait = $nowait;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDurable()
    {
        return $this->durable;
    }

    /**
     * @param mixed $durable
     */
    public function setDurable($durable)
    {
        $this->durable = $durable;
    }

    /**
     * @return mixed
     */
    public function getExclusive()
    {
        return $this->exclusive;
    }

    /**
     * @param mixed $exclusive
     */
    public function setExclusive($exclusive)
    {
        $this->exclusive = $exclusive;
    }

    /**
     * @return mixed
     */
    public function getAutoDelete()
    {
        return $this->autoDelete;
    }

    /**
     * @param mixed $autoDelete
     */
    public function setAutoDelete($autoDelete)
    {
        $this->autoDelete = $autoDelete;
    }

    /**
     * @return mixed
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param mixed $arguments
     */
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }


}