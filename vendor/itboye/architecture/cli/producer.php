<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 17:41
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byCli;

use by\component\mq\core\Queue;
use by\component\mq\exchanges\DirectExchange;
use by\component\mq\message\JsonMessage;
use by\component\mq\producer\DefaultProducer;
use byCli\mq\DefaultMQConfig;

require_once '../vendor/autoload.php';

$routingKey = 'qqav.club.test.topic.delete';

// 定义路由交换机
$exchange = new DirectExchange('direct_exchange');
// 定义队列
$queue = new Queue('ttl_direct_queue');
$queue->setPassive(false);
$queue->setTtl(60000);
$queue->setDeadLetterExchange('dead.exchange');
$queue->setDeadLetterRoutingKey('dead_letter');

var_dump($queue->getArguments());
$producer = new DefaultProducer(new DefaultMQConfig());
$producer->ready($queue, $exchange, $routingKey);

// 创建消息
$message = new JsonMessage();

$cnt = 2;
while ($cnt--) {
    $body = json_encode(['username' => 'hebidu', 'nickname' => '何必都']);
    $total = strlen($body);
    $message->setBodySize($total);
    $message->setBody($cnt . $body);
    $message->setExpiration("5000");
    $message->setImmeadiate(false);
    $producer->produce($message);
    usleep(500);
//    echo $cnt;
}
$producer->close();
$producer = null;


