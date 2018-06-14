<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 15:02
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\facade;


use by\component\mq\core\Binding;
use by\component\mq\core\Queue;
use by\component\mq\factory\ConnectionFactory;
use by\component\mq\interfaces\ConsumerInterface;
use by\component\mq\interfaces\ExchangeInterface;
use by\component\mq\message\BaseMessage;

class RabbitAdmin
{

    // member function

    private $connectionFactory;
    private $lastDeclareQueueInfo;
    private $lastDeclareExchangeInfo;


    public function __destruct()
    {
        $this->connectionFactory->close();
    }

    public function __construct(ConnectionFactory $factory)
    {
        $this->connectionFactory = $factory;
    }

    /**
     * 队列
     * @param Queue $queue
     * @return RabbitAdmin
     */
    public function declareQueue(Queue $queue)
    {
        $this->setLastDeclareQueueInfo($this->connectionFactory->declareQueue($queue));
        return $this;
    }

    /**
     * 交换机
     * @param  ExchangeInterface $exchange
     * @return RabbitAdmin
     */
    public function declareExchange(ExchangeInterface $exchange = null)
    {
        if (!$exchange) {
            return $this;
        }
        $this->setLastDeclareExchangeInfo($this->connectionFactory->declareExchange($exchange));
        return $this;
    }

    /**
     * 绑定关系
     * @param Binding $binding
     * @return RabbitAdmin
     */
    public function bind(Binding $binding)
    {
        $this->connectionFactory->binding($binding);
        return $this;
    }

    /**
     * 订阅
     * @param ConsumerInterface $consumer
     * @return RabbitAdmin
     */
    public function subscribe($consumer)
    {
        $this->connectionFactory->consumer($consumer);
        return $this;
    }

    /**
     * 发布
     * @param BaseMessage $message
     * @param Binding $binding
     * @return RabbitAdmin
     */
    public function publish(BaseMessage $message, Binding $binding)
    {
        $this->connectionFactory->basicSend($message, $binding);
        return $this;
    }

    public function close()
    {
        $this->connectionFactory->close();
    }

    /**
     * @return mixed
     */
    public function getLastDeclareQueueInfo()
    {
        return $this->lastDeclareQueueInfo;
    }

    /**
     * @param mixed $lastDeclareQueueInfo
     */
    private function setLastDeclareQueueInfo($lastDeclareQueueInfo)
    {
        $this->lastDeclareQueueInfo = $lastDeclareQueueInfo;
    }

    /**
     * @return mixed
     */
    public function getLastDeclareExchangeInfo()
    {
        return $this->lastDeclareExchangeInfo;
    }

    /**
     * @param mixed $lastDeclareExchangeInfo
     */
    private function setLastDeclareExchangeInfo($lastDeclareExchangeInfo)
    {
        $this->lastDeclareExchangeInfo = $lastDeclareExchangeInfo;
    }

}