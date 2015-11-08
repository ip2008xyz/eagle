<?php
namespace Eagle\Core\Services;

class Debug
{

    private static $messages = array();

    protected static $count = 1;

    public static function warning($message, $to_message = false)
    {
        $key = (string)microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['warning']['text'] = $message;
        if ($to_message === true) {
            Message::warning($message);
        }
    }

    public static function status($message, $to_message = false)
    {
        $key = (string)microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['status']['text'] = $message;
        if ($to_message === true) {
            Message::status($message);
        }
    }

    public static function success($message, $to_message = false)
    {
        $key = (string)microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['success']['text'] = $message;
        if ($to_message === true) {
            Message::success($message);
        }


    }

    public static function error($message, $to_message = false)
    {
        $key = (string)microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['error']['text'] = $message;
        if ($to_message === true) {
            Message::error($message);
        }
    }


    public static function info($message, $to_message = false)
    {
        $key = (string)microtime(TRUE) . '.' . (self::$count++);
        self::$messages[$key]['info']['text'] = $message;
        if ($to_message === true) {
            Message::info($message);
        }

    }


    public static function exception($exception, $to_message = false)
    {

        $key = (string)microtime(TRUE) . '.' . (self::$count++);

        $message = $exception;

        self::$messages[$key]['exception']['text'] = $message;

        if ($to_message === true) {
            Message::exception($exception);
        }
    }

    private static function write_echo($class = "alert-info", $message, $type = 'INFO')
    {
        $word_length = strlen($type);

        if (is_array($message)) {
            if (empty($message)) {
                $message = 'empty';
            } else {
                $message = '<pre style="background:none; margin:0; padding:0; border:0 none; font-size:inherit; color:inherit; {$class}">'
                    . print_r($message, true)
                    . '</pre>';
            }


        }
        echo "<div><span style='font-size: 12px; padding:1px 3px; margin:1px 0px; display: inline-block; color:#FFF; {$class}'>"
            . str_pad($type, $word_length + ((10 - $word_length) * 6), '&nbsp;', STR_PAD_LEFT)
            . "</span> : <span style='color:#fff'>{$message}</span></div>";

    }

    public static function write_warning($message, $left_message = 'WARNING')
    {
        self::write_echo("background-color: #fcf8e3; border-color: #faebcc; color: #8a6d3b;", $message, $left_message);
    }

    public static function write_status($message, $left_message = 'STATUS')
    {
        self::write_echo("", $message, $left_message);
    }

    public static function write_info($message, $left_message = 'INFO')
    {
        self::write_echo("background-color: #d9edf7; border-color: #bce8f1; color: #31708f;", $message, $left_message);
    }

    public static function write_success($message, $left_message = 'SUCCESS')
    {
        self::write_echo("background-color: #dff0d8; border-color: #d6e9c6; color: #3c763d;", $message, $left_message);
    }

    public static function write_error($message, $left_message = 'ERROR')
    {
        self::write_echo("background-color: #f2dede; border-color: #ebccd1; color: #a94442;", $message, $left_message);
    }

    public static function write_exception($exception, $left_message = 'EXCEPTION')
    {
        if (is_object($exception)) {
            self::write_echo("background-color: #f2dede; border-color: #ebccd1; color: #a94442;",
                $exception->getMessage()
                . ', ' . $exception->getLine()
                . ' : ' . $exception->getFile(), $left_message);
        } else {
            self::write_echo("background-color: #f2dede; border-color: #ebccd1; color: #a94442;", $exception, $left_message);
        }

    }


    public static function write()
    {
        if (!isme()) {
            return true;
        }
        if (count(self::$messages) == 0) {
            return true;
        }

        /**
         * TODO move the css to style
         */
        echo '<div style="border:1px solid black; padding:3px; font-size: 12px; font-family: Consolas; background-color: #002B36;">';

        foreach (self::$messages as $v) {

            foreach ($v as $k => $message) {
                $function = 'write_' . $k;
                self::$function($message['text']);
            }
        }
        echo '</div>';

    }
}
