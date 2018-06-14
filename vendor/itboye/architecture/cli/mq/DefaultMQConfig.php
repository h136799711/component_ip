<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-31 10:53
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byCli\mq;


use by\component\mq\config\MQConfig;

class DefaultMQConfig extends MQConfig
{

    // construct
    public function __construct()
    {
        parent::__construct('47.88.216.242', 'hebidu', '364945361', 'qqav.club');
    }

}