<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-31 10:47
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\config;


class MQConfig
{
    private $host;
    private $username;
    private $password;
    private $vhost;

    // construct
    public function __construct($host = '', $username = '', $password = '', $vhost = '/')
    {
        $this->setHost($host);
        $this->setUsername($username);
        $this->setPassword($password);
        $this->setVhost($vhost);
    }

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

}