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

use by\component\mq\builder\BindBuilder;
use by\component\mq\consumer\PrintConsumer;
use by\component\mq\core\Queue;
use by\component\mq\exchanges\DirectExchange;
use byCli\mq\DefaultMQConfig;

require_once '../vendor/autoload.php';

$config = new DefaultMQConfig();
$consumer = new PrintConsumer($config);
try {
    // 定义路由交换机
    $routingKey = 'dead_letter';
    $exchange = new DirectExchange('dead.exchange');
    $queueName = 'dead_direct_queue';
    $queue = new Queue($queueName);
    $queue->setDurable(true);
    $queue->setPassive(false);

    $consumer->getAdmin()->declareExchange($exchange)->declareQueue($queue)->bind(BindBuilder::queue($queue)->bind($exchange)->with($routingKey)->build());
    $consumer->ready($queue);
    $consumer->subscribe();
} catch (\Exception $exception) {

} finally {
    $consumer->close();
}


