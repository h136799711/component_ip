<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-20 11:29
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\paging\vo;


use by\infrastructure\base\BaseObject;

class PagingParams extends BaseObject
{

    private $pageIndex;
    private $pageSize;

    // construct
    public function __construct($pageIndex = 0, $pageSize = 10)
    {
        $this->setPageIndex($pageIndex);
        $this->setPageSize($pageSize);
    }

    /**
     * @return mixed
     */
    public function getPageIndex()
    {
        return $this->pageIndex;
    }

    /**
     * @param mixed $pageIndex
     */
    public function setPageIndex($pageIndex)
    {
        // 保证大于等于0
        $this->pageIndex = ($pageIndex < 0 ? 0 : $pageIndex);
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * @param mixed $pageSize
     */
    public function setPageSize($pageSize)
    {
        // 保证大于等于1
        $this->pageSize = ($pageSize < 1 ? 1 : $pageSize);
    }
}