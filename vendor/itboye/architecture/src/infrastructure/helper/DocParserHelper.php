<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-12-13 10:49
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\infrastructure\helper;


/**
 * Parses the PHPDoc comments for metadata. Inspired by Documentor code base
 * 改造成静态类
 * @category   Framework
 * @package    restler
 * @subpackage helper
 * @author     Murray Picton <info@murraypicton.com>
 * @author     R.Arul Kumaran <arul@luracast.com>
 * @copyright  2010 Luracast
 * @license    http://www.gnu.org/licenses/ GNU General Public License
 * @link       https://github.com/murraypicton/Doqumentor
 */
class DocParserHelper
{

    private static $params = array();

    public static function clear()
    {
        self::$params = [];
    }

    public static function parse($doc = '')
    {
        if ($doc == '') {
            return self::$params;
        }
        // Get the comment
        if (preg_match('#^/\*\*(.*)\*/#s', $doc, $comment) === false)
            return self::$params;
        $comment = trim($comment [1]);
        // Get all the lines and strip the * from the first character
        if (preg_match_all('#^\s*\*(.*)#m', $comment, $lines) === false)
            return self::$params;
        self::parseLines($lines [1]);
        return self::$params;
    }

    private static function parseLines($lines)
    {
        foreach ($lines as $line) {
            $parsedLine = self::parseLine($line); // Parse the line

            if ($parsedLine === false && !isset (self::$params ['description'])) {
                if (isset ($desc)) {
                    // Store the first line in the short description
                    self::$params['description'] = implode(PHP_EOL, $desc);
                }
                $desc = array();
            } elseif ($parsedLine !== false) {
                $desc [] = $parsedLine; // Store the line in the long description
            }
        }
        if (!empty($desc)) {
            $desc = implode(' ', $desc);
        }
        if (!empty ($desc))
            self::$params ['long_description'] = $desc;
    }

    private static function parseLine($line)
    {
        // trim the whitespace from the line
        $line = trim($line);

        if (empty ($line))
            return false; // Empty line

        if (strpos($line, '@') === 0) {
            if (strpos($line, ' ') > 0) {
                // Get the parameter name
                $param = substr($line, 1, strpos($line, ' ') - 1);
                $value = substr($line, strlen($param) + 2); // Get the value
            } else {
                $param = substr($line, 1);
                $value = '';
            }
            // Parse the line and return false if the parameter is valid
            if (self::setParam($param, $value))
                return false;
        }

        return $line;
    }

    private static function setParam($param, $value)
    {
        if ($param == 'param' || $param == 'return')
            $value = self::formatParamOrReturn($value);
        if ($param == 'class')
            list ($param, $value) = self::formatClass($value);

        if (empty (self::$params [$param])) {
            self::$params [$param] = $value;
        } else if ($param == 'param') {
            $arr = array(
                self::$params[$param],
                $value
            );
            self::$params[$param] = $arr;
        } else {
            if (is_array(self::$params[$param])) {
                self::$params[$param] = array_push(self::$params[$param], $value);
            } else {
                self::$params[$param] = [self::$params[$param], $value];
            }
        }
        return true;
    }

    private static function formatParamOrReturn($string)
    {
        $pos = strpos($string, ' ');

        $type = substr($string, 0, $pos);
        return '(' . $type . ')' . substr($string, $pos + 1);
    }

    private static function formatClass($value)
    {
        $r = preg_split("[\(|\)]", $value);
        if (is_array($r)) {
            $param = $r [0];
            parse_str($r [1], $value);
            foreach ($value as $key => $val) {
                $val = explode(',', $val);
                if (count($val) > 1)
                    $value [$key] = $val;
            }
        } else {
            $param = 'Unknown';
        }
        return array(
            $param,
            $value
        );
    }
}