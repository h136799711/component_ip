<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-27 14:30
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\consumer;


use by\component\mq\builder\BindBuilder;
use by\component\mq\config\MQConfig;
use by\component\mq\core\Binding;
use by\component\mq\core\Consumer;
use by\component\mq\core\Queue;
use by\component\mq\facade\RabbitAdmin;
use by\component\mq\factory\ConnectionFactory;
use by\component\mq\interfaces\ConsumerInterface;
use by\component\mq\interfaces\ExchangeInterface;
use PhpAmqpLib\Channel\AMQPChannel;

abstract class DefaultConsumer extends Consumer implements ConsumerInterface
{

    /**
     * 是否需要consumer返回确认通知
     * @var boolean
     */
    private $noAck;
    /**
     * 队列与交换机的绑定关系
     * @var Binding
     */
    private $binding;
    /**
     * rabbit控制器
     * @var RabbitAdmin
     */
    private $admin;

    public function __construct(MQConfig $config, $name = '')
    {
        parent::__construct($name);
        // 总控初始化
        $this->admin = new RabbitAdmin(new ConnectionFactory($config->getHost(), $config->getUsername(), $config->getPassword(), $config->getVhost()));
    }

    /**
     * @return bool
     */
    public function isNoAck()
    {
        return $this->noAck;
    }

    /**
     * @param bool $noAck
     */
    public function setNoAck($noAck)
    {
        $this->noAck = $noAck;
    }

    public function getQueueName()
    {
        return $this->binding->getQueueName();
    }

    public function getConsumerTag()
    {
        return '';
    }

    public function close()
    {
        if ($this->admin) {
            $this->admin->close();
        }
    }

    public function __destruct()
    {
        $this->close();
    }

    public function ready(Queue $queue, ExchangeInterface $exchange = null, $routingKey = '')
    {
        // 队列-交换机-绑定关系定义
        $this->binding = BindBuilder::queue($queue)->bind($exchange)->with($routingKey)->build();
        $this->admin->declareExchange($exchange)->declareQueue($queue)->bind($this->binding);
    }

    public function subscribe()
    {
        $this->admin->subscribe($this);
    }

    public function onMessage($msg)
    {
        //@var AMQPChannel
        $channel = $msg->delivery_info['channel'];
        if ($channel instanceof AMQPChannel) {
            $channel->basic_ack($msg->delivery_info['delivery_tag']);
        }
    }

    /**
     * @return RabbitAdmin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param RabbitAdmin $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }

}