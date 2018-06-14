<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-31 10:17
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;

use by\component\mq\interfaces\ExchangeInterface;
use by\component\mq\message\BaseMessage;


/**
 * Class Producer
 * 生产者
 * @package by\component\mq\core
 */
abstract class Producer
{
    /**
     * 生产者名称
     * @return mixed
     */
    abstract function getName();

    abstract function ready(Queue $queue, ExchangeInterface $exchange = null, $routingKey = '');

    abstract function close();

    /**
     * 生产者->生产线-》队列
     * @return mixed
     */
    //abstract function getQueue();

    /**
     * 生产后的产品送往该交换机处
     * @return mixed
     */
    //abstract function getExchange();

    /**
     * 生产产品
     * @param BaseMessage $message
     * @return mixed
     */
    abstract function produce(BaseMessage $message);
}