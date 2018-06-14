<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 16:51
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\base;


use by\infrastructure\helper\Object2DataArrayHelper;
use by\infrastructure\interfaces\ObjectToArrayInterface;

abstract class BaseEntity extends BaseObject implements ObjectToArrayInterface
{

    public function toArray()
    {
        return Object2DataArrayHelper::getDataArrayFrom($this);
    }

    // member function

    // construct
    private $id;

    // override function __toString()

    // member variables
    private $createTime;//数据id
    private $updateTime; // 创建时间

    public function __construct()
    {
        $this->setCreateTime(time());
        $this->setUpdateTime(time());
    }

    // getter setter

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreateTime()
    {
        return $this->createTime;
    }

    /**
     * @param mixed $createTime
     */
    public function setCreateTime($createTime)
    {
        $this->createTime = $createTime;
    }

    /**
     * @return mixed
     */
    public function getUpdateTime()
    {
        return $this->updateTime;
    }

    /**
     * @param mixed $updateTime
     */
    public function setUpdateTime($updateTime)
    {
        $this->updateTime = $updateTime;
    }


}