<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:32
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;

use PhpAmqpLib\Connection\AbstractConnection;
use PhpAmqpLib\Connection\AMQPStreamConnection;

/**
 * Class Connection
 * 包装了AMQPConnection
 * @package by\component\mq\core
 */
class Connection
{

    // member function
    /**
     * @var AbstractConnection
     */
    private $connection;

    // construct
    private $username;

    // override function __toString()

    // member variables
    private $password;
    private $host;
    private $vhost;
    private $port;

    public function __construct($host, $username = '', $password = '', $vhost = '/', $port = '5672')
    {
        $this->setHost($host);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setPort($port);
        $this->setVhost($vhost);
    }

    public function create()
    {
        $insist = false;
        $login_method = 'AMQPLAIN';
        $login_response = null;
        $locale = 'en_US';
        $heartbeat = 60; //默认心跳时间
        $connection_timeout = 3.0;
        $read_write_timeout = 2 * $heartbeat;
        $context = null;
        $keepAlive = false;
        $this->connection = new AMQPStreamConnection($this->getHost(), $this->getPort(), $this->getUsername(), $this->getPassword(), $this->getVhost(), $insist, $login_method, $login_response, $locale, $connection_timeout, $read_write_timeout, $context, $keepAlive, $heartbeat);
    }


    // getter setter

    /**
     * @return mixed
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param mixed $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getVhost()
    {
        return $this->vhost;
    }

    /**
     * @param mixed $vhost
     */
    public function setVhost($vhost)
    {
        $this->vhost = $vhost;
    }

    /**
     * @return AbstractConnection
     */
    public function getConnection()
    {
        // 不存在则创建
        if (!$this->connection) {
            $this->create();
        }
        // 存在但是断开的，则重连
        if (!$this->connection->isConnected()) {
            $this->connection->reconnect();
        }
        return $this->connection;
    }

}