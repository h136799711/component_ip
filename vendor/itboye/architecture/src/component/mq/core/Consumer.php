<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-27 14:18
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\core;


use by\component\mq\interfaces\ExchangeInterface;
use by\infrastructure\helper\StringHelper;

/**
 * Class Consumer
 * 消费着抽象类
 * @package by\component\mq\core
 */
abstract class Consumer
{

    abstract function ready(Queue $queue, ExchangeInterface $exchange = null, $routingKey = '');

    abstract function close();

    private $name;

    /**
     * Consumer constructor.
     * @param string $name 消费者标识名称，可不传，默认生成随机字符串 cms_ 前缀
     */
    function __construct($name = '')
    {
        if (empty($name)) {
            $name = 'csm_' . StringHelper::md5UniqueId();
        }
        $this->setName($name);

    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }


}