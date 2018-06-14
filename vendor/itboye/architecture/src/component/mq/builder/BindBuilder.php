<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-27 10:59
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\builder;


use by\component\mq\core\Binding;
use by\component\mq\core\Queue;
use by\component\mq\interfaces\ExchangeInterface;

class BindBuilder
{

    private static $instance;
    /**
     * @var Queue
     */
    private $queue;

    /**
     * @var ExchangeInterface
     */
    private $exchange;
    private $routingKey;


    public static function queue(Queue $queue)
    {
        $builder = self::getInstance();
        $builder->setQueue($queue);
        return $builder;
    }

    /**
     * @param ExchangeInterface $exchange
     * @return BindBuilder
     */
    public function bind(ExchangeInterface $exchange = null)
    {
        $builder = self::getInstance();
        $builder->setExchange($exchange);
        return $builder;
    }

    public function with($routingKey)
    {
        $builder = self::getInstance();
        $builder->setRoutingKey($routingKey);
        return $builder;
    }

    public function build()
    {
        return new Binding($this->getQueue(), $this->getExchange(), $this->getRoutingKey());
    }

    private function clear()
    {
        $this->queue = null;
        $this->exchange = null;
        $this->routingKey = '';
    }

    private static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new BindBuilder();
        }
        return self::$instance;
    }

    /**
     * @return Queue
     */
    public function getQueue()
    {
        return $this->queue;
    }

    /**
     * @param Queue $queue
     */
    public function setQueue($queue)
    {
        $this->queue = $queue;
    }

    /**
     * @return ExchangeInterface
     */
    public function getExchange()
    {
        return $this->exchange;
    }

    /**
     * @param ExchangeInterface $exchange
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