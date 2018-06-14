<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 17:01
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\base;


abstract class BaseCallResult
{

    // member function
    private $code;

    // override function __toString()

    // member variables
    private $msg;// 返回的结果码
    private $data;//  返回消息

    public function __construct($data = '', $msg = '', $code = 0)
    {
        $this->setCode($code);
        $this->setMsg($msg);
        $this->setData($data);
    }// 返回数据

    // getter setter

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @param mixed $msg
     */
    public function setMsg($msg)
    {
        $this->msg = $msg;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}