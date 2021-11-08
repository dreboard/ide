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


/**
 * Class Helpers
 * @package App\Core
 */
abstract class Helpers
{
    /**
     * @var array
     */
    protected static $characters = ['#', '&', ';', '`', '|', '*', '?', '~', '<', '>', '^', '(', ')','[', ']', '{', '}', '$', '\\', ',', '\x0A', '\xFF'];


    /**
     * Escape argument wrapper for shell commands
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
     * Is the string a php command
     * @param $string
     * @return bool
     */
    public static function isPhpCmd(string $code): bool
    {
        return strpos($code, 'php') === 0;
    }

    /**
     * Is the string a shell command
     * @param string $code
     * @return bool|string
     */
    public static function isShellCmd(string $code)
    {
        return preg_match('/system|shell_exec|^exec$|passthru/', $code);
    }

    /**
     * Strip bad characters from a command
     * @param string $code
     * @return string
     */
    public static function cleanCommand(string $code)
    {
        $command = str_replace(static::$characters, '',  $code  );
        return '<pre>'. system(trim($command)). '</pre>';
    }


    public static function trace_start()
    {
        if (extension_loaded('xdebug')) {
            //return call_user_func('xdebug_start_trace');
        }
        return false;
    }
    public static function trace_stop()
    {
        if (extension_loaded('xdebug')) {
            //return call_user_func('xdebug_stop_trace');
        }
        return false;
    }
}