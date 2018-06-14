<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-09 10:52
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\bookstore\v1\entity;


use by\infrastructure\base\BaseEntity;

/**
 * Class AuthorEntity
 * 作者信息
 * @package by\component\bookstore\v1\entity
 */
class AuthorEntity extends BaseEntity
{
    /**
     * 笔名
     * @var string
     */
    private $penName;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getPenName()
    {
        return $this->penName;
    }

    // construct

    /**
     * @param mixed $penName
     */
    public function setPenName($penName)
    {
        $this->penName = $penName;
    }

}