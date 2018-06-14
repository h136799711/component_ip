<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-15 19:10
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\encrypt;


use by\component\encrypt\md5v3\DataStructEntity;
use by\component\encrypt\md5v3\Md5V3Transport;
use PHPUnit\Framework\TestCase;

class Md5V3TransportTest extends TestCase
{

    /**
     * @throws \by\component\encrypt\exception\CryptException
     */
    public function testTrans()
    {
        $data = [
            'accepter' => '123',
            'code_type' => '1',
            'code_create_way' => 6,
            'code_length' => 6];
        $entity = new DataStructEntity();
        $entity->setNotifyId(strval(time()));
        $entity->setClientId('test');
        $entity->setClientSecret('test_secret');
        $entity->setAppType('pc');
        $entity->setAppVersion('100');
        $entity->setType('By_SecurityCode_create');
        $entity->setApiVer('100');
        $entity->setTime(time());
        $entity->setData($data);
        $transport = new Md5V3Transport();
        var_dump($entity->toArray());
        $encrypt = $transport->encrypt($entity->toArray());
        var_dump($encrypt);
        $encrypt['client_secret'] = 'test_secret';
        $decrypt = $transport->decrypt($encrypt);
        var_dump($decrypt);
    }

}