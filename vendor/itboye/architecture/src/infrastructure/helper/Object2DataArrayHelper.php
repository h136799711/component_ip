<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-24 16:41
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\helper;


use by\infrastructure\base\BaseEntity;
use by\infrastructure\interfaces\ObjectToArrayInterface;

class Object2DataArrayHelper
{
    public static $cacheReflectionCls = [];
    public static $cacheEntityProperty = [];
    public static $cacheClassProperty = [];

    // member function
    public function __construct()
    {
        // TODO construct
    }

    public static function getAllProperties(\ReflectionClass $refCls)
    {
        $clsName = $refCls->getName();
        $key = str_replace("\\", '_', $clsName);
        if (!array_key_exists($key, self::$cacheClassProperty)) {
            $properties = $refCls->getProperties();
            while (($refCls = $refCls->getParentClass())) {
                $properties = array_merge($refCls->getProperties(), $properties);
            }

            self::$cacheClassProperty[$key] = $properties;
        }

        return self::$cacheClassProperty[$key];
    }

    /**
     * 将对象实例的get函数返回的数据封装为数组,键都是小写字母加下划线形式
     * 支持父类的属性封装,get函数只支持 public 作用域
     * @param object $instance 对象
     * @param array $properties 属性名称数组，属性名称必须是驼峰式
     * @param bool $ignoreNull 是否忽略null值，getter后null值的不会获取到
     * @return array
     */
    public static function getDataArrayFrom($instance, $properties = [], $ignoreNull = true)
    {
        $clsName = get_class($instance);
        $ref = self::getReflectionCls($clsName);
        $data = [];
        if (empty($properties)) {
            $properties = self::getAllProperties($ref);
        }
        foreach ($properties as $vo) {
            if ($vo instanceof \ReflectionProperty) {
                $propName = self::uncamelize($vo->getName());
            } else {
                $propName = self::uncamelize($vo);
            }

            $key = self::convertUnderline($propName);
            $methodName = 'get' . ucfirst($key);

            if ($ref->hasMethod($methodName)) {
                $method = $ref->getMethod($methodName);
                if ($method->isPublic()) {
                    $propValue = $instance->$methodName();
                    if ($ignoreNull && is_null($propValue)) {
                        continue;
                    }

                    if ($propValue instanceof ObjectToArrayInterface) {
                        $data[$propName] = $propValue->toArray();
                    } else {
                        $data[$propName] = $propValue;
                    }
                }
            }
        }
        return $data;
    }

    public static function uncamelize($camelCaps, $separator = '_')
    {
        $temp_array = array();
        for ($i = 0; $i < strlen($camelCaps); $i++) {
            $ascii_code = ord($camelCaps[$i]);
            if ($ascii_code >= 65 && $ascii_code <= 90) {
                $temp_array[] = $separator . chr($ascii_code + 32);
            } else {
                $temp_array[] = $camelCaps[$i];
            }
        }
        return implode('', $temp_array);
    }

    public static function convertUnderline($str)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ', '', lcfirst($str));
        return $str;
    }

    // construct


    /**
     * @param $clsName
     * @return \ReflectionClass
     */
    private static function getReflectionCls($clsName)
    {
        $key = str_replace("\\", '_', $clsName);
//        $key = md5($clsName);
        if (!array_key_exists($key, self::$cacheReflectionCls)) {
            self::$cacheReflectionCls[$key] = new \ReflectionClass($clsName);
        }
        return self::$cacheReflectionCls[$key];
    }


    /**
     * 将传入的键值对数组通过set方法进行赋值到一个类实例的属性
     * 2017-12-19:
     *  性能优化,针对超过1000个的对象进行循环设置，会有一定的性能损失相比于直接设置对象。
     *  包含Entity的注解必须以 Entity 结尾
     *  var {...}Entity
     * 2017-12-18:
     * 增加了对属性也是 BaseEntity 对象的处理，一定要在注解中指明完全的类名
     * 要求：
     * 属性必须是驼峰式且需要set方法作为反射调用
     * 数据数组中键可以是下划线也可以同属性名称一致
     * 不要出现这种属性名称 wh_hH ，改成 wh_hh
     * 例:
     *  数据数组 $data = ['propCame'=>'value1','prop_came'=>'value2']
     *  类
     *  class PropTest {
     *       private $propCame;
     *       public function setPropCame($value){
     *          $this->propCame = $value;
     *       }
     *  }
     *  上述 数据数组的propCame和prop_came都可以转换到PropTest的propCame属性
     * @param $instance
     * @param null $data
     * @param int $level 层级-防止无限递归
     */
    public static function setData($instance, $data = null, $level = 1)
    {
        if ($level === 3) return;

        if (!empty($data) && is_array($data)) {
            $className = get_class($instance);

            $ref = self::getReflectionCls($className);
            $properties = self::getAllProperties($ref);
            foreach ($properties as $obj) {
                $name = $obj->name;
                $varObj = self::isEntityProperty($obj);
                $key = self::uncamelize($name);
                $methodName = 'set' . ucfirst($name);
                if ($ref->hasMethod($methodName)) {

                    $method = $ref->getMethod($methodName);

                    if ($method->isPublic()) {
                        if (!is_null($varObj)) {
                            self::setData($varObj, $data, $level + 1);
                            $method->invoke($instance, $varObj);
                        } elseif (array_key_exists($key, $data)) {
                            $method->invoke($instance, $data[$key]);
                        } elseif ((array_key_exists($name, $data))) {
                            $method->invoke($instance, $data[$name]);
                        }
                    }
                }
            }
        }
    }
    private static function isEntityProperty(\ReflectionProperty $obj)
    {
        $docProp = $obj->getDocComment();
        // 如果每个属性都进行判断将会耗费很长时间，一个类10个属性，1000个就达到10次
        // 直接过滤掉不敢兴趣的
        $reg = "/@var(.*)Entity/i";
        if (!preg_match($reg, $docProp)) {
            return null;
        }
//        if (strpos($docProp, "@var") === false) {
//            return null;
//        }

        $key = hash("sha256", $docProp);
        if (array_key_exists($key, self::$cacheEntityProperty)) {
            $clsName = self::$cacheEntityProperty[$key];
            return new $clsName;
        }

        DocParserHelper::clear();
        $docParseItems = DocParserHelper::parse($docProp);
        if (is_array($docParseItems) && array_key_exists('var', $docParseItems)) {
            $var = trim($docParseItems['var']);
            if (class_exists($var)) {
                $varObj = new $var();
                if ($varObj instanceof BaseEntity) {
                    self::$cacheEntityProperty[$key] = $var;
                    return $varObj;
                }
            }
        }
        return null;
    }

}