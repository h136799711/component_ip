<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:55
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\factory;

use by\component\mq\core\Binding;
use by\component\mq\core\Channel;
use by\component\mq\core\Connection;
use by\component\mq\core\Queue;
use by\component\mq\interfaces\ConsumerInterface;
use by\component\mq\interfaces\ExchangeInterface;
use by\component\mq\interfaces\MessageInterface;
use by\component\mq\message\BaseMessage;
use by\infrastructure\helper\ArrayHelper;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

class ConnectionFactory
{

    // member function
    private $config = [
//        'body_size_limit'=>50
    ];
    private $ackCallback;
    /**
     * 目前一个连接对象
     * @var Connection
     *
     */
    private $connection;
    /**
     * @var
     * 一个channel
     */
    private $channel;

    public function __construct($host, $username = '', $password = '', $vhost = '/', $port = '5672')
    {
        $this->connection = new Connection($host, $username, $password, $vhost, $port);
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        if ($this->getAMQPChannel()) {
            $this->getAMQPChannel()->close();
        }
        if ($this->getAMQPConnection()) {
            $this->getAMQPConnection()->close();
        }
    }

    public function getAMQPChannel()
    {
        return $this->getChannel()->getAMQPChannel();
    }

    /**
     *
     * @return Channel
     */
    public function getChannel()
    {
        if (!$this->channel) {
            $this->channel = new Channel($this);
            // chanel 创建 增加参数
            $this->channel->create($this->config);
            if ($this->ackCallback) {
                $this->channel->setAckHandler($this->ackCallback);
            }
        }

        return $this->channel;
    }

    public function getAMQPConnection()
    {
        return $this->connection->getConnection();
    }


    public function consumer(ConsumerInterface $consumer)
    {

        $callback = array($consumer, 'onMessage');
        $onAck = $consumer->isNoAck();

        // 只有consumer已经处理并确认了上一条message时queue才分派新的message给它
        $this->getAMQPChannel()->basic_qos(null, 1, null);

        $this->getAMQPChannel()->basic_consume($consumer->getQueueName(), $consumer->getConsumerTag(), false, $onAck, false, false, $callback);

        $pcntlEnable = false;
        if (function_exists('pcntl_signal')) {
            $pcntlEnable = true;
        }

        $closeConnection = function ($msg) use ($consumer) {
            $consumer->close();
            exit(0);
        };
        if ($pcntlEnable) {
            declare(ticks=1);
            pcntl_signal(SIGTERM, $closeConnection);
        }
        while (count($this->getAMQPChannel()->callbacks)) {
            $this->getAMQPChannel()->wait();
        }

    }

    public function basicSend(BaseMessage $message, Binding $binding)
    {
        $msg = new AMQPMessage();
        $msg->setIsTruncated($message->getTruncated());
        if ($message->getBodySize() > 0) {
            $msg->setBodySize($message->getBodySize());
        }
        $msg->setBody($message->getBody());
        $mandatory = false;
        $immediate = false;

        if ($message instanceof MessageInterface) {
            $mandatory = $message->getMandatory();
            $immediate = $message->getImmeadiate();
        }

        if ($message->getExpiration() > 0) {
            $msg->set('expiration', $message->getExpiration());
            $msg->set('delivery_mode', AMQPMessage::DELIVERY_MODE_PERSISTENT);
        }
        $this->getAMQPChannel()->basic_publish($msg, $binding->getExchange(), $binding->getRoutingKey(), $mandatory, $immediate);
    }

    /**
     * 绑定生效 队列x交换机
     * @param Binding $binding
     * @return mixed|null
     */
    public function binding(Binding $binding)
    {
        if (!empty($binding->getExchange())
            && !empty($binding->getRoutingKey())) {
            return $this->getAMQPChannel()->queue_bind($binding->getQueueName(), $binding->getExchange(), $binding->getRoutingKey(), $binding->getNowait());
        }
        return null;
    }

    /**
     * 创建一个队列
     * @param Queue $queue
     * @return mixed|null
     */
    public function declareQueue(Queue $queue)
    {

        $arguments = $this->getAMQPTable($queue->getArguments());
        return $this->getAMQPChannel()->queue_declare($queue->getName(), $queue->getPassive(), $queue->getDurable(), $queue->getExclusive(), $queue->getAutoDelete(), $queue->getNowait(), $arguments);
    }


    /**
     * 声明一个交换机
     * @param ExchangeInterface $exchange
     * @return mixed|null
     */
    public function declareExchange(ExchangeInterface $exchange)
    {
        if ($exchange == null) {
            return null;
        }
        $arguments = $exchange->getArguments();
        $instance = ArrayHelper::getInstance()->from($arguments);
        $passive = $instance->getValueBy('passive', false);
        $durable = $instance->getValueBy('durable', false);
        $autoDelete = $instance->getValueBy('auto_delete', true);
        $internal = $instance->getValueBy('internal', false);
        $nowait = $instance->getValueBy('nowait', false);
        $ticket = $instance->getValueBy('ticket', null);
        ArrayHelper::filter($arguments, ['passive', 'durable', 'auto_delete']);

        return $this->getAMQPChannel()->exchange_declare($exchange->getName(), $exchange->getExchangeType(), $passive, $durable, $autoDelete, $internal, $nowait, $arguments, $ticket);
    }

    private function getAMQPTable($args)
    {
        if (empty($args)) return null;
        $table = new AMQPTable();
        foreach ($args as $key => $vo) {
            $table->set($key, $vo);
        }
        return $table;
    }

    // construct

    /**
     *
     * @return Channel
     */
    public function getNewChannel()
    {
        $this->channel = new Channel($this);
        return $this->channel;
    }

    // override function __toString()

    // member variables

    public function getConnection()
    {
        return $this->connection;
    }

    public function setUsername($username)
    {
        $this->connection->setUsername($username);
    }

    /**
     * @return mixed
     */
    public function getAckCallback()
    {
        return $this->ackCallback;
    }

    /**
     * @param mixed $ackCallback
     */
    public function setAckCallback($ackCallback)
    {
        $this->ackCallback = $ackCallback;
    }
    // getter setter

}