<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:58
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;


use by\component\mq\factory\ConnectionFactory;
use by\infrastructure\helper\ArrayHelper;
use PhpAmqpLib\Channel\AMQPChannel;

/**
 * Class Channel
 * @package by\component\mq\core
 */
class Channel
{
    // member function
    /**
     * @var ConnectionFactory
     *
     */
    private $connectionFactory;


    // construct
    /**
     * @var AMQPChannel
     *
     */
    private $channel;


    // override function __toString()

    // member variables
    private $channelId;
    private $autoDecode;

    public function __construct(ConnectionFactory $factory)
    {
        $this->connectionFactory = $factory;
        if (!$this->connectionFactory->getAMQPConnection()->isConnected()) {
            throw new \Exception('AMQP connection is not connect');
        }
        $this->setChannelId(null);
        $this->setAutoDecode(true);
    }

    public function setAckHandler($callback)
    {
        $this->channel->set_ack_handler($callback);
    }

    public function setNAckHandler($callback)
    {
        $this->channel->set_nack_handler($callback);
    }

    public function setReturnHandler($callback)
    {
        $this->channel->set_return_listener($callback);
    }

    /**
     * 设置消息传输内容限制长度
     * @param $maxBytes
     */
    public function setBodySizeLimit($maxBytes)
    {
        $this->channel->setBodySizeLimit($maxBytes);
    }

    /**
     * body_size_limit
     * @param array $config
     */
    public function create($config = [])
    {
        $this->channel = new AMQPChannel($this->connectionFactory->getAMQPConnection(), $this->getChannelId(), $this->getAutoDecode());
        $bodySizeLimit = ArrayHelper::getValue('body_size_limit', $config);
        if (!empty($bodySizeLimit)) {
            $this->setBodySizeLimit($bodySizeLimit);
        }
    }


    // getter setter

    /**
     * @return mixed
     */
    public function getChannelId()
    {
        return $this->channelId;
    }

    /**
     * @param mixed $channelId
     */
    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }

    /**
     * @return mixed
     */
    public function getAutoDecode()
    {
        return $this->autoDecode;
    }

    /**
     * @param mixed $autoDecode
     */
    public function setAutoDecode($autoDecode)
    {
        $this->autoDecode = $autoDecode;
    }

    /**
     * @return AMQPChannel
     */
    public function getAMQPChannel()
    {
        return $this->channel;
    }

    /**
     * @param AMQPChannel $channel
     */
    public function setAMQPChannel($channel)
    {
        $this->channel = $channel;
    }

    /**
     * @return ConnectionFactory
     */
    public function getConnectionFactory()
    {
        return $this->connectionFactory;
    }

}