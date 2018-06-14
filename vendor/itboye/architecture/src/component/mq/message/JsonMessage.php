<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 15:46
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\message;

/**
 * Class JsonMessage
 * json 消息
 * @author hebidu <email:346551990@qq.com>
 * @modify 2017-10-27 14:52:16
 * @package by\component\mq\message
 */
class JsonMessage extends BaseMessage
{

    // member function


    /**
     * 是否强制
     * @var  boolean
     */
    private $mandatory;
    /**
     * 是否直接
     * @var boolean
     */
    private $immeadiate;

    // member variables

    public function __construct()
    {
        parent::__construct();
    }

    public function convert()
    {
        return $this->getBody();
    }

    /**
     * @return mixed
     */
    public function getMandatory()
    {
        return $this->mandatory;
    }

    /**
     * @param mixed $mandatory
     */
    public function setMandatory($mandatory)
    {
        $this->mandatory = $mandatory;
    }

    /**
     * @return mixed
     */
    public function getImmeadiate()
    {
        return $this->immeadiate;
    }

    /**
     * @param mixed $immeadiate
     */
    public function setImmeadiate($immeadiate)
    {
        $this->immeadiate = $immeadiate;
    }


    // getter setter

}