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


use by\component\mq\interfaces\ExchangeInterface;

class Binding
{
    private $queueName;
    private $exchange;
    private $routingKey;
    private $nowait;

    public function __construct(Queue $queue, ExchangeInterface $exchange = null, $routingKey = '')
    {
        $this->setQueueName($queue->getName());
        $this->setRoutingKey($routingKey);
        if ($exchange) {
            $this->setExchange($exchange->getName());
        }
        $this->setNowait(false);
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
    public function getQueueName()
    {
        return $this->queueName;
    }

    /**
     * @param mixed $queueName
     */
    public function setQueueName($queueName)
    {
        $this->queueName = $queueName;
    }

    /**
     * @return mixed
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @param mixed $exchange
     */
    public function setExchange($exchange)
    {
        $this->exchange = $exchange;
    }

    /**
     * @return mixed
     */
    public function getRoutingKey()
    {
        return $this->routingKey;
    }

    /**
     * @param mixed $routingKey
     */
    public function setRoutingKey($routingKey)
    {
        $this->routingKey = $routingKey;
    }


}