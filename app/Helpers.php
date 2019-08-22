<?php
/**
 * @since       v0.1.0
 * @package     Dev-PHP
 * @author      Andre Board <dre.board@gmail.com>
 * @version     v1.0
 * @access      public
 * @see         https://github.com/dreboard
 */

namespace App\Core;


abstract class Helpers
{
    protected static $characters = ['#', '&', ';', '`', '|', '*', '?', '~', '<', '>', '^', '(', ')','[', ']', '{', '}', '$', '\\', ',', '\x0A', '\xFF'];


    /**
     * @param string $command
     * @return bool|mixed
     */
    public static function escapeCmd(string $command)
    {
        if (self::isPhpCmd()) {
            return str_replace(static::$characters, '', $command);
        }
        return false;
    }

    /**
     * @param $string
     * @return bool
     */
    public static function isPhpCmd(string $code): bool
    {
        return strpos($code, 'php') === 0;
    }

    /**
     * @param string $code
     * @return bool|string
     */
    public static function isShellCmd(string $code)
    {
        return preg_match('/system|shell_exec|^exec$|passthru/', $code);
    }

    /**
     * @param string $code
     * @return string
     */
    public static function cleanCommand(string $code)
    {
        $command = str_replace(static::$characters, '',  $code  );
        return '<pre>'. system(trim($command)). '</pre>';
    }

}