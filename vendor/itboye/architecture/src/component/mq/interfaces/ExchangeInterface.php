<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-26 14:28
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\mq\interfaces;


interface ExchangeInterface
{

    /**
     * @return  string
     */
    function getName();

    /**
     * @return  string
     */
    function getExchangeType();

    /**
     * @return  boolean
     */
    function isDurable();

    /**
     * @return  boolean
     */
    function isAutoDelete();

    /**
     * @return  array
     */
    function getArguments();


    // member function

    // construct

    // override function __toString()

    // member variables

    // getter setter

}